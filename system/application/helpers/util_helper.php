<?php
class Util {
	
	public static function debug($element, $title = 'DEBUGANDO')
	{
		print "<pre style='color:#fff;background: #000;position:relative;z-index:2000;'>
				<div>
					<b>############# DEBUG CODE ($title) (specify) TYPE(" . gettype($element) . ") #############</b>
				</div>\r\n";
		if (is_array($element) || is_object($element)) {
			print_r($element);
		} else {
			print $element;
		}	
		print "</pre>";
	}
	
	public static function formataDataExibicao($date,$withTime=true)
	{
		if($date=="0000-00-00") $date = "";
		$time = "";
		if(substr_count($date," "))
			list($date,$time) = explode(" ",$date);
		 
		if($date && !substr_count($date,"/"))
		{
			list($year,$month,$day) = explode("-",$date);
			if($time && $withTime)
				return $day."/".$month."/".$year." {$time}";
			else
				return $day."/".$month."/".$year;
		}
		else
		{
			if($time)
				return "{$date} {$time}";
				else
					return $date;
		}
	}
}
?>