<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Encode YAML Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Encode_YAML extends Dataflow_Encode
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
	 * Get content type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function content_type()
	{
		return 'application/yaml';
	}	
	
	/**
	 * Encode
	 * 
	 * @access	protected
	 * @return	string
	 */
	protected function _encode(array $data)
	{
		return sfYaml::dump($data);	
	}
}
