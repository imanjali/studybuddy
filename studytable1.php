<html>
<head>
<title>studytable</title>
<link rel="stylesheet" href="studytable_style.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['name']))
{
	header("location:login_signup.php");
}
else
{	if(!defined("HOST"))
{
	define("HOST","localhost");
}
if(!defined("USER"))
{
	define("USER","root");
}
if(!defined("PASSWORD"))
{
	define("PASSWORD","");
}
if(!defined("DATABASE"))
{
	define("DATABASE","studytable");
}
$mysqli=new mysqli(HOST,USER,PASSWORD,DATABASE);	
$stm=$mysqli->prepare("select `studytable` from studytable.signup where username='".$_SESSION['name']."'");
$stm->execute();
$stm->bind_result($displayarray);
$stm->store_result();
if($stm->fetch())
{
	if($displayarray !=null)
	{
		$displayarray=unserialize($displayarray);
		
		foreach($displayarray as $displaynow)
		{
						$stm=$mysqli->prepare("select `name` from studytable.books where book_id='".$displaynow['bookid']."'");
			$stm->execute();
			$stm->bind_result($name);
			$stm->store_result();
			if($stm->fetch())
            {
	         echo '<tr><td>ds'.$name.'</a></td>';
			}
			echo '<td>'. $displaynow['time'].'</td>';
			echo '<td>';
			foreach($displaynow['weekdays'] as $weekdays)
			echo $weekdays;
			echo '</td></tr>';
		}
	}
}}
?>
</table>

	}
</body>
</html>