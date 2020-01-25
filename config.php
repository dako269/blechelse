<?php

// marudor.de API
$baseAPI = "https://marudor.de/api/";
$stationSearchAPI = "hafas/v1/station/";
$arrivalBoardAPI = "hafas/v1/arrivalStationBoard";
$departureBoardAPI = "hafas/v1/arrivalStationBoard";

// Choose which services to ignore for the announcements
$ignoreServiceTypes = [
	"Bus",
	"STR"
];

// Only create announcements for platforms defined here. Leave empty to hear announcements for all platforms.
$platformWhitelist = [];

// Command to produce speech
$speechDispatcher = "espeak-ng -v de %speech%";
