<?php
/*
 * LSS Core
 * OpenLSS - Light, sturdy, stupid simple
 * 2010 Nullivex LLC, All Rights Reserved.
 * Bryan Tong <contact@nullivex.com>
 *
 *   OpenLSS is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   OpenLSS is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with OpenLSS.  If not, see <http://www.gnu.org/licenses/>.
 */

define('inc','/');

class Url {
	
	static $urls = array(
		'home',
		'page',
		'register',
		'login',
		'logout',
		'profile',
		'orders',
		'orders_packages',
		'orders_cart',
		'client',
	);

	public static function prep(){
		return Config::get('url','url');
	}

	public static function _all(){
		$urls = array();
		foreach(self::$urls as $func){
			$urls['url_'.$func] = self::$func();
		}
		return $urls;
	}

	public static function home(){
		return self::prep().inc;
	}
	
	public static function register(){
		return self::prep().inc.'?act=register';
	}
	
	public static function login(){
		return self::prep().inc.'?act=login';
	}	
	
	public static function logout(){
		return self::prep().inc.'?logout=true';
	}

	public static function page(){
		return self::prep().inc.'?act=pages&page=';
	}

	public static function profile(){
		return self::prep().inc.'?act=profile';
	}
	
	public static function orders(){
		return self::prep().inc.'?act=order';
	}
	
	public static function orders_cart(){
		return self::orders().'&do=cart';
	}
	
	public static function orders_packages(){
		return self::orders().'&do=package_list';
	}
	
	public static function orders_add($order_package_id){
		return self::orders().'&do=add&order_package_id='.$order_package_id;
	}
	
	public static function orders_customize($order_package_id,$order_detail_package_id=null){
		$url = self::orders().'&do=customize&order_package_id='.$order_package_id;
		if(!is_null($order_detail_package_id)) return $url.'&order_detail_package_id='.$order_detail_package_id;
		return $url;
	}
	
	public static function client(){
		return self::prep().inc.'client.php';
	}
	
}
