<?php

function replaceAbbreviations($text){
	$text = str_ireplace("Hbf", "Hauptbahnhof", $text);
	return $text;
}

function generateArrivalAnnouncement($platform, $train, $destination, $scheduledTime, $delay){
	$announcementText = "Einfahrt ".$train." nach ".replaceAbbreviations($destination)." an Gleis ".$platform;
	if($delay >= 1){
		$announcementText .= " circa ".$delay." Minuten später.";
	}
	return $announcementText;
}
