<!DOCTYPE html>
<html>
<head>
	<title>Aventura</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="override.css">
	<!-- First include jquery js -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- Then include bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <script type="text/javascript" src="js/changebg.js" async></script>
</head>
<body>
    <div class="content">
      <header>
        <h2><a href="#">AVENTURA</a></h2>
        <nav>
          <li><a href="register.html">Get Started</a></li>
          <li><a href="about-us.html">About</a></li>

        </nav>
      </header>

      <div class="Tagline">
        <h1>EXPLORE BEYOND BOUNDARIES</h1>
        <h3>Embark on Endless Adventures and Create Timeless Memories</h3>
        <br> <br> 
        <div class="buttons-flex">
          <a href="userlogin.html" class="button">Login</a>
          <a href="register.html" class="button">Sign Up</a>
        </div>
      </div>
    </div>


		<div class="survey">
			<div class="surveyText"> Can't decide where to go on your holiday? Take a quick survey and get instant recommendation of places in India to visit!</div>
			<div class="surveyBtn"><a href="survey.php"><button class="yellowBtn">Take Survey</button></a></div>
		</div>
	</div> <!--home ends-->

	<?php

  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $db='letstravel';
  $conn = mysqli_connect($servername,$username,$password,$db);
  if (!$conn) 	
  {			
      die("Connection failed: " . mysqli_connect_error());
  }

  echo '<!--upcoming section-->
  <div class="sectionHeader" id="Upcoming">
    <div class="header">
      <div class="headingText">Upcoming Trips</div>
      <div class="viewAllBtn"><button class="secondaryBtn" type="button" id="VABtn" data-toggle="collapse" data-target="#AllTrips" aria-expanded="false" aria-controls="AllTrips" onclick="javascript:toggleText();">View All</button></div>
    </div>
    <div id ="cards" class="row mx-auto">';

  $sql="SELECT * FROM trip WHERE Status=1";
  
  $result = mysqli_query($conn,$sql);
  $rows = mysqli_num_rows($result);
  if($rows<=4)
  {  $limit = $rows;}
  else
  {  $limit = 4;}
  for($i=0;$i<$limit;$i++)
  {
    $tripID = mysqli_fetch_assoc($result);
    $sql2='SELECT locations from trip_location where tripId="'.$tripID["TripId"].'"';
    $result2 = mysqli_query($conn,$sql2);
    $rows2 = mysqli_num_rows($result2);
    $temp =  mysqli_fetch_assoc($result2);
    $locs = $temp["locations"];
    for($j=1;$j<$rows2;$j++)
    {
      $temp =  mysqli_fetch_assoc($result2);
      $locs=$locs." - ".$temp["locations"];
    }

    echo 
        '<div class="col-sm-3">
          <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="uploads/'.$tripID["Image"].'"Card image cap">
              <div class="card-body">
                <h5 class="card-title">'.$locs.'</h5>
                <p class="card-text">Starting from ₹'.$tripID["BasePrice"].'</p>
                <form action="home.php" method="post">
                 <a href="#" data-toggle="modal" data-target="#tripDetails'.$i.'" class="toggle" class="viewBtn"><input type="submit" name="trip_sel" value="View Details" class="viewBtn"> </a>
                </form>
              </div>
          </div>
        </div>'
      ;

      echo '<!--modal-->
      <form action="join.php" method="post">
      <input type="hidden" name="tripid" value="'.$tripID["TripId"].'">
    <div class="modal fade" id="tripDetails'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">'.$locs.'</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="carouselimg">
                <img class="img-fluid" src="uploads/'.$tripID["Image"].'">
                <div class="modalText">
                  <label><b>Date:</b> '.$tripID["StartDate"].' to '.$tripID["EndDate"].'<br>
                  <a href="uploads/'.$tripID["Itinerary"].'" download class="downloadFile">Download itinerary</a><br>
                  <label><b>Price:</b> ₹'.$tripID["BasePrice"].'*</label>
                  <p id="terms">* The charges mentioned above includes only the base price of the trip for the mentioned location, exclusive of accommodation and travel charges from your city. </p>
              </div>
           
            </div>
            <div class="modal-footer">
              <input type="submit" class="yellowBtn joinBtn" name="tripjoined" value="Join Now"></form>
            </div>
        </div>
      </div>
  </div>
    <!--modal ends-->'; 

  }
  if($rows>4)
  {
    echo '<div class="collapse" id="AllTrips">';
    for($i=4;$i<$rows;$i++)
  {
    $tripID = mysqli_fetch_assoc($result);
    $sql2='SELECT locations from trip_location where tripId="'.$tripID["TripId"].'";';
    $result2 = mysqli_query($conn,$sql2);
    $rows2 = mysqli_num_rows($result2);
    $temp =  mysqli_fetch_assoc($result2);
    $locs = $temp["locations"];
    for($j=1;$j<$rows2;$j++)
    {
      $temp =  mysqli_fetch_assoc($result2);
      $locs=$locs." - ".$temp["locations"];
    }

    echo 
        '<div class="col-sm-3">
          <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="uploads/'.$tripID["Image"].'"Card image cap">
              <div class="card-body">
                <h5 class="card-title">'.$locs.'</h5>
                <p class="card-text">Starting from ₹'.$tripID["BasePrice"].'</p>
                <form action="home.php" method="post">
                 <a href="#" data-toggle="modal" data-target="#tripDetails'.$i.'" class="toggle" class="viewBtn"><input type="submit" name="trip_sel" value="View Details" class="viewBtn"> </a>
                </form>
              </div>
          </div>
        </div>'
      ;

      echo '<!--modal-->
       <form action="join.php" method="post">
      <input type="hidden" name="tripid" value="'.$tripID["TripId"].'">
    <div class="modal fade" id="tripDetails'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">'.$locs.'</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="carouselimg">
                <img class="img-fluid" src="uploads/'.$tripID["Image"].'">
                <div class="modalText">
                  <label><b>Date:</b> '.$tripID["StartDate"].' to '.$tripID["EndDate"].'<br>
                  <a href="uploads/'.$tripID["Itinerary"].'" download class="downloadFile">Download itinerary</a><br>
                  <label><b>Price:</b> ₹'.$tripID["BasePrice"].'*</label>
                  <p id="terms">* The charges mentioned above includes only the base price of the trip for the mentioned location, exclusive of accommodation and travel charges from your city. </p>
              </div>
           
            </div>
            <div class="modal-footer">
               <input type="submit" class="yellowBtn joinBtn" value="Join Now" name="tripjoined"></form>
            </div>
        </div>
      </div>
  </div>
    <!--modal ends-->'; 

  }
      echo '</div>';
  }

  echo  '</div></div>';
  ?>
  
    <!--footer-->
    	<footer class="page-footer font-small pt-4">
    	<div class="container-fluid text-center text-md-left">
      		<div class="row">
        		<div class="col-md-6 mt-md-0 mt-3">
          			<h6 class="footerText">Contact Us</h6>
          			<p class="footerText"><i class="fa fa-envelope icon" aria-hidden="true"></i> aventura.com</p>
          			<p class="footerText"><i class="fa fa-phone icon" aria-hidden="true"></i> 1800-676-333 (9:00 am to 9:00 pm)</p>	
        		</div>
        		<hr class="clearfix w-100 d-md-none pb-3">
        		<div class="col-md-3 mb-md-0 mb-3">
          		</div>
         	 	<div class="col-md-3 mb-md-0 mb-3">
            		<ul class="list-unstyled">
             			<li><a href="#!" class=" footerText">About Us</a></li>
              			<li><a href="#!" class=" footerText">Terms and Conditions</a></li>
              			<li><a href="#!" class=" footerText">Privacy Policy</a></li>
            		</ul>
          		</div>
      		</div>
    	</div>
    	
    	
    	<div class="footer-copyright text-center py-3 madeby">
    		<font style="color:  #15a18ef4"> AVENTURA &copy; 2024</font>
    	</div>
  	</footer>

</body>
</html>


