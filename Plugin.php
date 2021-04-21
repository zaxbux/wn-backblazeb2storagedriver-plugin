<?php namespace Zaxbux\BackblazeB2StorageDriver;

use Storage;
use Zaxbux\B2\Client;
use League\Flysystem\Filesystem;
use Zaxbux\Flysystem\BackblazeB2Adapter;
use Zaxbux\BackblazeB2StorageDriver\Classes\B2AuthCache;

use System\Classes\PluginBase;

/**
 * Plugin class for Backblaze B2 Storage Driver
 */
class Plugin extends PluginBase {
	public function boot() {
		// Register the b2 storage driver
		Storage::extend('b2', function ($app, $config) {
			$cache = new B2AuthCache();
			$client = new Client($config['applicationKeyId'], $config['applicationKey'], [], $cache);
			$adaptor = new BackblazeB2Adapter($client, $config['bucketName']);
			return new Filesystem($adaptor);
		});
	}
}
