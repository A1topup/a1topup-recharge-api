<?php
// Usage: php status.php <orderid>
require __DIR__ . '/config.php';
if (empty($argv[1])) { exit("Usage: php status.php <orderid>\n"); }
echo a1_get('/status', array('orderid' => $argv[1], 'format' => 'json')), PHP_EOL;
