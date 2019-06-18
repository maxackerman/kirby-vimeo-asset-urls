# Kirby Plugin: Get Vimeo Asset URLs

*This requires a paid Vimeo account*

Setup app with Vimeo [here](https://developer.vimeo.com/apps/new)

Add vimeo credentials to Kirby config:

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