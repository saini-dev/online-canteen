<?php
session_start();
if(isset($_POST["s1"]))
{
	
	$un=$_POST["un"];
	$pass=$_POST["pass"];
	
	
$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
	$q="select * from admin_login where uname='$un' and pass='$pass'";
	$res=mysqli_query($conn,$q) or die("Error in query" . mysqli_error($conn));
	$count = mysqli_affected_rows($conn);
	mysqli_close($conn);
	
	if($count==1)
		{
			$x=mysqli_fetch_array($res);
			$_SESSION["n"]=$x[0];
			$_SESSION["un"]=$x[1];
      header("location:adminMain.html");
		}
    		
    else
		{
				$msg="Invalid Username/Password";
		}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="adminLogin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <title>Document</title>
  </head>
  <body>
    <form id="form" method="POST">
      <h1>Admin Login</h1>
      <div class="divemail">
        <!-- <span  class="label">Username:</span><br> -->
        <input
          id="uname"
          type="text"
          placeholder="Username"
          class="inp"
          name="un"
          required
        />
      </div>
      <div class="divpass">
        <!-- <span class="label">Password:</span><br> -->
        <input
          id="pass"
          type="password"
          placeholder="Password"
          class="inp"
          name="pass"
          required
        />
      </div>
      <button id="button" name="s1">Login</button>
      <div style="text-align:center; margin-top:20px;">
        <label style="color:red;" >
          <?php
						if(isset($msg))
						{
							print $msg;
						}
			    ?>
        </label>  
      </div>
    </form>
  </body>
  <script src="adminLogin.js"></script>
</html>
