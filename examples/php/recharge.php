<?php
// Usage: php recharge.php <number> <amount> <operatorcode> <circlecode>
require __DIR__ . '/config.php';
list(, $number, $amount, $operator, $circle) = array_pad($argv, 5, null);
if (!$number || !$amount || !$operator || !$circle) { exit("Usage: php recharge.php <number> <amount> <operatorcode> <circlecode>\n"); }
$orderId = 'ORD' . date('YmdHis') . mt_rand(100, 999);   // unique for every request
echo "Order: $orderId\n", a1_get('/api', array(
    'circlecode' => $circle, 'operatorcode' => $operator, 'number' => $number,
    'amount' => $amount, 'orderid' => $orderId, 'format' => 'json',
)), PHP_EOL;
// status: Success -> save opid | Failure -> refund your user | anything else = pending: wait for the callback, never retry.
// Bills: add 'value1' / 'value2' (see README).
