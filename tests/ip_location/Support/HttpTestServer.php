<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test\Support;

final class HttpTestServer
{
    public readonly string $url;
    public readonly ?string $caFile;
    private mixed $process = null;
    private array $pipes = [];
    private ?string $directory = null;

    public function __construct(bool $tls = false)
    {
        $caFile = null;
        $keyFile = '';
        if ($tls) {
            $this->directory = sys_get_temp_dir() . '/ipgeo-tls-' . bin2hex(random_bytes(8));
            if (!mkdir($this->directory, 0700)) {
                throw new \RuntimeException('Cannot create test certificate directory');
            }
            $config = $this->directory . '/openssl.cnf';
            file_put_contents($config, "[req]\ndistinguished_name=dn\n[dn]\n[cert]\nsubjectAltName=DNS:localhost\nbasicConstraints=critical,CA:TRUE\nkeyUsage=critical,digitalSignature,keyEncipherment,keyCertSign\nextendedKeyUsage=serverAuth\n");
            $key = openssl_pkey_new(['private_key_bits' => 2048]);
            if ($key === false) {
                throw new \RuntimeException('Cannot create test private key');
            }
            $csr = openssl_csr_new(['commonName' => 'localhost'], $key, ['config' => $config, 'digest_alg' => 'sha256']);
            $cert = $csr === false ? false : openssl_csr_sign($csr, null, $key, 1, ['config' => $config, 'x509_extensions' => 'cert', 'digest_alg' => 'sha256']);
            if ($cert === false || !openssl_x509_export($cert, $certificate) || !openssl_pkey_export($key, $privateKey)) {
                throw new \RuntimeException('Cannot create test certificate');
            }
            $caFile = $this->directory . '/ca.pem';
            $keyFile = $this->directory . '/key.pem';
            file_put_contents($caFile, $certificate);
            file_put_contents($keyFile, $privateKey);
            chmod($keyFile, 0600);
        }

        $this->caFile = $caFile;
        $this->process = proc_open(
            [PHP_BINARY, __DIR__ . '/http_server.php', $this->caFile ?? '', $keyFile],
            [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
            $this->pipes
        );
        if (!is_resource($this->process)) {
            throw new \RuntimeException('Cannot start test HTTP server');
        }
        fclose($this->pipes[0]);
        unset($this->pipes[0]);
        stream_set_timeout($this->pipes[1], 5);
        $port = trim((string) fgets($this->pipes[1]));
        if (!ctype_digit($port)) {
            throw new \RuntimeException('Test HTTP server did not start: ' . stream_get_contents($this->pipes[2]));
        }
        $this->url = ($tls ? 'https://localhost:' : 'http://127.0.0.1:') . $port;
    }

    public function close(): void
    {
        if (is_resource($this->process)) {
            proc_terminate($this->process);
            foreach ($this->pipes as $pipe) {
                fclose($pipe);
            }
            proc_close($this->process);
            $this->process = null;
        }
        if ($this->directory !== null) {
            foreach (glob($this->directory . '/*') ?: [] as $file) {
                unlink($file);
            }
            rmdir($this->directory);
            $this->directory = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
