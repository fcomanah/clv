<?php

function create_form_input($name, $type, $errors) {
	
	// Assume no value already exists:
	$value = false;

	// Check for a value in POST:
	if (isset($_POST[$name])) $value = $_POST[$name];
	
	// Strip slashes if Magic Quotes is enabled:
	if ($value && get_magic_quotes_gpc()) $value = stripslashes($value);

	// Conditional to determine what kind of element to create:
	if ( ($type == 'text') || ($type == 'password') ) { // Create text or password inputs.
		
		// Start creating the input:
		echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';
		
		// Add the value to the input:
		if ($value) echo ' value="' . htmlspecialchars($value) . '"';

		// Check for an error:
		if (array_key_exists($name, $errors)) {
			echo 'class="error" /> <div class="error">' . $errors[$name] . '</div>';
		} else {
			echo ' />';		
		}
		
	} elseif ($type == 'select') { // Select menu.
		
		if ($name == 'estado') { // Create a list of states.
			
			//$data = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
         $data = array('' => '', 'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins');
			
		}
		
		// Start the tag:
		echo '<select name="' . $name  . '"';
	
		// Add the error class, if applicable:
		if (array_key_exists($name, $errors)) echo ' class="error"';
		
		// Close the tag:
		echo '>';		
	
		// Create each option:
		foreach ($data as $k => $v) {
			echo "<option value=\"$k\"";
			
			// Select the existing value:
			if ($value == $k) echo ' selected="selected"';
			
			echo ">$v</option>\n";
			
		} // End of FOREACH.
	
		// Complete the tag:
		echo '</select>';
		
		// Add an error, if one exists:
		if (array_key_exists($name, $errors)) {
			echo '<br /><span class="error">' . $errors[$name] . '</span>';
		}
	
	} elseif ($type == 'textarea') { // Create a TEXTAREA.
		
		// Display the error first: 
		if (array_key_exists($name, $errors)) echo ' <span class="error">' . $errors[$name] . '</span>';

		// Start creating the textarea:
		echo '<textarea name="' . $name . '" id="' . $name . '" rows="5" cols="75"';
		
		// Add the error class, if applicable:
		if (array_key_exists($name, $errors)) {
			echo ' class="error">';
		} else {
			echo '>';		
		}
		
		// Add the value to the textarea:
		if ($value) echo $value;

		// Complete the textarea:
		echo '</textarea>';
		
	} // End of primary IF-ELSE.

} // End of the create_form_input() function.

function update_form_input($name, $atual, $disabled, $type, $errors) {
	
	// Assume no value already exists:
	$value = false;	

	// Check for a value in POST:
	if (isset($_POST[$name])) $value = $_POST[$name];
	else if($atual) $value = $atual;
	
	// Strip slashes if Magic Quotes is enabled:
	if ($value && get_magic_quotes_gpc()) $value = stripslashes($value);

	// Conditional to determine what kind of element to create:
	if ( ($type == 'text') || ($type == 'password') ) { // Create text or password inputs.
		
		// Start creating the input:
		echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';
		
		if ( $disabled == 'true' ) echo 'disabled="disabled"' ;
		
		// Add the value to the input:
		if ($value) echo ' value="' . htmlspecialchars($value) . '"';

		// Check for an error:
		if (array_key_exists($name, $errors)) {
			echo 'class="error" /> <div class="error">' . $errors[$name] . '</div>';
		} else {
			echo ' />';		
		}
		
	} elseif ($type == 'textarea') { // Create a TEXTAREA.
		
		// Display the error first: 
		if (array_key_exists($name, $errors)) echo ' <span class="error">' . $errors[$name] . '</span>';

		// Start creating the textarea:
		echo '<textarea name="' . $name . '" id="' . $name . '" rows="5" cols="75"';
		
		if ( $disabled == 'true' ) echo 'disabled="disabled"' ;
		
		// Add the error class, if applicable:
		if (array_key_exists($name, $errors)) {
			echo ' class="error">';
		} else {
			echo '>';		
		}
		
		// Add the value to the textarea:
		if ($value) echo $value;

		// Complete the textarea:
		echo '</textarea>';
		
	} // End of primary IF-ELSE.

} // End of the update_form_input() function.

// Omit the closing PHP tag to avoid 'headers already sent' errors!