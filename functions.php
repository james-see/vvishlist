<?php

/* Helper functions */

function validateURL($str)
{
	return preg_match('/(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:\/~\+#]*[\w\-\@?^=%&amp;\/~\+#])?/i',$str);
}

function sanitize($str)
{
	if(ini_get('magic_quotes_gpc'))
		$str = stripslashes($str);

	$str = strip_tags($str);
	$str = trim($str);
	$str = htmlspecialchars($str);
	$str = mysql_real_escape_string($str);
	
	return $str;
}


function relativeTime($dt,$precision=2)
{
	if(is_string($dt)) $dt = strtotime($dt);
	
	$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
	$passed=time()-$dt;
	
	if($passed<5)
	{
		$output='less than 5 seconds ago';
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' and ',$output).' ago';
	}
	
	return $output;
}

// Defining fallback functions for mb_substr and 
// mb_strlen if the mb extension is not installed:

if(!function_exists('mb_substr'))
{
	function mb_substr($str,$start,$length,$encoding)
	{
		return substr($str,$start,$length);
	}
}

if(!function_exists('mb_strlen'))
{
	function mb_strlen($str,$encoding)
	{
		return strlen($str);
	}
}
?>