<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow YAML driver
 *
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_YAMLTest extends Kohana_DataflowTest
{
	/**
	 * Factory pattern
	 * 
	 * @access	public
	 * @return	Dataflow
	 */
	public function factory()
	{
		return Dataflow::factory(array('encode' => array('driver' => 'YAML'), 'decode' => array('driver' => 'YAML')));
	}
}