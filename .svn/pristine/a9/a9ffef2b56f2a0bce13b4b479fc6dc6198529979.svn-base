<?php
include_once 'jdf.php';

class DateCalc{
	function day_of_week($date){
		$days = [
		"Saturday" => "شنبه",
		"Sunday" => "یکشنبه",
		"Monday" => "دوشنبه",
		"Tuesday" => "سه شنبه",
		"Wednesday" => "چهارشنبه",
		"Thursday" => "پنج شنبه",
		"Friday" => "جمعه",
		];

		$d = explode("/", $date);

		$res = jalali_to_gregorian($d[0], $d[1], $d[2]);
		$tempDate = $res[0]."-".$res[1]."-".$res[2];
		$d = date('l', strtotime( $tempDate));
		//echo $d . "<br>";
		return $days[$d];
	}

	function getDifferance($start, $finish){
		$start = explode('/', $start);
		$finish = explode('/', $finish);

		$d1 = $start[0]*365 + $start[1]*30 + $start[2];
		$d1 += ($start[1] < 6) ? $start[1] : 6;

		$d2 = $finish[0]*365 + $finish[1]*30 + $finish[2];
		$d2 += ($finish[1] < 6) ? $finish[1] : 6;

		return $d2 - $d1 + 1;
	}

	function getMonth($date){
		$d = explode("/", $date);

		$res = 	jdate_words(array('mm'=>$d[1]));

		return $res;
	}

	function getNow(){
		$day = jdate('d / m / Y');

		return $day;
	}
	function getSearchNow(){
		//$format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'
		$day = jdate('Y/m/d','','','Asia/Tehran','en');
		$day = explode('/', $day);
		$year = $day[0];
		$month = $day[1];//(strlen($day[1] > 1)) ? $day[1] : "0".$day[1];
		$day = $day[2];//(strlen($day[2] > 1)) ? $day[2] : "0".$day[2];

		$date = $year.'/'.$month.'/'.$day;
		return $date;
	}
}