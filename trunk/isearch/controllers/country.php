<?php
	
	function country_list()
	{
		$output = '<ul id="list" title="list" selected="true">';
		$old_first_letter = '';
		foreach( _get_countries() as $country )
		{
			$first_letter = substr( $country, 0, 1 );
			if( $first_letter != $old_first_letter )
			{
				$output .= '<li class="group">' . $first_letter . '</li>';
			}
			$output .= '<li>' . $country . '</li>';
			$old_first_letter = $first_letter;
		}
		$output .= '</ul>';

		return $output;
	}

	function country_search()
	{
		if( sizeof( $_POST ) == 0  )
		{
			return _search_form();
		}
		else
		{
			$output = _search_form();
			foreach( _get_countries() as $country )
			{
				if( preg_match( '/^' . $_POST[ 'country' ] . '/i', $country ) )
				{
					$output .= '<li>' . $country . '</li>';
				}
			}
		}

		return $output;
		
	}

	function _search_form()
	{
		return '<form action="" method="post">country <input type="text" name="country" id="country"><input type="submit" value=" search "></form>';
	}

	function _get_countries()
	{
		$countries = array(
				"USA", "Western Sahara", "Viet Nam", "Yemen", "Zambia",
				"Hungary", "Uganda", "Uruguay", "Vanuatu", "Venezulela",
				"France", "Sweden", "Taiwan", "Thailand", "Togo", "Turkey",
				"Germany", "Quatar", "Sahara", "Samoa", "Senegal", "Serbia",
				"United Kingdom", "Norway", "Pakistan", "Palau", "Paraguay",
				"Russia", "Nepal","Nederlands","Nauru","Nigeria","Oman",
				"Cuba","Malawi","Madagascar","Malaysia","Luxembourg","Liberia",
				"Mexico","Jamaica","Japan","Kosovo","Kuwait","Kenya","Kazakhstan",
				"Poland", "Haiti","Honduras","India","Iraq","Ireland","Israel",
				"Austria","Denmark","Ethiopia","Fiji","Gabon","Georgia","Grenada",
				"Spain","Congo","Costa Rica","Cyprus","Dominica","Ecuador",
				"Australia","Argentina","Belarus","Belgium","Brazil"
		);

		sort( $countries );

		return $countries;
	}

?>
