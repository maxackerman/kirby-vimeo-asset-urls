# Kirby Plugin: Get Vimeo Asset URLs

*This requires a paid Vimeo account*

Setup app with Vimeo [here](https://developer.vimeo.com/apps/new)

Add vimeo credentials to Kirby config:

```
# /site/config/config.php

<?php

return [
  'violetoffice.vimeoassets.client_id' => 'XXXXX',
  'violetoffice.vimeoassets.client_secrets' => 'XXXXX',
  'violetoffice.vimeoassets.token' => 'XXXXX',
];
```

Add a video field to a file blueprint:

```
# /site/blueprints/files/image.yml

title: Example Image/Video        

fields:
  haspostervideo:
    label: Include autoplay poster video?
    type: toggle
    default: false
    text:
       - 'no'
       - 'yes'
  postervimeourl:
    label: Vimeo URL
    type: url
    placeholder: https://vimeo.com/37776933
    when:
      haspostervideo: true
```

Using the the data your templates:

```
<?php $item->postervimeo() = $vimeodata ?>

<?php foreach($vimeodata->toStructure() as $file): ?>
  type: <?= $file->type() ?><br />
  quality: <?= $file->quality() ?><br />
  link: <?= $file->link() ?><br />
  <?php e($file->width() != '', 'width:' . $file->width()) ?>
  <hr>
<?php endforeach ?>
```

## TODO

- make field names a config option