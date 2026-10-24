<?php

declare(strict_types=1);

$tls = ($argv[1] ?? '') !== '';
$context = stream_context_create($tls ? ['ssl' => ['local_cert' => $argv[1], 'local_pk' => $argv[2]]] : []);
$server = stream_socket_server('tcp://127.0.0.1:0', $errno, $error, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN, $context);
if ($server === false) {
    throw new RuntimeException('Cannot bind test HTTP server');
}
echo substr(strrchr(stream_socket_get_name($server, false), ':'), 1) . "\n";
flush();

while ($connection = @stream_socket_accept($server, 10)) {
    stream_set_timeout($connection, 5);
    if ($tls && !@stream_socket_enable_crypto($connection, true, STREAM_CRYPTO_METHOD_TLS_SERVER)) {
        fclose($connection);
        continue;
    }
    $line = fgets($connection, 8192);
    if ($line === false) {
        fclose($connection);
        continue;
    }
    [$method, $target] = explode(' ', $line, 3);
    $headers = [];
    while (($line = fgets($connection, 8192)) !== false && trim($line) !== '') {
        [$name, $value] = explode(':', $line, 2);
        $headers[strtolower($name)] = trim($value);
    }
    $body = '';
    $length = min(65536, (int) ($headers['content-length'] ?? 0));
    while (strlen($body) < $length && !feof($connection)) {
        $chunk = fread($connection, $length - strlen($body));
        if ($chunk === false || $chunk === '') {
            break;
        }
        $body .= $chunk;
    }
    $path = parse_url($target, PHP_URL_PATH);
    parse_str((string) parse_url($target, PHP_URL_QUERY), $query);
    $status = 200;
    $payload = '{}';
    $extraHeaders = '';
    if ($path === '/slow-headers') {
        usleep(3000000);
    } elseif ($path === '/redirect') {
        $status = 302;
        $payload = 'redirect-body';
        $extraHeaders = "Location: /ok\r\n";
    } elseif ($path === '/oversized' || $path === '/compressed') {
        $payload = str_repeat('x', 8192);
        if ($path === '/compressed') {
            $payload = gzencode($payload);
            $extraHeaders = "Content-Encoding: gzip\r\n";
        }
    } elseif ($path === '/v3/ipgeo' || $path === '/v3/ipgeo-bulk') {
        $valid = ($query['apiKey'] ?? '') === 'test-key'
            && ($headers['user-agent'] ?? '') === 'php-security-test'
            && ($headers['accept'] ?? '') === 'application/json';
        if ($path === '/v3/ipgeo') {
            $valid = $valid && $method === 'GET' && ($query['ip'] ?? '') === '8.8.8.8'
                && ($query['include'] ?? '') === 'security,abuse' && ($headers['x-test'] ?? '') === 'yes';
            $payload = '{"ip":"8.8.8.8","location":{"country_name":"United States"},"security":{"is_proxy":false,"threat_score":0},"abuse":{"emails":["abuse@example.com"]}}';
            $extraHeaders = "X-Credits-Charged: 1\r\n";
        } else {
            $valid = $valid && $method === 'POST' && ($headers['content-type'] ?? '') === 'application/json'
                && json_decode($body, true) === ['ips' => ['8.8.8.8', 'invalid-ip', '1.1.1.1']];
            $payload = '[{"ip":"8.8.8.8"},{"message":"Invalid IP address."},{"ip":"1.1.1.1"}]';
            $extraHeaders = "X-Credits-Charged: 2\r\nX-Successful-Record: 2\r\n";
        }
        if (!$valid) {
            $status = 400;
            $payload = '{"message":"Unexpected test request"}';
        }
    } elseif (!in_array($path, ['/ok', '/slow-body', '/truncated'], true)) {
        $status = 501;
    }
    $declaredLength = $path === '/truncated' ? 10 : strlen($payload);
    @fwrite($connection, "HTTP/1.1 $status Test\r\nContent-Type: application/json\r\nContent-Length: $declaredLength\r\n$extraHeaders" . "Connection: close\r\n\r\n");
    fflush($connection);
    if ($path === '/slow-body') {
        usleep(3000000);
    }
    @fwrite($connection, $payload);
    fclose($connection);
}
fclose($server);
