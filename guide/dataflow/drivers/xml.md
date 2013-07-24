# XML Driver

## Encoding Attributes

Encoding attributes requires using the `:attributes` key.

		// Setup XML encode driver
		$encode = Dataflow_Encode::factory(array('driver' => 'XML'));

		$decoded = array
		(
			'parent' => array
			(
				'child' => array
				(
					':attributes'	=> array('key1' => 'value1', 'key2' => 'value2')
				)
			)
		);

		// Set decoded array
		$encode->set($decoded);

		// Output result
		echo Debug::vars($encode->get());

		// Debug output
		string(96) "<?xml version="1.0" encoding="UTF-8"?>
		<parent>
		 <child key1="value1" key2="value2"/>
		</parent>
		"

## Decoding Attributes

Decoding attributes will put the attributes in the `:attributes` key.

		// Setup XML decode driver
		$decode = Dataflow_Decode::factory(array('driver' => 'XML'));

		$encoded = '<?xml version="1.0" encoding="UTF-8"?>
			<parent>
			 <child key1="value1" key2="value2"/>
			</parent>';

		// Set encoded string
		$decode->set($encoded);

		// Output result
		echo Debug::vars($decode->get());

		// Debug output
		array(1) (
		    "parent" => array(1) (
		        "child" => array(1) (
		            ":attributes" => array(2) (
		                "key1" => string(6) "value1"
		                "key2" => string(6) "value2"
		            )
		        )
		    )
		)
