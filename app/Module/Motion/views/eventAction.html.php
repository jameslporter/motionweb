<?php
$view->head()->title('Event view from '.$date);


echo '<li><a href="/event/delete/'.$stamp.'">Delete this event</a></li>
    </ul>';
        
echo '<video width="640" height="480" controls>
  <source src="'.$video.'" type="video/ogg">
Your browser does not support the video tag.
</video> <br>';
foreach($frames as $frame){
	echo '<img src="'.$frame->filename.'"><br>';
}
