<?php
//发送短信配置
// 接口地址：http://v.juhe.cn/sms/send
// 支持格式：JSON/XML
// 请求方式：HTTP GET
// 请求示例：http://v.juhe.cn/sms/send?mobile=手机号码&tpl_id=短信模板ID&tpl_value=%23code%23%3D654654&key=
// 接口备注：防骚扰过滤：默认开启。过滤规则：同1个手机发相同内容，30秒内最多发送1次，5分钟内最多发送3次
// 请求参数：
//  	名称	类型	必填	说明
//  	mobile	string	是	接收短信的手机号码
//  	tpl_id	int	是	短信模板ID，请参考个人中心短信模板设置
//  	tpl_value	string	是	变量名和变量值对。
//				tpl_value=urlencode("#code#=1234&#company#=聚合数据")
// 				如果你的变量名或者变量值中带有#&=中的任意一个特殊符号，请先分别进行urlencode编码后再传递，详细说明>
//  	key	string	是	应用APPKEY(应用详细页查询)
//  	dtype	string	否	返回数据的格式,xml或json，默认json
define("URL","http://v.juhe.cn/sms/send");
define("APPKEY","971865ab33edf77d679056fef50bfce1");