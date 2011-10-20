<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow XML driver
 *
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_XmlTest extends Kohana_DataflowTest
{	
    /**
     * Factory pattern
     * 
     * @access	public
     * @return	Dataflow
     */
    public function factory()
    {
    	return Dataflow::factory(array('encode' => array('driver' => 'xml'), 'decode' => array('driver' => 'xml')));
    }
}