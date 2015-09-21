<html>
<head>
<link rel="stylesheet" href="books_style.css">
</head>
<body>
<h1>Books Upload</h1>
<form name="books" action="" method="post" enctype="multipart/form-data">
<pre>
<input type="text" name="name" placeholder="name" />
<select name="category">
 <option value='programming'>programming</option>
 <option value='web_design'>web</option>
 <option value='science'>science</option>
</select>
<input type="file" name="upload" placeholder="upload" >
<center><input type="submit" name="submit" value="submit"></center>
</pre>
</form>
<?php
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$category=$_POST['category'];
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
$target_file="books/".$category."/";
$target_path=$target_file.basename($_FILES['upload']['name']);
$mysqli=new mysqli(HOST,USER,PASSWORD,DATABASE);
$stm=$mysqli->prepare("insert into studytable.books(name,category,location)values(?,?,?)");
$stm->bind_param('sss',$name,$category,$target_path);
$stm->execute();

if(move_uploaded_file($_FILES['upload']['tmp_name'],$target_path))
{
	echo "<p style='color: black;
  font-size: 31px;
  font-style: inherit;
  font-family: -webkit-body;margin-left: 169px;'>file ".basename($_FILES['upload']['name'])." has been uploaded</p>";
}
else
{
	echo "failed";
}
}
?>
</body>
</html>