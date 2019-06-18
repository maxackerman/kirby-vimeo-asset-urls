<?php

// Include the Vimeo API file. Download from here: https://github.com/vimeo/vimeo-php-lib
@include_once __DIR__ . '/vendor/autoload.php';

function vimeoInfo($a, $url, $prefix)
{
  // vimeo creds from config file
  $client_id = c::get('vimeo.client_id');
  $client_secret = c::get('vimeo.client_secrets');
  $access_token = c::get('vimeo.token');
  // authenticate
  $vimeo = new \Vimeo\Vimeo($client_id, $client_secret, $access_token);

  // get vimeo video ID from URL
  $vimeoId = substr(parse_url($url, PHP_URL_PATH), 1);

  // get vimeo data
  $videoData = $vimeo->request("/videos/" . $vimeoId);
  // $log = kirby()->roots()->config() . DS . 'log.txt';
  // f::write($log, json_encode($videoData), true);

  if ( isset($videoData['body']['files']) ) {
    $a[$prefix . 'vimeo'] = $videoData['body']['files'];
  }

  return $a;

}

Kirby::plugin('violet/vimeo-asset-urls', [
  'hooks' => [
    'file.update:after' => function ($file) {
      // we should check if a vimeo URL was removed and clear out the data

      $updates = array();

      if($file->hasfullvideo()->isTrue() && $file->fullvimeourl() != ''){
        $updates = vimeoInfo($updates, $file->fullvimeourl(), 'full');
      }else{
        $updates['fullvimeo'] = '';
      }

      if($file->haspostervideo()->isTrue() && $file->postervimeourl() != ''){
        $updates = vimeoInfo($updates, $file->postervimeourl(), 'poster');
      }else{
        $updates['postervimeo'] = '';
      }

      try {
        $file->update($updates);
      } catch(Exception $e) {
        throw $e;
      }

    }
  ]
]);