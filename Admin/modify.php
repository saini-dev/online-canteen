<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="modify.css" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <title>Document</title>
  </head>
  <body>
    <div class="main">
      <div class="navbar">
        <h1>DCJ Canteen</h1>
        <div class="navIcons">
          <a href="http://localhost/dcj%20canteen/Admin/adminMain.html"
            ><span class="material-icons">home</span></a
          >
          <a href="http://localhost/dcj%20canteen/Admin/adminLogin.php"
            ><span id="logout" class="material-icons">logout</span></a
          >
        </div>
      </div>
      <div class="content">
        <div id="products">
            <?php
$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
  $qu="select * from inventory_table";
  $result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));
	$row=mysqli_affected_rows($conn);
  if($row==0){
    print "No Result Found";
  }
  else{
     

    while($x=mysqli_fetch_array($result)){
              if($x[5]==1)
              {
                print "<div class='productCard'>
                
                  <img
                     class='img'
                     src='$x[3]'
                     alt='item_pic'/>
                 <div class='productSubtext'>
                     <h3>$x[1]</h3>
                     <button class='removebtn showHideBtn' name='$x[0]'>Remove</button>
                 </div>
               </div>";
              }
              else{
                print "<div class='productCard'>
                  <img
                     class='img'
                     src='$x[3]'
                     alt='item_pic'/>
                 <div class='productSubtext'>
                     <h3>$x[1]</h3>
                     <button class='showbtn showHideBtn' name='$x[0]'>Show</button>
                 </div>
               </div>";
              }
              

            }
}   

            ?>
          </div>
      </div>
      <script src="./modify.js"></script>
  </body>
</html>

