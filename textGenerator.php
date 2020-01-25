<?php

function replaceAbbreviations($text){
	$text = str_ireplace("Hbf", "Hauptbahnhof", $text);
	$text = str_ireplace("(Main)", " am Main ", $text);
	$text = str_ireplace("(M)", " am Main ", $text);
	$text = str_ireplace("(S)", "", $text);
	return $text;
}

function generateArrivalAnnouncement($platform, $train, $destination, $scheduledTime, $delay, $via){
	// Select two VIA-Stations for the announcement
	$selectedViaStations = [];
	$via = array_reverse($via);
	for($i = AMOUNT_VIA_STATIONS; $i >= 1; $i--){
		$random = rand(1, (int)((count($via)-2)/$i));
		$selected = replaceAbbreviations($via[$random]["station"]["title"]);
		if(!in_array($selected, $selectedViaStations)){
			$selectedViaStations[] = $selected;
		}
	}	

	// Generate the text to speak
	$announcementText = "Einfahrt an Gleis ".$platform."! ".$train.(count($selectedViaStations) >= 1 ? " über ".implode(" und ", $selectedViaStations) : "")." nach ".replaceAbbreviations($destination).". ";
	if($delay >= MINIMUM_DELAY_ANNOUNCEMENT){
		$announcementText .= "Ursprünglich geplante Einfahrt um ".date("G", $scheduledTime)." Uhr ".(int)date("i", $scheduledTime)." vor ".$delay." Minuten.";
	}
	return $announcementText;
}
