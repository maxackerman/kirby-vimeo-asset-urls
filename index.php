<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('violet/kirby-vimeo-asset-urls', [
  'options' => [
    'client_id' => null,
    'client_secrets' => null,
    'token' => null
  ],
  'hooks' => [
    'file.update:after' => function ($file) {
      \Violet\Vimeoassets\Vimeo::checkForLinks($file);
    }
  ]
]);