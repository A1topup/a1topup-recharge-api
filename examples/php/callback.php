<?php
// Put this at the callback URL you registered with A1Topup. It receives the final status of pending recharges.
// Field names: see https://a1topup.com/api/recharge-api-integration
// A1Topup calls: https://yourdomain.com/callback.php?txid=ORDER_ID&status=Success&opid=OPERATOR_ID
$orderId = isset($_REQUEST['txid'])   ? $_REQUEST['txid']   : '';   // your order id
$status  = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';   // Success or Failure
$opid    = isset($_REQUEST['opid'])   ? $_REQUEST['opid']   : '';   // operator reference
file_put_contents(__DIR__ . '/callback.log', date('c') . " $orderId $status $opid" . PHP_EOL, FILE_APPEND);
// 1) Find YOUR order by $orderId. Ignore unknown ids.
// 2) Update it only if it is still pending (callbacks can repeat).
// 3) Success -> mark done and save $opid; Failure -> refund your user's wallet.
http_response_code(200);
echo 'OK';
