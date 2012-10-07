<?php
namespace Module\Motion;

use App;
use Alloy, Alloy\Request;
require dirname(__FILE__).'/idiorm/idiorm.php';

//include 'MotionService.php';
/**
 * Motion Module
 * 
 * Extends from base Application controller so custom functionality can be added easily
 *   lib/App/Module/ControllerAbstract
 */
class Controller extends App\Module\ControllerAbstract
{
    /**
     * Index
     * @method GET
     */
    function __construct($kernel){
    	$this->motion = new MotionService();
    	\ORM::configure('mysql:host='.$kernel->config('app.database.master.host', 'localhost').';dbname='.$kernel->config('app.database.master.database', 'motion'));
		\ORM::configure('username', $kernel->config('app.database.master.username', 'motionuser'));
		\ORM::configure('password', $kernel->config('app.database.master.password', 'motionpassword'));
    	parent::__construct($kernel);

    }
    public function indexAction(Request $request){
    	$status = $this->motion->statusCheck();
    	return $this->template(__FUNCTION__)
        	->set(array('statusCheck' => $status));
    }


    public function eventsAction()
    {
		$events = \ORM::for_table('security')->distinct('event_time_stamp')->group_by('event_time_stamp')->where('file_type',1)->order_by_desc('event_time_stamp')->find_many();
		foreach($events as $event){
			if(strstr($event->filename,'captured')){
	            $event->filename = '/captured/'.basename($event->filename);
	        }else{
	        	$event->filename = '/capture/'.$event->camera.'/'.basename($event->filename);
	        }
			$event->relative = $this->relativeTime(strtotime($event->event_time_stamp));
			$event->event_time_stamp = strtotime($event->event_time_stamp);
		}
        return $this->template(__FUNCTION__)->set(array('events' => $events));
    }
    /**
     * Event
     * @method GET
     * @param $stamp
     */
    public function eventAction(Request $request)
    {
		$date = date("Y-m-d H:i:s", $request->param('stamp'));
        $frames = \ORM::for_table('security')->order_by_asc('time_stamp')->where('file_type',1)->where('event_time_stamp',$date)->find_many();
        $video = \ORM::for_table('security')->where('file_type',8)->where('event_time_stamp',$date)->find_one();
        foreach($frames as $frame)
        {
        	if(strstr($frame->filename,'captured')){
	            $frame->filename = '/captured/'.basename($frame->filename);
	        }else{
	        	$frame->filename = '/capture/'.$frame->camera.'/'.basename($frame->filename);
	        }
        }
        return $this->template(__FUNCTION__)->set(array('frames' => $frames, 'stamp' => $request->param('stamp'), 'video' => basename($video->filename), 'date' => $date));
    }
    public function eventDeleteAction(Request $request)
    {
    	$date = date("Y-m-d H:i:s", $request->param('stamp'));
        $frames = \ORM::for_table('security')->where('event_time_stamp',$date)->find_many();
        foreach($frames as $frame){
                if(file_exists($frame->filename)){
                        unlink($frame->filename);
                }
        }
        $frames = \ORM::for_table('security')->where('event_time_stamp',$date)->delete_many();
        return $this->kernel->redirect('/events',307);
    }
    /**
     * Disarm
     * @method GET
     * @param $camera
     */
    public function disarmAction(Request $request)
    {
    	$this->motion->detection('pause', $request->param('camera'));
    	return $this->kernel->redirect('/',307);
    }
    public function armAction(Request $request)
    {
    	$this->motion->detection('start', $request->param('camera'));
    	return $this->kernel->redirect('/',307);
    }
    public function relativeTime($stamp)
    {
	    $now = time();
	    $diff = $now - $stamp;

	    if ($diff < 60){
	        return sprintf($diff > 1 ? '%s seconds ago' : 'a second ago', $diff);
	    }

	    $diff = floor($diff/60);

	    if ($diff < 60){
	        return sprintf($diff > 1 ? '%s minutes ago' : 'one minute ago', $diff);
	    }

	    $diff = floor($diff/60);

	    if ($diff < 24){
	        return sprintf($diff > 1 ? '%s hours ago' : 'an hour ago', $diff);
	    }

	    $diff = floor($diff/24);

	    if ($diff < 7){
	        return sprintf($diff > 1 ? '%s days ago' : 'yesterday', $diff);
	    }

	    if ($diff < 30)
	    {
	        $diff = floor($diff / 7);

	        return sprintf($diff > 1 ? '%s weeks ago' : 'one week ago', $diff);
	    }

	    $diff = floor($diff/30);

	    if ($diff < 12){
	        return sprintf($diff > 1 ? '%s months ago' : 'last month', $diff);
	    }

	    $diff = date('Y', $now) - date('Y', $date);

	    return sprintf($diff > 1 ? '%s years ago' : 'last year', $diff);
	}
}