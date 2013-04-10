<?php
$view->head()->title('Event view from '.$date);


echo '<nav class="top-bar 12 columns fixed"><ul>
	<li class="name"><h1><a href="/">Home</a></h1></li>
	<li><a href="'.$view->url('motionEvents','home').'">Recent Events</a></li>';
	echo '<li><a href="/event/delete/'.$stamp.'">Delete this event</a></li>
	</ul></nav>';
        
echo '<video width="640" height="480" controls>
  <source src="'.$video.'" type="video/ogg">
Your browser does not support the video tag.
</video> <br>';
foreach($frames as $frame){
	echo '<img src="'.$frame->filename.'"><br>';
}
