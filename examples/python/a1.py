"""Python 3.8+, standard library only. Docs: https://a1topup.com/api/recharge-api-integration"""
import os, urllib.parse, urllib.request, pathlib
env = pathlib.Path(__file__).resolve().parents[2] / ".env"
if env.exists():
    for line in env.read_text().splitlines():
        if "=" in line and not line.startswith("#"):
            k, v = line.split("=", 1); os.environ.setdefault(k.strip(), v.strip())
BASE = os.environ.get("A1_BASE_URL", "https://business.a1topup.com/recharge")

def a1_get(path, **params):
    q = {"username": os.environ.get("A1_USERNAME", ""), "pwd": os.environ.get("A1_PASSWORD", ""), **params}
    with urllib.request.urlopen(f"{BASE}{path}?{urllib.parse.urlencode(q)}", timeout=60) as r:
        return r.read().decode()
