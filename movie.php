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
	
	/*movie*/
	$movie_repository = new \Tmdb\Repository\MovieRepository($client);
	$genre_repository = new \Tmdb\Repository\GenreRepository($client);
	$search_repository = new \Tmdb\Repository\SearchRepository($client);
	
	/*functional load*/
	
	if(isset($_GET['type'])){
		
			switch($_GET['type']){
				case 'genre':
					$genre = $genre_repository->load($_GET['genreId']);
					if($_GET['genreId']==10769) $label ='Category: Foreign';
					else $label = 'Category: '.$genre->getName().'' ;
					
					$find = $genre_repository->getMovies($_GET['genreId']);	
					break;
				case 'upcoming':
					$label = 'Upcoming';
					$find = $movie_repository->getUpcoming();					
					break;
				case 'popular':
					$label = 'Popular';
					$find = $movie_repository->getPopular();
					break;
				case 'top':
					$label = 'Top Rated';
					$find = $movie_repository->getTopRated();
					break;
			}
		
		}
	elseif(isset($_GET['search'])){
		
			$label = 'Search: '.$_GET['search'];	
			$query = new \Tmdb\Model\Search\SearchQuery\MovieSearchQuery();
			$query->page(1);
			$find = $search_repository->searchMovie($_GET['search'], $query);
			
		}
	
	/*image helper*/
	$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
	$config = $configRepository->load();

	$imageHelper = new \Tmdb\Helper\ImageHelper($config);

?>
<head>
<title>MovieStore | <?php echo $label; ?> </title>
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

<!-- our styles -->

<style>
/*temporary*/
.list_6{ font-size:12px;}
/*temporary*/
@media(max-width:991px) and (min-width:600px){
.slider-movie-img{width:15.4vw; height:25.6vh;}
}

