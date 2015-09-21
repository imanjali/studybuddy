<html>
<head>
    <title>category_list</title>
    <link rel="stylesheet" href="category_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="libraries/jquery.js" type="text/javascript" ></script>
</head>
<body>
      <div id="study"><p>STUDY BUDDY </p> </div>     
   <div  style="float:right;"><a href="logout.php" style="text-decoration:none;"><h3">&nbsp;&nbsp;LogOut</h3></a></div>
     
   
        <form name="list" method="post" action="">
              <div class="form">
                <div id="web" class="c"><center><a href='opt.php?option=web design'><abbr title="web design">Web Design</abbr></a></center></div>
                <div id="operating" class="c1"><center><a href='opt.php?option=operating system'>operating system</a></center></div>
                <div id="programming" class="c2"><center><a href='opt.php?option=programming'>programming</a></center></div>
                <div id="data" class="c3"><center><a href='opt.php?option=data structure'>data_structure</a></center></div>
                <div id="software" class="c4"><center><a href='opt.php?option=software engineering'>software engineering</a></center></div>
                <div id="database" class="c5"><center><a href='opt.php?option=database'>database</a></center></div>
                <div id="HCI" class="c6"><center><a href='opt.php?option=HCI'>HCI</a></center></div>
            </div>
        </form>
    <div id="link">
    	<a href="studytable2.php" id="l">Go To Study Table</a>
    </div>
    <?php
		session_start();
		if(!isset($_SESSION['name']))
		{
			header("location:login_signup.php");
		}
		else
		{
			if(isset($_POST['b']))
			{
				if(empty($_POST['c']) && empty($_POST['w']))
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
						define("DATABASE","studytable");
					}
					$mysqli=new mysqli(HOST,USER,PASSWORD,DATABASE);
					$stm=$mysqli->prepare("insert into studytable.signup(category,subject)values(?,?)");
					$stm->bind_param('ss',$_POST['w'],$_POST['c']);
					if($stm->execute())
						{ 
							 session_start();
							 header("location:option.php"); 
						}
				}
		}
		}
    ?>
</body>
</html>