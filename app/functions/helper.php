<?php

use Philo\Blade\Blade;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;

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

function slug($value) {
  //remove all characters not in this list: underscore, letters, numbers, whitespace
  $value = preg_replace('![^'.preg_quote('_').'\pL\pN\s]+!u', '', mb_strtolower($value));
  //replace underscore with a dash
  $value = preg_replace('!['.preg_quote('-').'\s]+!u', '-', $value);
  //remove whitespace
  return trim($value, "-");
}

function paginate($num_of_records, $total_records, $table_name, $object) {
//  $categories = [];
  $pages = new Paginator($num_of_records, "p");
  $pages->set_total($total_records);
  $data = Capsule::select("SELECT * FROM $table_name ORDER BY created_at DESC " . $pages->get_limit());
  $categories = $object->transform($data);
//  foreach($data as $item) {
//    $added = new Carbon($item->created_at);
//    array_push($categories, [
//      "id" => $item->id,
//      "name" => $item->name,
//      "slug" => $item->slug,
//      "added" => $added->toFormattedDateString()
//    ]);
//  }
  return [$categories, $pages->page_links()];
}
