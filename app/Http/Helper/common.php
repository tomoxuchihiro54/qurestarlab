<?php
function s2h($seconds) {
	
	$hours = floor($seconds / 3600);
	$minutes = floor(($seconds / 60) % 60);
	$seconds = $seconds % 60;
	
	$hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	
	return $hms;
}
