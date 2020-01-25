<?php

// Load the user configuration
include_once("config.php");

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
