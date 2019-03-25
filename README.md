# BackBlaze B2 Storage Driver

This October CMS plugin allows you to use the Backblaze B2 cloud storage service as a filesystem on your installation.

## Requirements

To use B2 Cloud Storage, you need to have a Backblaze account. You can get an account by signing up at [backblaze.com](https://backblaze.com). After enabling B2 for your account, you will have access to your Account ID and Application Key that lets you use the API. (https://www.backblaze.com/b2/docs/)

## Plugin Settings

The plugin is configured in your October CMS `filesystems.php` and `cms.php`.

### filesystems.php
Edit your `filesystems.php` to add a disk "backblaze" that uses the `b2` driver:
```
return [

  ...

  'disks' => [
    'backblaze' => [
      'driver'           => 'b2',
      'bucketName'       => '<your bucket name>',
      'applicationKeyId' => '<application key id>',
      'applicationKey'   => '<application key>'
    ],
  ],

  ...

];
```
You can also use your account ID and master application key instead of application keys, however this is not recommended.

### cms.php
Edit your `cms.php` to configure the media manager to use your "backblaze" disk:
```
return [

  ...

  'storage' => [
    'media' => [
      'disk'   => 'backblaze',
      'folder' => '',
      'path'   => 'https://f000.backblazeb2.com/file/<your bucket name>'
    ],
  ],

  ...

];
```

The `folder` specifies a "prefix" inside the bucket to store files (useful if you have a namePrefix restriction on your application key). The `path` specifies the public URL of your bucket (no trailing slash), which can be obtained from the Backblaze B2 dashboard. If you have setup a subdomain to point to your bucket, replace the `f000.backblazeb2.com` with your custom domain.

## Known Limitations
 * The Backblaze B2 API does not support moving or renaming objects. You will have to delete the remote copy and upload it again.

## Change Log

* 1.0.1 - First version

## TODO

* All done!