# Getting Started

## Basic Usage

	$dataflow = Dataflow::factory();
	
	// Set basic JSON
	$dataflow->set('{}');
	
	// Get input as array
	var_dump($dataflow->as_array());
	
	// Get input as another format
	var_dump($dataflow->get());
	
## Setting drivers

	$config = array
	(
		'decode' => array('driver' => 'YAML'),
		'encode' => array('driver' => 'XML')
	);

	$dataflow = Dataflow::factory($config);

## Rendering output

Simply echo contents:

	echo $dataflow;

Render passing headers based on driver. Uses default Request object:

	$dataflow->render();

Render without passing headers:

	$dataflow->render(FALSE);

Apply headers to custom Request object:

	$dataflow->render(TRUE, $request);
