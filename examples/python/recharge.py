"""Usage: python3 recharge.py <number> <amount> <operatorcode> <circlecode>"""
import sys, time
from a1 import a1_get
if len(sys.argv) < 5: sys.exit(__doc__)
number, amount, operator, circle = sys.argv[1:5]
order_id = f"ORD{int(time.time() * 1000)}"   # unique for every request
print("Order:", order_id)
print(a1_get("/api", circlecode=circle, operatorcode=operator, number=number, amount=amount, orderid=order_id, format="json"))
# Pending: wait for the callback, never retry with the same order.
