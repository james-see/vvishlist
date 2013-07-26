<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

require "connect.php";
require "functions.php";

// Setting the content-type header to javascript:
header('Content-type: application/javascript');

// Validating the input data
if(empty($_GET['url']) || empty($_GET['title']) || !validateURL($_GET['url'])) die();

// Sanitizing the variables
$_GET['url'] = sanitize($_GET['url']);
$_GET['title'] = sanitize($_GET['title']);

// Inserting, notice the use of the hash field and the md5 function:
mysql_query("	INSERT INTO bookmark_app (hash,url,title)
				VALUES (
					'".md5($_GET['url'])."',
					'".$_GET['url']."',
					'".$_GET['title']."'
				)");

$message = '';
if(mysql_affected_rows($link)!=1)
{
	$message = 'This URL already exists in the database!';
}
else
$message = 'The URL was shared!';


?>

/* JavaScript Code */

function displayMessage(str)
{
	// Using pure JavaScript to create and style a div element
    
	var d = document.createElement('div');
	
	with(d.style)
	{
    	// Applying styles:
        
		position='fixed';
		width = '350px';
		height = '20px';
		top = '50%';
		left = '50%';
		margin = '-30px 0 0 -195px';
		backgroundColor = '#f7f7f7';
		border = '1px solid #ccc';
		color = '#777';
		padding = '20px';
		fontSize = '18px';
		fontFamily = '"Myriad Pro",Arial,Helvetica,sans-serif';
		textAlign = 'center';
		zIndex = 100000;
        
		textShadow = '1px 1px 0 white';
		
		MozBorderRadius = "12px";
		webkitBorderRadius = "12px";
		borderRadius = "12px";
		
		MozBoxShadow = '0 0 6px #ccc';
		webkitBoxShadow = '0 0 6px #ccc';
		boxShadow = '0 0 6px #ccc';
	}
	
	d.setAttribute('onclick','document.body.removeChild(this)');
    
    // Adding the message passed to the function as text:
	d.appendChild(document.createTextNode(str));
	
    // Appending the div to document
	document.body.appendChild(d);
	
    // The message will auto-hide in 3 seconds:
    
	setTimeout(function(){
		try{
			document.body.removeChild(d);
		}	catch(error){}
	},3000);
}

<?php 

// Adding a line that will call the JavaScript function:
echo 'displayMessage("'.$message.'");';

?>
