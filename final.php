<html>
<head>
	<title>final</title>
	<script type="text/javascript" src="libraries/jquery.js"></script>
	<script src="libraries/tracking-min.js"></script>
  	<script src="libraries/face-min.js"></script>
  	<script src="libraries/dat.gui.min.js"></script>
  	<link rel="stylesheet" href="final_style.css" />
</head>
<body>
        <div class="heading">Study  Buddy</div>
        <script>
			
			var trackNow;
			function tracker_face()
			{
				clearTimeout(trackNow);
				trackNow=setTimeout(function()
				{
				alert("hey...please concentrate");
				      },1000);
			}	
			window.onload = function()
			 {
			 // tracker_face(1); 
				  var video = document.getElementById('video');
				  var canvas = document.getElementById('canvas');
				  var context = canvas.getContext('2d');
				  var tracker = new tracking.ObjectTracker('face');
				  tracker.setInitialScale(4);
				  tracker.setStepSize(2);
				  tracker.setEdgesDensity(0.1);			
				  tracking.track('#video', tracker, { camera: true });			
				  tracker.on('track', function(event)
				   {					 
						context.clearRect(0, 0, canvas.width, canvas.height);			
						event.data.forEach(function(rect) 
						 {
							
							tracker_face();						
						 });
				  });
			}			
			function timer(r)
			{
				setTimeout(function(){	
				alert ("Time Out");						
					},10000000);
			}
    </script>
    <?PHP 
		session_start();
		if(isset($_GET['book']))
		{
		$bookid=$_GET['book'];
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
		if(!isset($_SESSION['name']))
		{
			header("location:login_signup.php");
		}
		else
		{
			$stm=$mysqli->prepare("select `studytable` from studytable.signup where  username='".$_SESSION['name']."'");
			$stm->execute();
			$stm->bind_result($array);
			$stm->store_result();
			$stm->fetch();
			$array=unserialize($array);
			foreach($array as $arraynow){
				if($arraynow['bookid']==$bookid)
				{
					$timing=$arraynow['bookid'];
					echo "<script>timer(".$timing.");</script>";
				}
		}
		
		if(isset($_GET['book']))
		{
			$bookid=$_GET['book'];
			$stm=$mysqli->prepare("select `name`,`location` from studytable.books where book_id='$bookid'");
			$stm->execute();
			$stm->bind_result($name,$loc);
			$stm->store_result();
			$stm->fetch();
			$f= "<iframe src ='";
			$f.=$loc;
			$f.="' allowfullscreen webkitallowfullscreen></iframe>";
			echo $f;
		}
	}
	}
    ?>
    <div class="demo-frame" style='opacity:0'>
        <div class="demo-container">
          <video id="video" width="320" height="320" preload autoplay loop muted></video>
          <canvas id="canvas" width="320" height="320"></canvas>
        </div>
    </div>
</body>
</html>