# Getting Started	

## Basic Usage

	$dataflow = Dataflow::factory();
	
	// Set basic JSON
	$dataflow->set('{}');
	
	// Get input as array
	var_dump($dataflow->as_array());
	
	// Get input as another format
	var_dump($dataflow->get());
	