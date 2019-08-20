<?php

return [
  'token' => [
    'store' => env('PAGOFACIL_TOKEN_STORE'),
    'service' => env('PAGOFACIL_TOKEN_SERVICE'),
    'secret' => env('PAGOFACIL_TOKEN_SECRET'),
  ],
  'url' => [
    'callback' => env('PAGOFACIL_URL_CALLBACK', 'callback'),
    'complete' => env('PAGOFACIL_URL_COMPLETE', 'complete'),
    'cancel' => env('PAGOFACIL_URL_CANCEL', 'cancel'),
  ]
];
