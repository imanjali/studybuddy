<html>
<head>
<link rel="stylesheet" href="option_style.css" />
<title>option</title>
</head>
<body>
 <div id="study"><p id="head">STUDY BUDDY </p></div>
<p id="choose">choose from the options:</p>
<?PHP 
session_start();
if(!isset($_SESSION['name']))
{
	header("location:login_signup.php");
}
else
{
	if(isset($_GET['book']))
	{
$f= "<a href='studytable.php?book=";
$f.= $_GET['book'];
$f.= "&flag=reg' class='round-button' style='text-decoration:none;'><div id='b1'>study everyday</div></a>";
$f.= "<a href='final.php?book=";
$f.=$_GET['book'];
$f.="'class='round-button' style='text-decoration:none;'><div id='b2'>study just now</div></a>";
echo $f;
}
}
?>
</body>
</html>
