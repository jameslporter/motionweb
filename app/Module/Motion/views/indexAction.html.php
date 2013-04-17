<?php
// Sets page title
// @see app/layouts/app.html.php
$view->head()->title('Welcome to motionweb!');
?>
<script type="text/javascript">
    function armall() {
        $('#cameras button').each(function(v){
            $(this).removeClass('btn-danger btn-success').addClass('btn-danger').text('Disarm');
        });
    }
    function disarmall() {
        $('#cameras button').each(function(v){
            $(this).removeClass('btn-danger btn-success').addClass('btn-success').text('Arm');
        });
    }
    $(document).ready(function(){
        $('#armall button').click(function(){
            var url = '/' + $(this).children('input[name="armall"]').val() + '/all';
            $.getJSON(url, function(data){
                if (data.status == 'armed') {
                    armall();
                } else {
                    disarmall();
                }
            });
        });
        
        $('#cameras button').click(function(){
            var obj = $(this);
            if (obj.text() == 'Arm') {
                var method = 'arm';
            } else {
                var method = 'disarm';
            }
            var url = '/' + method + '/' + obj.parent().get(0).id;
            $.getJSON(url, function(data){
                if (data.status == 'armed') {
                    obj.removeClass('btn-danger btn-success').addClass('btn-danger').text('Disarm');
                } else {
                    obj.removeClass('btn-danger btn-success').addClass('btn-success').text('Arm');
                }
            });
        });
    });
</script>

<? if($error){
    echo '<div class="alert alert-error">';
    echo '<h4>Error</h4>';
    echo $error;
    echo '</div>';
}
$active = false;
$nonactive = false;
foreach($statusCheck as $camID => $status){
    if($status['detectionOn']){
        $active = true;
    } else {
        $nonactive = true;
    }
}
?>
<h3>All Camera Status</h3>
<div class="btn-group" data-toggle="buttons-radio" name="armall" id="armall">
    <? echo '<button type="button" class="btn btn-success '.($nonactive == false?'active':'').'">';?>
        Arm All
        <input type='radio' name='armall' style='display: block; position: absolute; opacity: hidden; visibility: hidden' value='arm'/>
    </button>
    <? echo '<button type="button" class="btn btn-danger '.($active == false?'active':'').'">';?>
        Disarm All
        <input type='radio' name='armall' style='display: block; position: absolute; opacity: hidden; visibility: hidden' value='disarm'/>
    </button>
</div>
<p></p>
<div name="cameras" id="cameras" >

<table class="table table-bordered table-hover">
    <caption><h3>Individual Camera Status</h3></caption>
    <thead>
<tr><th>Camera Id</th><th>Status</th><th>Stream</th></tr>
</thead>
    <tbody>
<?php
foreach($statusCheck as $camID => $status){
        echo '<tr>';
        echo '<td>'.$camID.'</td>';
	echo '<div id="'.$camID.'" name="'.$camID.'"><td>';
	if($status['detectionOn']){
                echo '<button type="button" class="btn btn-danger">Disarm</button>';
	}else{
                echo '<button type="button" class="btn btn-success">Arm</button>';
	}
	echo '</td></div>';
        echo '<td><a href="http://'.$_SERVER['HTTP_HOST'].':'.$status['config']['stream_port'].'" target="_new">Live Stream</a></td>';
        echo '</tr>';
}
?>
    </tbody>
</table>
</div>
