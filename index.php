<?php

error_reporting(11);

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
	<base target="_blank">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Channel Ben</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

		<link rel="alternate" type="application/rss+xml" title="RSS" href="http://gdata.youtube.com/feeds/base/users/BenjaminApple/uploads?alt=rss&amp;v=2&amp;orderby=published&amp;client=ytapi-youtube-profile"/>
		
		<link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
		<link rel="icon" type="image/png" href="/img/favicon.png"/>
		
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

		<div id="everything">
			<div id="header">Hey idiot! I'm <a href='http://www.twitter.com/benjaminapple'>Benjamin Apple</a> and I upload a video to my <a href="http://www.youtube.com/benjaminapple">YouTube channel</a> Monday through Friday every single week. <a href="mailto:benjamincanfly@gmaiml.com">Email me!</a></div>
			
			<div id="content">
					<div id="text">
					
						<div id="videos">
						
							<?php
						
						
								$playlists = simplexml_load_file('http://gdata.youtube.com/feeds/api/users/benjaminapple/playlists');
							
								//echo "<br/><pre>".print_r($playlists, true)."</pre><br/>";
							
								foreach ($playlists->entry as $playlist){
									echo '<div class="playlist">';
									
									//echo '<div class="title"> '.$playlist->title.'</div>';
									
									$thisID = str_replace ("http://gdata.youtube.com/feeds/api/users/benjaminapple/playlists/", "", $playlist->id);
								
									$playlistVideosXML=simplexml_load_file("http://gdata.youtube.com/feeds/api/playlists/".$thisID);
									//echo "<br/>Playlist URL: http://gdata.youtube.com/feeds/api/playlists/".$thisID."<br/>";
									
									$i=0;
									foreach($playlistVideosXML->entry as $video){
										
										$videoURL=parse_url($video->link[0]['href']);
										parse_str($videoURL['query']);
										
										$pubTimestamp=strtotime($video->published);
										$pubDate = strftime("%b %e", $pubTimestamp);
										$daysAgo = (time()-$pubTimestamp)/(60*60*24);
										
										$ago="";
										
										if($daysAgo>300){
											$ago="last year";
										} else if ($daysAgo>120){
											$ago="a couple few ago";
										} else if ($daysAgo>60){
											$ago="a couple months ago";
										} else if ($daysAgo>21){
											$ago="a few weeks ago";
										} else if ($daysAgo>10){
											$ago="a couple weeks ago";
										} else if ($daysAgo>6){
											$ago="last week";
										} else if ($daysAgo>1){
											$ago="a few days ago";
										} else if ($daysAgo==1){
											$ago="yesterday";
										} else {
											$ago="today";
										}
										
										if ($i==0){
											
											echo '<div class="big_video">';
											echo '<iframe width="640" height="360" src="//www.youtube.com/embed/'.$v.'" frameborder="0" allowfullscreen></iframe>';
											
											echo '<a href="http://www.youtube.com/watch?v='.$v.'" class="title">'.$video->title.'<span class="uploaded">Uploaded '.$ago.' ('.$pubDate.')</span></a>';
											
											echo '</div>';
											
										} else {
											
											if($i==1){
												echo '<div class="videos_4">';
											}
											
											echo '<div class="video_wrapper"><div class="video" style="background-image:url(https://i.ytimg.com/vi/'.$v.'/mqdefault.jpg)">';
											
											//echo "<br/>Video: ".$video->title;
											//echo "<br/>Link: ".$video->link[0]['href'];
											$videoURL=parse_url($video->link[0]['href']);
											parse_str($videoURL['query']);
											//echo '<iframe width="278" height="200" src="//www.youtube.com/embed/'.$v.'" frameborder="0" allowfullscreen></iframe>';
											echo '<a href="http://www.youtube.com/watch?v='.$v.'"></a>';
											
											// ?list='.$thisID.
											echo '</div>';
											
											echo '<a href="http://www.youtube.com/watch?v='.$v.'" class="title">'.$video->title.'<span class="uploaded">Uploaded '.$ago.' ('.$pubDate.')</span></a>';
											
											echo '</div>';
											
										}
										
										$i++;
										
									}
									
									if($i>1){ echo '</div>'; }
									
									//echo '<br clear="all"/>';
									echo '</div>';
									
								}
							
							?>
							
						</div>
					</div>
			</div>
		</div>
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-1029946-16', 'cubedseries.com');
	  ga('send', 'pageview');

	</script>
    </body>
</html>
