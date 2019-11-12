<?php

namespace Violet\Vimeoassets;


class Vimeo
{

  public static function checkForLinks($file)
  {
    // should also check if a vimeo URL was removed and clear out the data
    $updates = array();

    if($file->hasfullvideo()->isTrue() && $file->fullvimeourl() != ''){
      $updates = \Violet\Vimeoassets\Vimeo::getAssets($updates, $file->fullvimeourl(), 'full');
    }else{
      $updates['fullvimeo'] = '';
    }

    if($file->haspostervideo()->isTrue() && $file->postervimeourl() != ''){
      $updates = \Violet\Vimeoassets\Vimeo::getAssets($updates, $file->postervimeourl(), 'poster');
    }else{
      $updates['postervimeo'] = '';
    }

    try {
      $file->update($updates);
    } catch(Exception $e) {
      throw $e;
    }
  }

  public static function getAssets($a, $url, $prefix)
  {
    // vimeo creds from config file
    $client_id = option('violet.vimeoassets.client_id');
    $client_secret = option('violet.vimeoassets.client_secrets');
    $access_token = option('violet.vimeoassets.token');

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

}
