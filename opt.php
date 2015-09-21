<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Select books</title>
        <link rel="stylesheet" href="opt_style.css" />
</head>
<body>
    <div id="study"><p id="head">STUDY BUDDY </p><div  style="float:right;box-shadow:0px 2px 0px orange;background:white;width:100px;"><a href="logout.php" style="text-decoration:none;"><h3 style="font-family: tahoma;">&nbsp;&nbsp;LogOut</h3></a></div></div>   
      
    <p> SUBJECTS: </p>
   
    <div class="sub">
        	<?php
		session_start();
if(!isset($_SESSION['name']))
{
	header("location:login_signup.php");
}
		if(isset($_GET['option']))
		{
			$option=$_GET['option'];
			if(!defined("HOST"))
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
				$stm=$mysqli->prepare("select `book_id`,`name` from studytable.books where category='$option'");
				$stm->execute();
				$stm->bind_result($bookid,$name);
				$stm->store_result();
				while($stm->fetch()){
					echo "<pre><div class=".'"sub"'."><a id='s' href='option.php?book=".$bookid."'>".$name."</a></div></pre>";
					}
		}		
			?>
		

            </div>
            </body>
</html>