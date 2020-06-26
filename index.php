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
	
	/*movies(latest)*/
	$repository = new \Tmdb\Repository\MovieRepository($client);
	$recent_movies = $repository->getNowPlaying();
	$popular_movies = $repository->getPopular();
	
	/*image helper*/
	$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
	$config = $configRepository->load();

	$imageHelper = new \Tmdb\Helper\ImageHelper($config);
	
	$movie_counter=0;

?>
<head>
<title>MovieStore | Home</title>
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
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>

<style>
@media(min-width:992px){
.col-md-5 {width:100%}
.col-md-6 {width:20%}
.button{display:block; height:150px; width:375px; text-align:center; font-size:45px; top:1%; right:65%}
ul.callbacks_tabs.callbacks1_tabs{ bottom:70%}
.slider-movie{cursor:pointer;}
.movie-poster{width:100%; height:30vh;}
}
@media(max-width:767px){
	.button{display:block; height:100px; width:250px; text-align:center; font-size:28px; top:1%; right:35%}
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
				 else echo '<li><p><a href="login.php?redirect='.urlencode($_SERVER['REQUEST_URI']).'">Login here</a></p></li>
				 <li class="last">'/*<i class="edit"> </i>*/.'</li>';
				 
				 ?>
				 <div class="clearfix"> </div>
			   </ul>
			</div>
			<div class="clearfix"> </div>
	      </div>
	   <div class="slider" >
	   <div class="callbacks_container">
	      <ul class="rslides" id="slider">
          <?php
		  $i=0;
		  	foreach($recent_movies as $recent_movie){
				$movie_id = $recent_movie->getId();
				echo '<li class="slider-movie" title="'.$recent_movie->getOriginalTitle().'" 
				onClick="location.href=\'single.php?movieId='.$movie_id.'\'">'.
				$imageHelper->getHtml($recent_movie->getPosterImage(), 'original', 1194, 407).
					'<div class="button">
					<a href="single.php?movieId='.$movie_id.'" class="hvr-shutter-out-horizontal">Playing now</a>
					</div>'
					.'
				</li>';
				if(++$i==5) break;
			}
			?>
	      </ul>
	    </div>
      <div class="content">
      	<div class="box_1">
      	 <h1 class="m_2">Popular Movies</h1>
      	 <div class="search">
		    <form action="movie.php">
				<input type="text" name="search" value="Search..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
				<input type="submit" value="">
		    </form>
		</div>
		<div class="clearfix"> </div>
		</div>
		<div class="box_2">			
           <div class="grid_3" max-width="290px">
           
               <?php
			   foreach($popular_movies as $popular_movie){
				   echo '<div class="col-md-6 grid_7">
					   <div class="col_2" >
							<ul class="list_4">
								<li><i class="icon1"> </i><p>'.$popular_movie->getVoteCount().'</p></li>
								<li><i class="icon2"> </i><p>'.sizeof($popular_movie->getReviews()).'</p></li>'.
								/*<li><i class="icon3"> </i><p>546</p></li>*/
								'<li>Rating : &nbsp;&nbsp;<p>'.$popular_movie->getVoteAverage()/*<img src="images/rating1.png" alt=""/>*/.'</p></li>
								<li>Release Date: &nbsp;<span class="m_4">'.$popular_movie->getReleaseDate()->format('M d, Y').'</span> </li>
								<div class="clearfix"> </div>
							</ul>
							<div class="m_5"><a title="'.$popular_movie->getOriginalTitle().'" href="single.php?movieId='.$popular_movie->getId().'">
							<img alt="" src="http://image.tmdb.org/t/p/original'.$popular_movie->getPosterPath(). '" class="img-responsive movie-poster" alt=""/>'
							/*$imageHelper->getHtml($popular_movie->getPosterImage(), 'original', 200, 228)*/
							/*<img src="images/pic3.jpg" class="img-responsive" alt=""/>*/.'</a></div>
					   </div>
				 </div>';
			   }
			 ?>
                            
			   <div class="clearfix"> </div>
			</div>
       
			<div class="clearfix"> </div>
		</div>
      </div>
   </div>
 </div>
 
<div class="container"> 
 <footer id="footer">
 	<div id="footer-3d">
		<div class="gp-container">
			<span class="first-widget-bend"></span>
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
					<h3 id="categories">Categories</h3>
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