<?php

/**
 * Storage handler.
 *
 * Though mvcMini is intended for small projects with little or no data storage
 * needs, the framework does offer very basic key-value filesystem-based storage 
 * should you need it.
 *
 * Data stored by mvcMini is serialize()d, allowing you to keep strings, numbers, 
 * PHP arrays, or objects.
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
 * @package  mvcMini
 * @author   Scott A. Murray <design@carbonvictory.com>
 */
class Storage {
	
	/**
	 * Retrieves data from storage.
	 * Returns unserialized data if the key is found, FALSE otherwise.
	 *
	 * @param   string  $key
	 * @return  mixed
	 */
	public static function get($key)
	{
		return unserialize(file_get_contents(STORAGE_DIR . md5($key)));
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
		file_put_contents(STORAGE_DIR . md5($key), serialize($value));
	}
	
	/**
	 * Deletes data from storage.
	 *
	 * @param   string  $key
	 * @return  void
	 */
	public static function remove($key)
	{
		unlink(STORAGE_DIR . md5($key));
	}

}