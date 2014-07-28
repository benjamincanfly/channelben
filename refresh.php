<?php
	
	error_reporting(11);

	ob_start();

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
			$pubDate = strftime("%B %e", $pubTimestamp);
			$pubYear = strftime("%Y", $pubTimestamp);
			$daysAgo = (time()-$pubTimestamp)/(60*60*24);
			
			$ago="";
			
			if($daysAgo>300){
				$ago="last year";
				$pubDate.=" ".$pubYear;
			} else if ($daysAgo>120){
				$ago="a few months ago";
				$pubDate.=" ".$pubYear;
			} else if ($daysAgo>60){
				$ago="a couple months ago";
				$pubDate.=" ".$pubYear;
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

	$content=ob_get_contents();
	ob_end_clean();
	file_put_contents("indexHTML.html", $content);
	
	//echo $content;
	echo "Updated successfully.";
?>