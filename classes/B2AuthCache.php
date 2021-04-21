<?php namespace Zaxbux\BackblazeB2StorageDriver\Classes;

use Cache;
use Zaxbux\B2\AuthCacheInterface;

/**
 * Winter CMS Cache adapter for the B2 SDK Client
 */
class WinterB2AuthCache implements AuthCacheInterface {

	const CACHE_PREFIX = "b2auth_";

	/**
	 * Get the key of the B2 auth data in the cache
	 *
	 * @param  string $key B2 Authorization Basic header
	 * @return string
	 */
	protected static function getCacheKey($key) {
		return WinterB2AuthCache::CACHE_PREFIX.$key;
	}

	/**
	 * {@inheritDoc}
	 */
	public function cachedB2Auth($key) {
		if ($authJson = Cache::get($this::getCacheKey($key))) {
			return json_decode($authJson, true);
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function cacheB2Auth($key, $authData) {
		Cache::put($this::getCacheKey($key), json_encode($authData), 1440); // 1440 minutes is 24 hours, when the B2 token expires
	}
}
