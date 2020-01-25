<?php

function replaceAbbreviations($text){
	$text = str_ireplace("Hbf", "Hauptbahnhof", $text);
	return $text;
}

function generateArrivalAnnouncement($platform, $train, $destination, $scheduledTime, $delay){
	$announcementText = "Einfahrt an Gleis ".$platform."! ".$train." nach ".replaceAbbreviations($destination).". ";
	if($delay >= 1){
		$announcementText .= "Ursprünglich geplante Einfahrt um ".date("G", $scheduledTime)." Uhr ".(int)date("i", $scheduledTime)."!";
	}
	return $announcementText;
}
