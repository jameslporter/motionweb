<?php
// Sets page title
// @see app/layouts/app.html.php
$view->head()->title('Welcome to motionweb!');
?>

<p><a href="/events">View Recent Events</a></p>

<h3>Camera Status</h3>
<ul>
<?php
foreach($statusCheck as $camID => $status){
	echo '<li>Camera #'.$camID. ' ';
	if($status['detectionOn']){
		echo 'Actively detecting.';
		echo '<a href="/disarm/'.$camID.'">Disarm</a>';
	}else{
		echo 'Not detecting!';
		echo '<a href="/arm/'.$camID.'">Arm</a>';
	}
	echo ' <a href="http://'.$_SERVER['HTTP_HOST'].':'.$status['config']['stream_port'].'" target="_new">Live Stream</a>';
	echo '</li>';
}
?>
</ul>