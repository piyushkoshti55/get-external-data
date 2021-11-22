<?php
/**
 * Plugin Name:       User Api
 * Description:      User Api display all user data from external API.
 * Version:           1.0.0
 * Author:            Piyush Koshti
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
 
defined( 'ABSPATH' ) or die( 'Unauthorized Access' );

add_shortcode( 'external-data', 'techiepress_get_send_data' );

function techiepress_get_send_data() {
	
	
		
    $url = 'https://jsonplaceholder.typicode.com/users';
    
    $arguments = array(
        'method' => 'GET'
    );

	$response = wp_remote_get( $url, $arguments );

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} 
		$results = json_decode(wp_remote_retrieve_body( $response ));
		
		$html = "";
		$html .="<table border='1px'>
			 <tr> <td> Id</td>
			 <td> Name</td>
			 <td> Username</td>
			 <td> Email</td>
			 <td> Address</td>
			 <td> Phone</td>
			 <td> Website</td>
			 </tr>";
			 
			 
			 foreach($results as $result) {
			 
		$html .= '<tr> <td>' .$result->id.'</td>
			 <td>'. $result->name.'</td>
			 <td>'. $result->username .'</td>
			 <td>'. $result->email.'</td>
			 <td>'. $result->address->street .', '.$result->address->suite .', '.$result->address->city .', '.$result->address->zipcode .'</td>
			 <td>'. $result->phone.'</td>
			 <td>'. $result->website.'</td>
			 </tr>';
			 }
	 	$html .="</table>";
		return $html;
	
}	


?>
