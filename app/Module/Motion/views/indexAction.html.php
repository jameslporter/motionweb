<?php
// Sets page title
// @see app/layouts/app.html.php
$view->head()->title('Welcome to motionweb!');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#armall button').click(function(){
            alert($(this).children('input[name="armall"]').val())
        });
    });
</script>

<? if($error){
    echo '<div class="alert alert-error">';
    echo '<h4>Error</h4>';
    echo $error;
    echo '</div>';
}
?>
<p><a href="/events">View Recent Events</a></p>

<h3>Camera Status</h3>
<div class="btn-group" data-toggle="buttons-radio" name="armall" id="armall">
    <button type="button" class="btn btn-primary">
        Arm All
        <input type='radio' name='armall' style='display: block; position: absolute; opacity: hidden; visibility: hidden' value='arm'/>
    </button>
    <button type="button" class="btn btn-primary">
        Disarm All
        <input type='radio' name='armall' style='display: block; position: absolute; opacity: hidden; visibility: hidden' value='disarm'/>
    </button>
</div>

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
