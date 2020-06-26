<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<?php
	/*necessary*/
	require_once 'session.php';
		
?>
<head>
<title>MovieStore | Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<style>
.login-right input[type="password"] {
    border: 1px solid #E4E4E4;
    outline-color: #d8232a;
    width: 96%;
    font-size: 0.8125em;
    padding: 10px;
    -webkit-appearance: none;
}
p.text{ display:inherit;}

@media(max-width:640px){
	
	.nav{ 
		width:50%;
		float:left;
	}
	.header_right{
		width:50%;
		float:right;		
	}
}
.logout_img{
	width:17px; 
	height:19px;
	margin-top:6px;
}
@media(max-width:640px){
	.logout_img{
		margin-top:auto;
		margin-bottom:4px;
	}
}

/*dropdown add-on*/
.dropdown {
    position: relative;
    display: inline-block;
	z-index:12;
	font-size:18px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
	font-size:15px;
}

.dropdown-content a{
	color:#d8232a;	
	}
	
.dropdown:hover .dropdown-content {
    display: block;
}
</style>

</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-3 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
		    <div class="col-sm-6 nav"> 
             <div class="dropdown">
              <span>Categories</span>
              <div class="dropdown-content">
              <?php
					$genre_repository = new \Tmdb\Repository\GenreRepository($client);
					$show_genres = $genre_repository->loadMovieCollection();
					foreach($show_genres as $genre){
						echo '<p><a href="movie.php?type=genre&genreId='.$genre->getId().'">'.$genre->getName().'</a></p>';
					}
				?>
                <p><hr style="height:1px; background-color:black;"></p>
                <p><a href="movie.php?type=upcoming">Upcoming</a></p>
				<p><a href="movie.php?type=popular">Popular</a></p>
				<p><a href="movie.php?type=top">Top Rated</a></p>
              </div>
            </div>
			</div>
			<div class="col-sm-3 header_right">
			   <ul class="header_right_box">
				 <li> </li>
                 <?php
				 
				 if(isset($_COOKIE['moviestore_account_name']))
				 echo '<li>
				 <p>
				 <a title="'.$_COOKIE['moviestore_account_name'].'\'s Profile — The Movie Database (TMDb)" 
				 href="https://www.themoviedb.org/u/'.$_COOKIE['moviestore_account_name'].'">'.$_COOKIE['moviestore_account_name'].
				 '</a>
				 </p>
				 </li>
				 <li title="Logout" class="last">
				 <i class="edit" style="background:none;"> 
				 <a href="cookie_delete.php?name=moviestore_account_name&redirect='.urlencode($_SERVER['REQUEST_URI']).'"> 
				 <img class="logout_img" src="./images/shutdown-hi.png"> 
				 </a>
				 </i>
				 </li>';
				 else echo '<li><p><a href="login.php?redirect=login.php">Login here</a></p></li>
				 <li class="last">'/*<i class="edit"> </i>*/.'</li>';
				 
				 ?>
				 <div class="clearfix"> </div>
			   </ul>
			</div>
			<div class="clearfix"> </div>
	      </div>
	      <div class="content" style="width:100%;">
      	     <div class="register">
             <?php
			 	
				if(isset($_COOKIE['moviestore_account_name'])) echo '<div style="color:red; text-align:center; font-size:45px;"> You are already logged in</div>';
			 	else{ 
				echo 
				'<div class="col-md-6 login-left">
			  	 <h3>New Users</h3>
                 <p>By creating an account on The Movie Database, you will be able to rate and submit your comments on the movies you like on our website. MovieStore is closely connected 
                 to The Movie Database, where you can view your profile and further details on every movie and TV series from around the world.</p>
				 <a class="acount-btn" href="https://www.themoviedb.org/account/signup">Create an Account</a>
			   </div>
			   <div class="col-md-6 login-right">
			  	<h3>Registered Users</h3>
				<p>If you have an account with us, please log in.</p>
				<form action="session_update.php" method="post">
				  <div>
					<span>User name (case sensitive)<label>*</label></span>
					<input name="user" type="text"> 
				  </div>
				  <div>
					<span>Password<label>*</label></span>
					<input name="pass" type="password"> 
				  </div>
				  <input name="redirect" type="hidden" value="';
				  if (isset($_GET['redirect']))echo $_GET['redirect'];
				  else echo '';
				  echo '">
				  <label>';
				  if(isset($_GET['error'])) echo 'Wrong credentials';
				  echo '</label> <br>				  
				  <a class="forgot" href="https://www.themoviedb.org/account/reset-password">Forgot Your Password?</a>
				  <input type="submit" value="Login">
			    </form>
			   </div>	
			   <div class="clearfix"> </div>
		     </div>';
				}
			 
			 ?>
           </div>
    </div>
</div>
<div class="container"> 
 <footer id="footer">
 	<div id="footer-3d">
		<div class="gp-container">
			<span class="first-widget-bend"> </span>
		</div>		
	</div>
    <div id="footer-widgets" class="gp-footer-larger-first-col">
		<div class="gp-container">
            <div class="footer-widget footer-1">
            	<div class="wpb_wrapper">
					<img src="images/f_logo.png" alt=""/>
				</div> 
	          <br>
	          <p>Movie Store. Template provided by w3layouts.com. Website constructed by Will "Ceyx" Moschopoulos and Evaggelos "Vaggs" Emmanouilidis</p>
			  <p class="text">API "php-tmdb-api" created by Micheal Roterman based on The Movie Database(www.themoviedb.org). </p>
			 </div>
			 <div class="footer_box">
			  <div class="col_1_of_3 span_1_of_3">
					<h3>Categories</h3>
					<ul class="first">
						<?php
							$genre_repository = new \Tmdb\Repository\GenreRepository($client);
							$show_genres = $genre_repository->loadMovieCollection();
							foreach($show_genres as $genre){
								echo '<li><a href="movie.php?type=genre&genreId='.$genre->getId().'">'.$genre->getName().'</a></li>';
								}
						?>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<h3>Information</h3>
					<ul class="first">
						<li><a href="movie.php?type=upcoming">Upcoming</a></li>
						<li><a href="movie.php?type=popular">Popular</a></li>
						<li><a href="movie.php?type=top">Top Rated</a></li>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<h3>Follow Us</h3>
					<ul class="first">
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Twitter</a></li>
						<li><a href="#">Youtube</a></li>
					</ul>
					<div class="copy">
				      <p>&copy; 2015 Template by <a href="http://w3layouts.com" target="_blank"> w3layouts</a></p>
			        </div>
		     </div>
		    <div class="clearfix"> </div>
	        </div>
	        <div class="clearfix"> </div>
		</div>
	</div>
  </footer>
</div>		
</body>
</html>