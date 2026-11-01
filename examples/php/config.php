<?php
// Reads credentials from .env (never hard-code them). Docs: https://a1topup.com/api/recharge-api-integration
$env = @parse_ini_file(__DIR__ . '/../../.env') ?: array();
define('A1_BASE', getenv('A1_BASE_URL') ?: (isset($env['A1_BASE_URL']) ? $env['A1_BASE_URL'] : 'https://business.a1topup.com/recharge'));
define('A1_USER', getenv('A1_USERNAME') ?: (isset($env['A1_USERNAME']) ? $env['A1_USERNAME'] : ''));
define('A1_PWD',  getenv('A1_PASSWORD') ?: (isset($env['A1_PASSWORD']) ? $env['A1_PASSWORD'] : ''));

function a1_get($path, array $params) {
    $params = array_merge(array('username' => A1_USER, 'pwd' => A1_PWD), $params);
    $ch = curl_init(A1_BASE . $path . '?' . http_build_query($params));
    curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 60));
    $body = curl_exec($ch);
    if ($body === false) { throw new RuntimeException('Request failed: ' . curl_error($ch)); }
    curl_close($ch);
    return $body;
}
