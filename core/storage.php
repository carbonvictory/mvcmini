<?php

class Storage {
	
	public static function get($key)
	{
		return unserialize(@file_get_contents(STORAGE_PATH . static::_clean($key)));
	}
	
	public static function put($key, $value = '')
	{
		file_put_contents(STORAGE_PATH . static::_clean($key), serialize($value));
	}
	
	public static function remove($key)
	{
		@unlink(STORAGE_PATH . static::_clean($key));
	}
	
	protected static function _clean($key)
	{
		return preg_replace('/[^\w]/', '', $key);
	}

}