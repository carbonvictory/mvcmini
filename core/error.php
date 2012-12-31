<?php

/**
 * Error handler.
 *
 * @package		mvcMini
 * @author		Scott A. Murray <design@carbonvictory.com>
 */
 
/**
 * When called, execution halts and the framework throws the HTTP error code
 * and message.
 *
 * <code>
 *
 *      error(500, 'Something went wrong.');
 *
 * </code>
 *
 * @param   HTTP status code   $status
 * @param   string             $message
 * @return  void
 */
function error($status = 500, $message = NULL)
{
	$status = preg_replace('/[^\d]/', '', $status);
	
	header("HTTP/1.1 $status");
	die($message);
}