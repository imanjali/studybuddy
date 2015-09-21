<html>
<head>
<title>test category</title>
</head>
<body>
<form name="cat" method="post" action="">
<input type="text" name="category">
<input type="text" name="sub">
<input type="submit" name="b">
</form>
<?php
if(isset($_POST['b']))
{
  $cat=$_POST['category'];
  $sub=$_POST['sub'];
if(empty($_POST['category'] && $_POST['sub']))
{
echo "hello";
}
else
{
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
	define("DATABASE","test");
}
$mysqli=new mysqli(HOST,USER,PASSWORD,DATABASE);
$stm=$mysqli->prepare("insert into test.books1(category,subject)values(?,?)");
$stm->bind_param('ss',$cat,$sub);
if($stm->execute())
{ 
 session_start();
 header("location:option.php"); 
}
}
}
?>
</body>
</html>