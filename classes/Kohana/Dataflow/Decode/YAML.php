<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Decode YAML Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Decode_YAML extends Dataflow_Decode
{
	/**
	 * Initialize
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct(array $config)
	{
		parent::__construct($config);

		require_once Kohana::find_file('vendor', 'yaml/lib/sfYaml');
	}
	
	/**
	 * Decode
	 * 
	 * @access	protected
	 * @return	array
	 */
	protected function _decode($data)
	{
		return sfYaml::load($data);
	}
}
