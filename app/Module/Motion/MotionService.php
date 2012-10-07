<?php
namespace Module\Motion;

class MotionService{
	private $proto = 'http://';
	public function __construct($host = 'localhost', $port = '8080'){
		$this->host = $host;
		$this->port = $port;
		$threads = file_get_contents('http://'.$host.':'.$port);
		//split the RAW response by newline character
		//set your motion.conf to webcontrol_html_output off
		$returned = explode("\n",$threads);
		//TODO: trim off the standard response, will have to implement error check later
		array_shift($returned);
		if($returned[0] == 0){
			//we have the first camera! and the index matches up
			$this->cameras[] = $returned[0];
			//WIP:don't have multiple cams yet, but this is gist
			if(is_array($returned)){
				array_shift($returned);
				if(count($returned) > 0){
					foreach($returned as $cam){
						$this->cameras[] = $cam;
					}
				}
			}
			//WIP:end
		}
	}
	function statusCheck(){
		foreach($this->cameras as $camera){
			if(is_numeric($camera)){
				$result = $this->fetch($camera, '/detection/status');
				if(stristr($result,'active')){
					$ret[$camera]['detectionOn'] = true;
				}else{
					$ret[$camera]['detectionOn'] = false;
				}
				$result = $this->fetch($camera, 'config/list');
				$lines = explode("\n", $result);
				foreach($lines as $line){
					$conf = explode('=',$line);
					if(isset($conf[0]) && isset($conf[1]))
					$config[trim($conf[0])] = trim($conf[1]);
				}
				$ret[$camera]['config'] = $config;
			}
		}
		return $ret;
	}
	function detection($action = 'start',$camera = 0){
		if(is_numeric($camera)){
			$url = '/detection/'.$action;
			$result = $this->fetch($camera,$url);
		}else{
			foreach($this->cameras as $camera){
				$result = $this->fetch($camera, '/detection/'.$action);
			}
		}
	}
	private function fetch($camera, $url){
		return file_get_contents($this->proto.$this->host.':'.$this->port.'/'.$camera.$url);
	}
}