@media(min-width:992px){
.col-md-9{width:100%;}
.movie-test{width:33.333333%;}
.movie__option{ font-size:13px;}
.movie-test-left{height:28vh; 
/*temporary*/
min-height:220px;
}
.search-movie-img{width:100%; height:28vh;
/*temporary*/
max-width:170px;
min-height:220px;
}
.slider-movie-img{width:15.4vw; height:25.6vh;}
}
@media(max-width:991px){
.search-movie-img{max-width:130px; max-height:270px;}
.movie__info{font-size:12px;}
}
p.text{ display:inherit;}
.movie__info{width:50%;}

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
	      <div class="content">
          <div class="search">
		    <form action="movie.php">
				<input type="text" name="search" value="Search..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
				<input type="submit" value="">
		    </form>
			</div>
	   	   <h2 id="search_label" class="m_3"><?php echo $label; ?></h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <!-- Movie variant with time -->
                        <?php
						
							foreach($find as $search_movie){
								echo '<div class="movie movie-test movie-test-dark movie-test-left">
									<div class="movie__images">
										<a title="'.$search_movie->getOriginalTitle().'"
										href="single.php?movieId='.$search_movie->getId().'" class="movie-beta__link">'
										/*.$imageHelper->getHtml($search_movie->getPosterImage(), 'original', 175, 250).*/
											.'<img alt="" class="search-movie-img" src="http://image.tmdb.org/t/p/original'.$search_movie->getPosterPath(). '" 
											class="img-responsive" alt=""/>'.
										'</a>
									</div>
									<div class="movie__info">
										<a href="single.php?movieId='.$search_movie->getId().'" class="movie__title">'.$search_movie->getOriginalTitle().'</a>
										<p class="movie__time"></p> 
										<p class="movie__option">|';
										/*echo '<a href="single.php">Contray</a> | <a href="single.php">Dolor sit</a> | <a href="single.php">Drama</a>';*/
										$search_movie_genres = $search_movie->getGenres();
										foreach($search_movie_genres as $search_movie_genre){ 
										echo ' <a href="movie.php?type=genre&genreId='.$search_movie_genre->getId().'">';
										
										if($search_movie_genre->getId()==10769) echo 'Foreign';
										else echo $genre_repository->load($search_movie_genre->getId())->getName();	
																				
										echo '</a> |';
										}
										echo '</p><ul class="list_6">
											<li><i class="icon1"> </i><p>'.$search_movie->getVoteCount().'</p></li>'.
											/*<li><i class="icon3"> </i><p>546</p></li>*/
											'<li>Rating : &nbsp;&nbsp;<p>'.$search_movie->getVoteAverage().'</p></li>
											<li>Release Date: &nbsp;'.$search_movie->getReleaseDate()->format('M d, Y').'</li>
											<div class="clearfix"> </div>
										</ul>
									 </div>
									<div class="clearfix"> </div>
								</div>';
							}
						?>
                        
                              <div class="clearfix"> </div>                         
                         <!-- Movie variant with time -->
                      </div>
                      <div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Now Playing</h3>
                   <ul id="flexiselDemo3">
						<?php
				   		$slider_movies = $movie_repository->getNowPlaying();
							$slidercounter=0;	
							foreach($slider_movies as $slider_movie_1){								
								echo '<li>
								<img class="slider-movie-img"
								onClick="location.href=\'single.php?movieId='.$slider_movie_1->getId().'\'"
								title="'.$slider_movie_1->getOriginalTitle().'"
								alt="" src="http://image.tmdb.org/t/p/original'.$slider_movie_1->getPosterPath(). '" class="img-responsive" 
								alt=""/>'.
								/*.$imageHelper->getHtml($slider_movie_1->getPosterImage(), 'original', 250 , 240).*/
								'<div class="grid-flex"><a href="single.php?movieId='.$slider_movie_1->getId().'">'.$slider_movie_1->getOriginalTitle().'</a>
								<p>'.$slider_movie_1->getReleaseDate()->format('d.m.Y').'</p></div></li>';
								$slidercounter++;
								if($slidercounter==6) break;					
							}
						?>
				    </ul>
				    <script type="text/javascript">
					 $(window).load(function() {
						$("#flexiselDemo3").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
					    	responsiveBreakpoints: { 
					    		portrait: { 
					    			changePoint:480,
					    			visibleItems: 1
					    		}, 
					    		landscape: { 
					    			changePoint:640,
					    			visibleItems: 2
					    		},
					    		tablet: { 
					    			changePoint:768,
					    			visibleItems: 3
					    		}
					    	}
					    });
					    
					});
				   </script>
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>
				   <ul id="flexiselDemo1">
                   <?php
				   		$slidercounter=0;
				   		foreach($slider_movies as $slider_movie_2){								
							if($slidercounter>5) echo '<li>
							<img class="slider-movie-img"
							onClick="location.href=\'single.php?movieId='.$slider_movie_2->getId().'\'"
							title="'.$slider_movie_2->getOriginalTitle().'"
							alt="" src="http://image.tmdb.org/t/p/original'.$slider_movie_2->getPosterPath(). '" class="img-responsive" 
							alt=""/>
							<div class="grid-flex"><a href="single.php?movieId='.$slider_movie_2->getId().'">'.$slider_movie_2->getOriginalTitle().'</a>
							<p>'.$slider_movie_2->getReleaseDate()->format('d.m.Y').'</p></div></li>';
							$slidercounter++;
							if($slidercounter==12) break;					
						}
					?>
				     </ul>
				    <script type="text/javascript">
					 $(window).load(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
					    	responsiveBreakpoints: { 
					    		portrait: { 
					    			changePoint:480,
					    			visibleItems: 1
					    		}, 
					    		landscape: { 
					    			changePoint:640,
					    			visibleItems: 2
					    		},
					    		tablet: { 
					    			changePoint:768,
					    			visibleItems: 3
					    		}
					    	}
					    });
					    
					});
				   </script>
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