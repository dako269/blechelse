<?php

// Load the user configuration & generation scripts
include_once("config.php");
include_once("textGenerator.php");

// Get the station for which to generate announcements from CLI string
$searchString = $argv; unset($searchString[0]);
$searchString = urlencode(implode(" ", $searchString));

// Retrieve data from the API
$stationSearch = json_decode(file_get_contents($baseAPI.$stationSearchAPI.$searchString), true);

// Only care for the first result
$evaId = $stationSearch[0]["id"];
$stationName = $stationSearch[0]["title"];
echo "Running blechelse for ".$stationName." (EvaId ".$evaId.")\n";
echo count($stationSearch[0]["products"])." products available.\n";

$arrivalStationAge = $updateInterval;
$arrivals = [];

// Keep running
while(true){
	// Retrieve arrival board if necessary
	if($arrivalStationAge >= $updateInterval){
		echo "Updating arrival board at ".date("Y-m-d H:i:s")."\n";
		$arrivals = json_decode(file_get_contents($baseAPI.$arrivalBoardAPI."?station=".$evaId), true);
		$arrivalStationAge = 0;
	}

	// Do the announcements
	foreach($arrivals as $arrival){
		// Only run if our service is not blacklisted and its time has come
		if(	
			!in_array($arrival["train"]["type"], $ignoreServiceTypes)
			and $arrival["arrival"]["scheduledTime"] / 1000 == time()
		){
			$announcement = generateArrivalAnnouncement(
				$arrival["arrival"]["platform"],
				$arrival["train"]["name"],
				$arrival["finalDestination"],
				$arrival["arrival"]["scheduledTime"] / 1000,
				(isset($arrival["arrival"]["delay"]) ? $arrival["arrival"]["delay"] : 0)
			);
			echo "Dispatching announcement: ".$announcement."\n";
			exec($speechDispatcher." ".escapeshellarg('"'.$announcement.'"'));
		}
	}

	// Wait a bit until we do this again
	$arrivalStationAge++;
	sleep(1);
}
