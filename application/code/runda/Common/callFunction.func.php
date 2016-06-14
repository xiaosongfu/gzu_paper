<?php

//定义一个控制器调用函数
function C($controllerName,$actionName){
	require_once(DOC_PATH_ROOT."/Controller/".$controllerName."Controller.class.php");
	//eval("$obj = new ".$controllerName."Controller();$obj->"."$actionName"."();");
	
	$controller = $controllerName."Controller";
	$obj = new $controller();
	$obj -> $actionName();
}

//定义字符串过滤、处理函数
function addslashesForUrl($url){
	return (!get_magic_quotes_gpc()) ? addslashes($url) : $url;
}