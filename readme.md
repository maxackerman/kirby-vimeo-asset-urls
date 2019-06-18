# Kirby Plugin: Get Vimeo Asset URLs

*This requires a paid vimeo account*

Add vimeo credentials to config
You'll need to set these to your account's as show [here](https://developer.vimeo.com/apps/new)

```
c::set(array(
  'vimeo.client_id' => 'xxxxxxxxx',
  'vimeo.client_secrets' => 'xxxxxxxxx',
  'vimeo.token' => 'xxxxxxxxx'
));
```

Use the date in your templates:

```
<?php foreach($vimeodata->toStructure() as $file): ?>
  type: <?= $file->type() ?><br />
  quality: <?= $file->quality() ?><br />
  link: <?= $file->link() ?><br />
  <?php e($file->width() != '', 'width:' . $file->width()) ?>
  <hr>
<?php endforeach ?>
```