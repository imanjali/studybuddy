<html>
    <head>
        <title>study buddy</title>
        <script src="libraries/jquery.js" type="text/javascript" ></script>
        <link rel="stylesheet" href="login_style.css">
	</head>
    <body>
    
    	
            	  <div id="study"><p>STUDY BUDDY </p></div>                  
       	     
        
       
            <div id="down">          
                <?php
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
                        if(isset($_POST['signup']))
                        {
							$username=$_POST['username'];
							$password=$_POST['password'];
							$DOB=$_POST['DOB'];
							$standard=$_POST['standard'];
							$email_id=$_POST['email_id'];
							$phone_no=$_POST['phone_no'];
							$city=$_POST['city'];
							$address=$_POST['address'];
							$doj=date("1 iS \of F Y h:i:s A");
							$stm=$mysqli->prepare("select `username` from studytable.signup where username='$username'");
							$stm->execute();
							$stm->bind_result($u);
							$stm->store_result();
							$stm->fetch();
							$row=$stm->num_rows;
							if($row>0)
							{
								echo '<script>alert("username exists,Please enter another name");</script>';
							}
							else
							{
							
								$stm=$mysqli->prepare("insert into studytable.signup(username,password,DOB,standard,email_id,phone_no,city,address,doj) 													       									values(?,?,?,?,?,?,?,?,?)");
								$stm->bind_param('sssssisss',$username,$password,$DOB,$standard,$email_id,$phone_no,$city,$address,$doj);
								if($stm->execute())
								{
									session_start();
									$_SESSION['name']=$username;
									header("location:category.php");
								}
								else
								{
									echo '<script>alert("check your details");</script>';
								}
							}
                        }
                        if(isset($_POST['login']))
                        {
							$username=$_POST['username'];
							$password=$_POST['password'];
							$stm=$mysqli->prepare("select `username`,`password` from studytable.signup where username='$username'");
							$stm->execute();
							$stm->bind_result($userfromdb,$passfromdb);
							$stm->store_result();
							if($stm->fetch() && $passfromdb===$password)
							 {
							    session_start();
								$_SESSION['name']=$username;
								header("location:category.php");	
							 }
							else
							 {
								echo '<script>alert("enter the values");</script>';
							 }
                        }
                ?>
                <div id="ex">
                	<h1 id ="b"><marquee>STUDY & SUCCEED</marquee></h1>
                    <h2><div id="a">Our tutorials,written in </div> <div id="a2">a very understandable way,</div> <div id="a3">help any student easily master any subject</div></h2>
                                    </div>
                
             <div id="down">
                                    

                                    <div id="headl"><a id="l"><h3>Login</h3></a></div><br/><br/>
                                    <div id="form">
                                        <form name="log" action="" method="POST">
                                             <input type="text" name="username" placeholder="username" class="s1" autofocus="on" required/><br/>
                                             <input type="password" name="password" placeholder="password" class="s2" required/><br/>
                                             <input type="submit" name="login" value="login" class="b1">
                                        </form>
                                        
                          </div>  
                          <img src="images/p1.jpg" id="i">
                         
                                                  <div class="sign_outer">
                             <div class="sign_inner">
                                <div class="sign_main">
                                    <div id="heads">
                                        <h1 class="head">Signup</h1>
                                    </div><br/>
                                    <div id="form">
                                    <form name="sign" action="" method="POST"><br/>
                                        <input type="text" name="username" id="demo" placeholder="Username" class="s"/><br/>
                                        <input type="text" name="password" id="demo" placeholder="Password" class="s"/ ><br/>
                                        <input type="date" name="DOB" id="demo" placeholder="DOB" class="s"/ ><br/>
                                        <input type="text" name="standard" id="demo" placeholder="Standard" class="s"/ ><br/>
                                        <input type="email" name="email_id" id="demo" placeholder="Email-id" class="s"/ ><br/>
                                        <input type="text" name="phone_no" id="demo" placeholder="Phone no." class="s"/ ><br/>  
                                        <input type="text" name="city" id="demo" placeholder="city" class="s"/ ><br/>
                                        <input type="text" name="address" id="demo" placeholder="address" class="s"/> <br/>        
                                        <input type="submit" name="signup" id="but" value="Signup" class="b"/><br/>
                                     </form>
                                     </div>
                                     
                                </div>
                             </div>
                         </div>
                        </div>  
                </div>
              
        </section>        	
    </body>
</html>