<?php
	
	include_once('eHorecaClass.php');

/////////////////////////
/////	Settings	/////
	$apiURL = "https://ehoreca.cmodlab-iu.edu.gr/api/";
	$email = "<put your account's email here>";
	$password = "<put your account's password here>";
/////////////////////////
	
	//Get fresh from https://ehoreca.cmodlab-iu.edu.gr/request-docs
	//$endPoints = array("users", "users/{id}", "users/w_producer/{id}", "users/{id}/heatmaps", "users/{id}/routes", "users/{id}/reports", "bins", "bins/{id}", "bins/reports/{id}", "bins/w_producer/{id}", "reports", "reports/{id}", "reports/w_producer/{id}", "heatmaps", "heatmaps/{id}", "routes", "routes/{id}", "vehicle_route/{id}", "routes/vehicle/{id}", "vehicles", "vehicles/{id}", "vehicles/plate/{plate}", "w_producers", "w_producers/{id}", "w_producers/from_user_id/{id}", "pois", "pois/{id}");

	$a_eHoreca = new eHoreca($apiURL);
	$a_eHoreca->connect($email, $password);
	
	//print_r($a_eHoreca->getEndPoint("users/1"));
	print_r($a_eHoreca->getEndPoint("bins/"));

?>