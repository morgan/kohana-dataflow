<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow_Input_Json
 *
 * @group		dataflow
 * @group		dataflow.input
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Input_JsonTest extends Unittest_TestCase
{	
	/**
	 * Generate object
	 * 
	 * @access	public
	 * @return	Dataflow_Input_Json
	 */
	public function factory()
	{
		return Dataflow_Input::factory(array('driver' => 'json'));
	}

	/**
	 * Test for decoding input
	 *
	 * @test
	 * @covers			Dataflow_Input_Json::set
	 * @covers			Dataflow_Input_Json::get
	 * @dataProvider	Kohana_DataflowTest::provider_json
	 */
	public function test_decoding($expected, $input)
	{
		$dataflow_input = $this->factory();
		
		$dataflow_input->set($input);
	
		$this->assertEquals
		(
			$expected,
			$dataflow_input->get()
		);
	}
	
	/**
	 * Test for correct type
	 * 
	 * @test
	 * @covers	Dataflow_Input_Json::type
	 */
	public function test_type()
	{
		$this->assertSame
		(
			$this->factory()->type(),
			'json'
		);
	}
}