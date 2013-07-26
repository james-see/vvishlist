<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

require "connect.php";
require "functions.php";

$url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"]);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Bookmarking App With PHP, JavaScript &amp; MySQL | Tutorialzine demo</title>

<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<h1>Simple Bookmarking App With PHP, JS &amp; MySQL</h1>
<h2><a href="http://tutorialzine.com/2010/04/simple-bookmarking-app-php-javascript-mysql/">Go Back to the Tutorial &raquo;</a></h2>

<div id="main">

    <div class="bookmarkHolder">
    
    	<!--	The link contains javascript functionallity which is preserved
        		when the user drops it to their bookmark/favorites bar	-->

        <a href="javascript:(function(){var jsScript=document.createElement('script');
jsScript.setAttribute('type','text/javascript');
jsScript.setAttribute('src', '<?php echo $url?>/bookmark.php?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title));
document.getElementsByTagName('head')[0].appendChild(jsScript);
})();" class="bookmarkButton">Bookmark this!</a>
        
        <em>Drag this button to your bookmarks bar and click it when visiting a web site. The title and URL of the page will be saved below.</em>
    </div>
    
    <ul class="latestSharesUL">
        <?php
        
		$shares = mysql_query("SELECT * FROM bookmark_app ORDER BY id DESC LIMIT 6");
		
		while($row=mysql_fetch_assoc($shares))
		{
			// Shortening the title if it is too long:
			if(mb_strlen($row['title'],'utf-8')>80)
				$row['title'] = mb_substr($row['title'],0,80,'utf-8').'..';
			
			// Outputting the list elements:
			echo '
			<li>
				<div class="title"><a href="'.$row['url'].'" class="bookmrk">'.$row['title'].'</a></div>
				<div class="dt">'.relativeTime($row['dt']).'</div>
			</li>';
		}
        
        ?>
    </ul>
    
</div>

</body>
</html>
