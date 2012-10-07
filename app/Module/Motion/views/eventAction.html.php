<?php
$view->head()->title('Event view from '.$date);
echo '<p><a href="'.$view->url('motionEvents','home').'">Recent Events</a></p>';
echo '<p><a href="/event/delete/'.$stamp.'">Delete this event</a></p>';
foreach($frames as $frame){
	echo '<img src="'.$frame->filename.'"><br>';
}