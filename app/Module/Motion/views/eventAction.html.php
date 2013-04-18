<script type="text/javascript">
    $(document).ready(function(){
        $('.carousel').carousel();
    });
</script>
<?php
$view->head()->title('Event view from '.$date);


echo '<li><a href="/event/delete/'.$stamp.'">Delete this event</a></li>
    </ul>';
        
?>
    <div id="myCarousel" class="carousel slide">

    <!-- Carousel items -->
    <div class="carousel-inner">
<?
$first = true;
foreach($frames as $frame){
	echo '<div class="item '.($first?'active':'').'"><center><img src="'.$frame->filename.'"></center>';
        echo '<div class="carousel-caption"><p>'.$frame->time_stamp.'</p></div></div>';
        $first = false;
}
?>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
    
<?
echo '<video width="640" height="480" controls>
  <source src="'.$video.'" type="video/ogg">
Your browser does not support the video tag.
</video> <br>';