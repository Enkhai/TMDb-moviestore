<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<?php
	/* necessary*/
	require_once 'session.php';
	
	/*movie*/
	$repository = new \Tmdb\Repository\MovieRepository($client);
	$movieId = $_GET['movieId'];
	$movie = $repository->load($movieId); 
	
	/*image helper*/
	$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
	$config = $configRepository->load();

	$imageHelper = new \Tmdb\Helper\ImageHelper($config);

?>
<head>
<title>MovieStore | Movie: <?php echo $movie->getTitle(); ?></title>
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

<!-- our scripts-->
<script type="text/javascript">
 $(document).ready(function() { 
   $('input[name=stars-rating]').change(function(){
        $('vote-form').submit();
   });
  });
</script>

<style>
ul.list_7 {
    top: -350px;}
p.text{ display:inherit;}
	
@media(max-width:767px){
	.box_1{ padding-bottom:55px;}
}

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
       <div class="box_1">
	   <div class="search">
		    <form action="movie.php">
				<input type="text" name="search" value="Search..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
				<input type="submit" value="">
		    </form>
			</div> 
            </div>      
            <div class="box_2">
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">         
                                <?php
								echo '<span class="movie_rating">'.$movie->getVoteAverage().'</span>';
								echo '<img src="http://image.tmdb.org/t/p/original'.$movie->getPosterPath(). '" class="img-responsive" alt="">'
								?>
                                <!--<img src="images/single.jpg" class="img-responsive" alt=""/>'-->
                            </div>
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"> <strong>Title: </strong>
                            <?php
							echo $movie->getOriginalTitle();
							?>
                            </p>
                            <p class="movie_option"> <strong>Country: </strong>
                            <?php 
							$countries = $movie->getProductionCountries();
							foreach($countries as $country){
                            	echo '<a href="">'.$country->getName().'</a> ';
							}
							?>
                            </p>
                        	<p class="movie_option"><strong>Year: </strong>
                            <?php
                            echo $movie->getReleaseDate()->format('Y');
							?>
                            </p>
                        	<p class="movie_option"><strong>Category: </strong>
                            <?php 
							$genres = $movie->getGenres();
							foreach($genres as $genre){
								echo '<a href="movie.php?type=genre&genreId='.$genre->getId().'">'.$genre->getName().'</a> ';
							}
							?>
                            </p>
                        	<p class="movie_option"><strong>Release date: </strong>
                            <?php 
							echo $movie->getReleaseDate()->format('M d, Y');
							?>
                            </p>
                        	<p class="movie_option"><strong>Production Companies: </strong>
                            <?php 
							$companies = $movie->getProductionCompanies();
							foreach($companies as $company){
								echo '<a href="">'.$company->getName().'</a> ';
							}
							?>
							</p>
                        	<p class="movie_option"><strong>Actors: </strong>
                            <?php
							$credits = $movie->getCredits();
							$actors = $credits->getCast();
							foreach($actors as $actor){
                            	echo '<a href="">'.$actor->getName().'</a> ';
							}
							?>
                            <p class="movie_option"><strong>Age restriction: </strong>
                            <?php
                            $adult = $movie->getAdult();
							if($adult==true) echo '>18';
							else echo '<18';							
							?></p> 
                            <?php
                            echo '<div class="down_btn"><a class="btn1" href="https://thepiratebay.org/s/?q='.$movie->getOriginalTitle().'&video=on&category=0&page=0&orderby=99">
							<span> </span>Download</a></div>'
							?>
                         </div>
                        <div class="clearfix"> </div>
                        <p class="m_4">
						<p class="movie_option"><strong>Synopsis: </strong> <?php echo $movie->getOverview() ?> </p>
		                <div class="single">
                        <?php
						$reviews = $movie->getReviews();
						echo '<h1>' .$reviews->getTotalResults(). ' Comments</h1>';
						?>		                
		                <ul class="single_list">
                        <?php
						foreach($reviews as $review){
					        echo '<li>
					            <div class="preview"><a href="">'. '</a></div>
					            <div class="data">
					                <div class="title">'.$review->getAuthor().'</div>
					                <p>'.$review->getContent().'</p>
					            </div>
					            <div class="clearfix"></div>
					        </li>';
							}
						?>
					      
			  			</ul>
                      </div>
                      </div>
                      <div class="col-md-3">
                      <h1 style="font-size:30px;">Similar Movies</h1>
                      	
                           <?php
						   $similar = $movie->getSimilar();
						   
						   $i=0;
						   foreach($similar as $similar_movie){
							   
                      	  echo '<a title="'.$similar_movie->getOriginalTitle().'" href="/moviestore/single.php?movieId='.$similar_movie->getId().'">
						  <div class="grid_2 col_1">
							<img src="http://image.tmdb.org/t/p/original'.$similar_movie->getPosterPath(). '" class="img-responsive" alt="">
							<div class="caption1">
								<ul class="list_3 list_7">
						    		<li><i class="icon5"> </i><p>'.$similar_movie->getVoteCount().'</p></li>
						    	</ul>'.
						    	/*<i class="icon4 icon7"> </i>*/
						    	'<p class="m_3">'.$similar_movie->getOriginalTitle().'</p>
							</div>
						   </div>
						   </a>';
						   
						   if(++$i==4) break;
						   }
						   ?>
		               </div> 
                      <div class="clearfix"> </div>
                  </div>
           </div>
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