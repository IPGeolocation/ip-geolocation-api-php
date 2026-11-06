import gzip
import json
import threading
import time
import zlib
from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer
from urllib.parse import urlsplit

foreign_requests = []


class Handler(BaseHTTPRequestHandler):
    def log_message(self, *_):
        pass

    def do_POST(self):
        self.do_GET()

    def do_GET(self):
        try:
            self.respond()
        except (BrokenPipeError, ConnectionResetError):
            pass

    def respond(self):
        route = urlsplit(self.path).path.split('/')[1]
        request = self.rfile.read(int(self.headers.get('Content-Length', 0)))
        if self.server is foreign:
            foreign_requests.append({'body': request.decode(), 'marker': self.headers.get('X-Marker')})
        if route == 'received':
            body = json.dumps(foreign_requests).encode()
        else:
            row = {'ip': '8.8.8.8', 'location': {'country_name': 'مصر'}}
            body = json.dumps([row for _ in json.loads(request)['ips']] if request else row, ensure_ascii=False).encode()
        if route.startswith('redirect'):
            target = '/echo' + self.path[len('/' + route):]
            if route == 'redirect-other':
                target = f'http://localhost:{foreign.server_port}{target}'
            elif route == 'redirect-port':
                target = f'http://127.0.0.1:{foreign.server_port}{target}'
            elif route == 'redirect-user':
                target = f'http://user:pass@127.0.0.1:{self.server.server_port}{target}'
            elif route == 'redirect-loop':
                target = self.path
            self.send_response(307)
            self.send_header('Location', target)
            redirect_body = b'x' * 2048 if route == 'redirect-body' else b''
            self.send_header('Content-Length', str(len(redirect_body)))
            self.end_headers()
            self.wfile.write(redirect_body)
            return
        if route == 'headers-delay':
            time.sleep(0.35)
        status = 429 if route.startswith('error-') else 200
        if route in ('chunked-cut', 'error-chunked-cut'):
            self.protocol_version = 'HTTP/1.1'
            self.send_response(status)
            self.send_header('Transfer-Encoding', 'chunked')
            self.send_header('Connection', 'close')
            self.end_headers()
            self.wfile.write(f'{len(body):x}\r\n'.encode() + body + b'\r\n')
            self.close_connection = True
            return
        encoding = None
        if route in ('gzip', 'bad-gzip', 'gzip-cut', 'error-gzip-cut', 'gzip-big', 'gzip-progress'):
            encoding = 'gzip'
            if route == 'gzip-big':
                body = b'x' * (2 * 1024 * 1024)
            body = gzip.compress(body)
            if route in ('gzip-cut', 'error-gzip-cut'):
                body = body[:-5]
            if route == 'bad-gzip':
                body = b'not a gzip stream'
        if route == 'deflate':
            encoding = 'deflate'
            body = zlib.compress(body)
        if route == 'br':
            encoding = 'br'
            body = bytes.fromhex('8b07807b226970223a22382e382e382e38227d03')
        if route == 'request-headers':
            body = json.dumps(dict(self.headers)).encode()
        if route == 'large':
            row = json.dumps({'ip': '8.8.8.8', 'location': {'country_name': 'مصر', 'city': 'x' * 2048}}, ensure_ascii=False).encode()
            self.send_response(200)
            self.send_header('Content-Length', str(50000 * (len(row) + 1) + 1))
            self.end_headers()
            self.wfile.write(b'[')
            for i in range(50000):
                self.wfile.write((b',' if i else b'') + row)
            self.wfile.write(b']')
            return
        if route == 'error-large':
            body = b'x' * 4096
        if route == 'trickle':
            body = b'{}\n'
        self.send_response(status)
        self.send_header('Content-Length', str(len(body) + (20 if route in ('cut', 'error-cut') else 5 if route in ('gzip-cut', 'error-gzip-cut') else 0)))
        if encoding:
            self.send_header('Content-Encoding', encoding)
        self.end_headers()
        self.wfile.flush()
        if route in ('body-delay', 'error-delay'):
            time.sleep(0.35)
        if route == 'body-stall':
            self.wfile.write(body[:2])
            self.wfile.flush()
            time.sleep(0.35)
            self.wfile.write(body[2:])
            return
        if route == 'trickle':
            for i in range(len(body)):
                if i:
                    time.sleep(1.5)
                self.wfile.write(body[i:i + 1])
                self.wfile.flush()
        elif route == 'gzip-progress':
            for i in range(0, len(body), 2):
                self.wfile.write(body[i:i + 2])
                self.wfile.flush()
                time.sleep(0.02)
        elif route == 'progress':
            for i in range(0, len(body), 4):
                self.wfile.write(body[i:i + 4])
                self.wfile.flush()
                time.sleep(0.02)
        else:
            self.wfile.write(body)


with ThreadingHTTPServer(('127.0.0.1', 0), Handler) as origin, ThreadingHTTPServer(('127.0.0.1', 0), Handler) as foreign:
    for server in (origin, foreign):
        threading.Thread(target=server.serve_forever, daemon=True).start()
    print(json.dumps({'origin': origin.server_port, 'foreign': foreign.server_port}), flush=True)
    threading.Event().wait()
