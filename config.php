<?php

// marudor.de API
$baseAPI = "https://marudor.de/api/";
$stationSearchAPI = "hafas/v1/station/";
$arrivalBoardAPI = "hafas/v1/arrivalStationBoard";
$departureBoardAPI = "hafas/v1/arrivalStationBoard";

// Choose which services to ignore for the announcements
$ignoreServiceTypes = [
	"Bus",
	"STR",
	"U"
];

// Only create announcements for platforms defined here. Leave empty to hear announcements for all platforms.
$platformWhitelist = [];

// Updates every...
$updateInterval = 60;

// Minimum delay in minutes to be announced
define("MINIMUM_DELAY_ANNOUNCEMENT", 5);

// Amount of VIA stations to announce (0, 1 or 2 recommended)
define("AMOUNT_VIA_STATIONS", 2);

// Command to produce speech
$speechDispatcher = "gtts-cli -l de %speech% | mpg123 -q -";
