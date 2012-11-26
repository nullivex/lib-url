<?php

class Url {

	public static $urls = array();
	public static $def = array();
	
	const inc = '/';
	
	public static function prep(){
		return Config::get('url','url');
	}
	
	public static function _all(){
		$urls = array();
		foreach(self::$urls as $func) $urls['url_'.$func] = self::$func();
		return $urls;
	}
	
	public static function register($name,$url,$args=false){
		//setup args as regex
		if(is_array($args)) foreach($args as &$arg) $arg = '/\$'.preg_quote($arg,'/').'/i';
		//save to definitons
		self::$def[$name] = array('url'=>$url,'args'=>$args);
		//make persistent if no params
		if($args === false) self::$urls[] = $name;
	}
	
	public static function __callStatic($func,$params=array()) {
		//check if exists
		if(!isset(self::$def[$func])) throw new Exception('URL function doesnt exist: '.$func);
		//replace and return
		if(is_array(self::$def[$func]['args'])) return preg_replace(self::$def[$func]['args'],$params,self::$def[$func]['url']);
		return self::$def[$func]['url'];
	}
	
}