<?php
require __DIR__ . '/config.php';
echo a1_get('/balance', array('format' => 'json')), PHP_EOL;
