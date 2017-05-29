<?php
 function processURL($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));
 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
 	
	$username = 'himanshuxarma'; // your username

	$count = 20; // number of images to show
			
    $url = "https://www.instagram.com/".$username."/media/";
 
    $all_result  = processURL($url);
	
    $decoded_results = json_decode($all_result, true);
 
    //echo '<pre>';
     //print_r($decoded_results);
	 
     //exit;
 
    //Now parse through the $results array to display your results... 
    foreach($decoded_results['items'] as $items){
		
		//print_r($items);
        $image_link = $items['images']['thumbnail']['url'];
        echo '<img src="'.$image_link.'" />';
    }

?>