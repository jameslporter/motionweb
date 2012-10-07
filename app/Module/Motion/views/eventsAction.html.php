<?php
// Sets page title
// @see app/layouts/app.html.php
$view->head()->title('Recently recorded motion detected events');

foreach($events as $event){
	echo '<a href="/event/'.$event->event_time_stamp.'">'.$event->relative.'<br><img src="'.$event->filename.'"></a><br/>';
}