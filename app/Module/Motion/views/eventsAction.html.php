<?php
// Sets page title
// @see app/layouts/app.html.php
$view->head()->title('Recently recorded motion detected events');
?>
<script>
	$(function() {
		$('.delete').click(
			function (event){
				node = $(event.currentTarget);
				$.ajax({url: event.currentTarget.href}).done(function(data){ });
				node.parent('.row').remove();
				return false;
			}
		);
	});
</script>

<?php
foreach($events as $event){
	echo '<div class="row">';
	echo '<a href="/event/'.$event->camera.'/'.$event->event_time_stamp.'">'.$event->relative.' - <a href="/event/delete/'.$event->event_time_stamp.'" class="delete">delete</a><br>';
	echo '<a href="/event/'.$event->camera.'/'.$event->event_time_stamp.'"><img src="'.$event->filename.'"></a><br/>';
	echo '</div>';

}
?>
