<?php
/**
 *  OpenLSS - Lighter Smarter Simpler
 *
 *	This file is part of OpenLSS.
 *
 *	OpenLSS is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Lesser General Public License as
 *	published by the Free Software Foundation, either version 3 of
 *	the License, or (at your option) any later version.
 *
 *	OpenLSS is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Lesser General Public License for more details.
 *
 *	You should have received a copy of the 
 *	GNU Lesser General Public License along with OpenLSS.
 *	If not, see <http://www.gnu.org/licenses/>.
 */
namespace LSS;

use \Exception;

class Url {

	public static $urls = array();
	public static $def = array();

	const inc = '/';

	public static function _prep(){
		return Config::get('url','url');
	}

	public static function _isCallable($func){
		if(!isset(self::$def[$func])) return false;
		return true;
	}

	public static function _all(){
		$urls = array();
		foreach(self::$urls as $func) $urls[$func] = self::$func();
		return $urls;
	}

	public static function _register($name,$url){
		//save to definitons
		self::$def[$name] = array('url'=>$url);
		//make persistent if no params
		if(strpos($url,'$') === false) self::$urls[] = $name;
	}

	public static function __callStatic($func,$params=array()) {
		//check if exists
		if(!isset(self::$def[$func])) throw new Exception('URL function doesnt exist: '.$func);
		//replace and return
		$url = self::$def[$func]['url'];
		if(!is_array($params)) return $url;
		//parse params and return
		foreach($params as $key => $arg) $url = str_replace('$'.($key+1),urlencode($arg),$url);
		return $url;
	}

}
