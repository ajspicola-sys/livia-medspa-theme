"""Local read-only proxy for visually reviewing the live site.

Serves https://liviamedspa.com through localhost so the Claude Preview
browser (which only opens local servers) can render and screenshot it.
The live site outputs absolute URLs for all assets, so only the HTML
document passes through this proxy; CSS/JS/images load directly from
the live domain. GET requests only — nothing can be changed through it.
"""
import urllib.request
from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer

ORIGIN = "https://liviamedspa.com"
PORT = 8765


class ProxyHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        url = ORIGIN + self.path
        req = urllib.request.Request(url, headers={
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
                          "AppleWebKit/537.36 (KHTML, like Gecko) "
                          "Chrome/126.0 Safari/537.36",
            "Accept": "text/html,application/xhtml+xml,*/*;q=0.8",
            "Accept-Encoding": "identity",
        })
        try:
            with urllib.request.urlopen(req, timeout=30) as resp:
                body = resp.read()
                ctype = resp.headers.get("Content-Type",
                                         "text/html; charset=utf-8")
        except Exception as exc:
            body = f"Proxy error: {exc}".encode()
            self.send_response(502)
            self.send_header("Content-Type", "text/plain")
            self.send_header("Content-Length", str(len(body)))
            self.end_headers()
            self.wfile.write(body)
            return

        self.send_response(200)
        self.send_header("Content-Type", ctype)
        self.send_header("Content-Length", str(len(body)))
        self.end_headers()
        self.wfile.write(body)

    def log_message(self, *args):
        pass


if __name__ == "__main__":
    print(f"Proxying {ORIGIN} on http://127.0.0.1:{PORT}")
    ThreadingHTTPServer(("127.0.0.1", PORT), ProxyHandler).serve_forever()
