<?php

use Philo\Blade\Blade;

function view($path, array $data = []) {
  
  $views = __DIR__ . '/../../resources/views';
  $cache = __DIR__ . '/../../bootstrap/cache';
  
  $blade = new Blade($views, $cache);
  
  echo $blade->view()->make($path, $data)->render();
  
}

function make($filename, $data) {
	
	//array keys as variable names and values as variable values
	extract($data);
	
	//turn on buffering
	ob_start();
	
	//include template
	include (__DIR__ . "/../../resources/views/emails/" . $filename . ".php");
	
	//get content of the file
	$content = ob_get_contents();
	
	//erase and turn off buffering
	ob_end_clean();
	
	return $content;
}
