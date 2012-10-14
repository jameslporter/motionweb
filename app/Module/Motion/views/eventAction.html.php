<?php
$view->head()->title('Event view from '.$date);


echo '<nav class="top-bar 12 columns fixed"><ul>
	<li class="name"><h1><a href="/">Home</a></h1></li>
	<li><a href="'.$view->url('motionEvents','home').'">Recent Events</a></li>';
	echo '<li><a href="/event/delete/'.$stamp.'">Delete this event</a></li>
	</ul></nav>';
foreach($frames as $frame){
	echo '<img src="'.$frame->filename.'"><br>';
}
