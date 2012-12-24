<?php

/**
* Storage handler.
*
* Though mvcMini is intended for small projects with little
* or no data storage needs, the framework does offer very
* basic key-value filesystem-based storage should you need it.
*
* Data stored by mvcMini is serialize()d, allowing you to keep
* strings, numbers, PHP arrays, or objects.
*
* Storage keys may only contain letters, numbers, and underscores.
*
* <code>
*
*      // storing data
*      Storage::put('test', 'value');
*
*      // retrieving data
*      Storage::get('test'); // returns false if no such key exists
*
*      // deleting data
*      Storage::remove('test');
*
* </code>
*
* @package		mvcMini
* @author		Scott A. Murray <design@carbonvictory.com>
* @link			https://github.com/carbonvictory/mvcmini
*/
class Storage {
	
	/**
	 * Retrieves data from storage.
	 *
	 * @param   string  $key
	 * @return  mixed
	 */
	public static function get($key)
	{
		return unserialize(@file_get_contents(STORAGE_PATH . static::_clean($key)));
	}
	
	/**
	 * Saves data to storage.
	 *
	 * @param   string  $key
	 * @param   mixed   $value
	 * @return  void
	 */
	public static function put($key, $value = '')
	{
		file_put_contents(STORAGE_PATH . static::_clean($key), serialize($value));
	}
	
	/**
	 * Deletes data from storage.
	 *
	 * @param   string  $key
	 * @return  void
	 */
	public static function remove($key)
	{
		@unlink(STORAGE_PATH . static::_clean($key));
	}
	
	/**
	 * Sanitizes a data storage key by stripping out everything
	 * but letters, numbers, and underscores.
	 *
	 * @param   string  $key
	 * @return  string
	 */
	protected static function _clean($key)
	{
		return preg_replace('/[^\w]/', '', $key);
	}

}