<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow_Output_Json
 *
 * @group		dataflow
 * @group		dataflow.output
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Output_JsonTest extends Unittest_TestCase
{	
	/**
	 * Generate object
	 * 
	 * @access	public
	 * @return	Dataflow_Output_Json
	 */
	public function factory()
	{
		return Dataflow_Output::factory(array('driver' => 'json'));
	}

	/**
	 * Test for decoding output
	 *
	 * @test
	 * @covers			Dataflow_Output_Json::set
	 * @covers			Dataflow_Output_Json::get
	 * @covers			Dataflow_Output_Json::__toString
	 * @dataProvider	Kohana_DataflowTest::provider_json
	 */
	public function test_encoding($set, $expected)
	{
		$dataflow_output = $this->factory();
		
		$dataflow_output->set($set);
	
		$this->assertSame
		(
			$expected,
			(string) $dataflow_output
		);
	}	
	
	/**
	 * Test for correct type
	 * 
	 * @test
	 * @covers	Dataflow_Output_Json::type
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