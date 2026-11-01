"""Usage: python3 status.py <orderid>"""
import sys
from a1 import a1_get
if len(sys.argv) < 2: sys.exit(__doc__)
print(a1_get("/status", orderid=sys.argv[1], format="json"))
