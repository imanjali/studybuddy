<html>
<head>
<title>studytable</title>
<link rel="stylesheet" href="studytable_style.css">
<script type="text/javascript">
function errormsg()
{
	alert("please select week days");
}
</script>
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
	if(isset($_POST['start'])){
		if(!empty($_POST['day']))
		{
		$bookid=$_GET['book'];
		$day=$_POST['day'];
		$time=$_POST['time'];
		$unserializedarray=$addarray=array();
		$arraynow=array('bookid'=>$bookid,'weekdays'=>$day,'time'=>$time);
		$stm1=$mysqli->prepare("select `studytable` from `studytable`.`signup` where `username`='".$_SESSION['name']."'");
		$stm1->execute();
		$stm1->bind_result($studyarray);
		$stm1->store_result();
		if($stm1->fetch()){
			if($studyarray != null){
				$unserializedarray=unserialize($studyarray);
				array_push($unserializedarray,$arraynow);
			}
			else{	
					
					array_push($unserializedarray,$arraynow);
				
				
				}
			$serializedarray=serialize($unserializedarray);
			$stm1=$mysqli->prepare("update `studytable`.`signup` set `studytable`='$serializedarray' where `username`='".$_SESSION['name']."'");
			if($stm1->execute()){
				header("location:final.php?book=".$bookid);
				}
			}
		}
		else
		{
			echo 'please select week days';
		}
		}
		
		$display='none';
	if(isset($_GET['book']))
	{
$stm=$mysqli->prepare("select * from studytable.books where book_id='".$_GET['book']."'");
$stm->execute();
$stm->bind_result($b,$n,$c,$l);
$stm->store_result();
$stm->fetch();
}
}
?>
<div id="study"><p id="head">STUDY BUDDY </p></div>
<table border="1" style='' class="t1">
<tr>
<th>sequence</th>
<th>subjects</th>
<th>timing</th>
<th>select week days</th>
</tr>
<tr>
<td>1</td>
<td><?php echo $n;?></td>
<form name="studytable" action="" method="post">
<td>
<select name="time">
<option value='30'>30 min</option>
<option value='30'>45 min</option>
<option value='60'>1hr</option>
<option value='120'>2hr</option>
<option value='180'>3hr</option>
</select>
</td>
<td>
<input type="checkbox" value="monday"  name="day[]">monday
<input type="checkbox" value="tuesday" name="day[]">tuesday
<input type="checkbox" value="wednesday" name="day[]">wednesday
<input type="checkbox" value="thursday" name="day[]" >thursday
<input type="checkbox" value="friday" name="day[]">friday
<input type="checkbox" value="saturday" name="day[]">saturday
<input type="checkbox" value="sunday" name="day[]">sunday
</td>
</tr>
</table>
<div id="add">
<a href="category.php"><input type="button" value="add one subject" class="b"></a>
</div>
<div id="start">
<a href="final.php"><input type="submit" value="start" name="start" class="s"></a>
</div>
</form>
<div id="table">
<table class="t2">
<tr><th>name</th>
<th>timing</th>
<th>weekdays</th></tr>
<?php
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
	         echo '<tr><td><a href="final.php?book='.$displaynow['bookid'].'">'.$name.'</a></td>';
			}
			echo '<td>'. $displaynow['time'].'</td>';
			echo '<td>';
			foreach($displaynow['weekdays'] as $weekdays)
			{
			echo $weekdays.'<br/>';
			}
			echo '</td></tr>';
		
		}
	}
}
?></table>
</body>
</html>