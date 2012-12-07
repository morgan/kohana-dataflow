<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow JSONP driver
 *
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2012 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_JsonpTest extends Kohana_DataflowTest
{
	/**
	 * Factory pattern
	 * 
	 * @access	public
	 * @return	Dataflow
	 */
	public function factory()
	{
		return Dataflow::factory(array('encode' => array('driver' => 'jsonp'), 'decode' => array('driver' => 'jsonp')));
	}
}
