<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Decode JSON-P Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Decode_JSONP extends Dataflow_Decode
{
	/**
	 * Decode
	 * 
	 * @access	protected
	 * @return	array
	 */
	protected function _decode($data)
	{
		if (FALSE !== $position = strpos($data, '('))
		{
			// remove "any_callback_name(" and trim ")"
			$data = rtrim(substr($data, ++$position, strlen($data)), ')');
		}
		
		return json_decode($data, TRUE);
	}
}
