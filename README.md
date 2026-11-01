# A1Topup Recharge API – code samples

Official examples for the **[A1Topup Recharge API](https://a1topup.com/mobile-recharge-api)**: mobile, DTH, postpaid and utility bill payments through one API, from A1Topup Services (OPC) Pvt Ltd, an ISO 9001:2015 certified recharge technology company in India (since 2016).

- 📘 Full documentation: https://a1topup.com/api/recharge-api-integration
- 🌐 Website: https://a1topup.com
- 💬 API access and support: WhatsApp +91 91610 19161

## What's inside

| Folder | What it shows |
| --- | --- |
| `examples/php` | Recharge, balance, status and a callback handler (PHP 7+, cURL) |
| `examples/node` | Recharge, balance and status (Node.js 18+, no packages needed) |
| `examples/python` | Recharge, balance and status (Python 3.8+, standard library only) |
| `postman` | Ready-to-import Postman collection |

## Endpoints

Base URL: `https://business.a1topup.com/recharge` · GET or POST · response `format`: `csv` (default), `json` or `xml`

### Recharge – `/api`

| Parameter | Required | Description | Example |
| --- | --- | --- | --- |
| `username` | Yes | Your API username | YOUR_USERNAME |
| `pwd` | Yes | Your API password | YOUR_PASSWORD |
| `circlecode` | No | Circle code of the number (table below) | 2 (West Bengal) |
| `operatorcode` | Yes | Operator code (table below) | RC (Jio) |
| `number` | Yes | Mobile number or consumer number | 9800000000 |
| `amount` | Yes | Recharge amount | 10 |
| `orderid` | Yes | Your unique order id | ORD1001 |
| `format` | Yes | csv, json or xml | json |
| `value1`, `value2` | Billers only | Extra values for landline, gas, electricity, insurance | see below |

```json
{ "txid": "5804", "status": "Success", "opid": "RJ0317161622000269New", "number": "9800000000", "amount": "10", "orderid": "ORD1001" }
```
CSV: `txid,status,opid,number,amount,orderid`

### Balance – `/balance`
`username`, `pwd`, `format`

```json
{ "status": "success", "balance": "1542.50", "currency": "INR" }
```

### Status – `/status`
`username`, `pwd`, `orderid` (the same id you sent with the recharge), `format`

```json
{ "status": "Success", "txid": "5804", "opid": "RJ0317161622000269New", "number": "9800000000", "amount": "10", "orderid": "ORD1001", "timestamp": "2026-11-02 10:30:05" }
```

### Callback – called on **your** URL
When a pending recharge gets its final status, A1Topup calls your URL, for example
`https://yourdomain.com/callback.php?txid=ORDER_ID&status=Success&opid=OPERATOR_ID`

| Parameter | Meaning |
| --- | --- |
| `txid` | Your order id |
| `status` | Success or Failure |
| `opid` | Operator reference |

Share your server IP and callback URL with the A1Topup team to get whitelisted.

### Extra values for bills (`value1`, `value2`)

| Biller | number | value1 | value2 |
| --- | --- | --- | --- |
| Airtel Landline | Landline number | STD code | – |
| BSNL Landline | Landline number | STD code | Account number |
| MTNL Delhi Landline | Landline number | CA number | – |
| Mahanagar Gas | Customer account number | Bill group number | – |
| MSEDC - Maharashtra | Consumer number | Billing unit | Processing cycle |
| Reliance Energy - Mumbai | Account number | Cycle number | – |
| Insurance | Policy number | Date of birth (DD-MM-YYYY) | – |

### Common operator codes

| Mobile | Code | DTH | Code | Postpaid | Code |
| --- | --- | --- | --- | --- | --- |
| Jio | `RC` | Airtel Digital TV | `ATV` | Airtel Postpaid | `PAT` |
| Airtel | `A` | Tata Play (Tata Sky) | `TTV` | Jio Postpaid | `JPP` |
| Vodafone | `V` | Dish TV | `DTV` | Vodafone Postpaid | `VP` |
| Idea | `I` | Videocon d2h | `VTV` | Idea Postpaid | `IP` |
| BSNL Topup / STV | `BT` / `BR` | Sun Direct | `STV` | BSNL Postpaid | `BP` |

Electricity, gas, insurance, FASTag and voucher codes (120+): see the [full operator list](https://a1topup.com/api/recharge-api-integration#operators).

### Circle codes

| State | Code | State | Code | State | Code |
| --- | --- | --- | --- | --- | --- |
| Andhra Pradesh | 13 | Haryana | 20 | Orissa | 23 |
| Assam | 24 | Himachal Pradesh | 21 | Punjab | 1 |
| Bihar | 17 | Jammu and Kashmir | 25 | Rajasthan | 18 |
| Chhattisgarh | 27 | Jharkhand | 22 | Tamil Nadu | 8 |
| Gujarat | 12 | Karnataka | 9 | UP East / West | 10 / 11 |
| Delhi | 5 | Kerala | 14 | West Bengal | 2 |
| Mumbai | 3 | Madhya Pradesh | 16 | Kolkata | 6 |
| Chennai | 7 | Maharashtra | 4 | North East | 26 |

## Quick start

```bash
cp .env.example .env        # add your API username and password
php examples/php/balance.php
node examples/node/balance.js
python3 examples/python/balance.py
```

## Handling responses safely

| Status | What your code should do |
| --- | --- |
| Success | Mark the order done and save `opid` |
| Failure | Refund your user's wallet, then allow a new attempt with a **new** `orderid` |
| Pending | Show "processing" and wait for the callback, or call `/status` with the **same** `orderid` |

Use a 60-second timeout. A timeout is treated as **pending**, not failed.

**Never retry a pending recharge.** That is how duplicate recharges happen.

## Security checklist

- Keep `username` and `pwd` on your server, never in an Android app or browser code
- Use a unique `orderid` for every request
- Accept callbacks only for order ids you created that are still pending
- Log every request and response

## Get API access

Talk to our team on WhatsApp **+91 91610 19161** or visit [a1topup.com/mobile-recharge-api](https://a1topup.com/mobile-recharge-api).
Other APIs: [utility bill payment](https://a1topup.com/api/utility-bill-payment) · [FASTag](https://a1topup.com/api/fastag) · [all APIs](https://a1topup.com/api)

## License

MIT for the sample code in this repository. Use of the A1Topup API is subject to your agreement with A1Topup.
