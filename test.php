<html>
<head>
<?php

	require_once 'session.php';
	
	/*image helper*/
	$configRepository = new \Tmdb\Repository\ConfigurationRepository($client);
	$config = $configRepository->load();

	$imageHelper = new \Tmdb\Helper\ImageHelper($config);
	
	$repository = new \Tmdb\Repository\GenreRepository($client);
	$genres = $repository->loadMovieCollection();
	
	$movierepository = new \Tmdb\Repository\MovieRepository($client);
	$movieId = 87421;
	$movie = $movierepository->load($movieId);
?>
<title>test</title>
</head>
<body>
<div id="myDropdown" class="dropdown-content">
    <?php
		foreach ($genres as $genre) {
			echo '<a href="' .$genre->getId(). '">' .$genre->getName(). '</a>';
		}
		
		$find = $repository->getMovies(28);
		foreach($find as $genre_movie){
			echo $genre_movie->getOriginalTitle();
			echo '<br><br><br>';
		}
		
		$reviews = $movie->getReviews();
		
		foreach ($reviews as $review){
			$author = $review->getAuthor();
			echo $author;
			echo $review->getContent().'<br><br><br>';
		}
		
		$movies = $movierepository->getLatest();
		
		foreach($movies as $latest_movie){
			echo $latest_movie->getOriginalTitle();
			echo '<br><br><br>';
		}
		
		
		if(isset($_COOKIE['moviestore_account_name'])){
			echo $_COOKIE['moviestore_account_name'];
		}
		
	?>
  </div>
</body>
</html>