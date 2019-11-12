<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('violetoffice/vimeoassets', [
  'options' => [
    'client_id' => null,
    'client_secrets' => null,
    'token' => null
  ],
  'hooks' => [
    'file.update:after' => function ($file) {
      \Violetoffice\Vimeoassets\Vimeo::checkForLinks($file);
    }
  ]
]);