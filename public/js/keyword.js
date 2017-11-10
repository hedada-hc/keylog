//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36
//Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1
//Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1
//Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Mobile Safari/537.36
//Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LYZ28E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Mobile Safari/537.36
//Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_3; en-us) AppleWebKit/534.1+ (KHTML, like Gecko) Version/5.0 Safari/533.16
//Mozilla/5.0 (MeeGo; NokiaN9) AppleWebKit/534.13 (KHTML, like Gecko) NokiaBrowser/8.5.0 Mobile Safari/534.13
//Mozilla/5.0 (PlayBook; U; RIM Tablet OS 2.1.0; en-US) AppleWebKit/536.2+ (KHTML like Gecko) Version/7.2.1.0 Safari/536.2+
document.referrer

//启动函数
var run = function(){
	var OS = getOS();
	var data = getKeyword();
	data.user_agent = OS;
	data.ip = returnCitySN.cip;
	data.region = returnCitySN.cname;
	data.referer = location.href;
	addKey(data);
};

//获取操作系统版本
var getOS = function(){
	var OS = navigator.userAgent;
	if(/Windows/.test(OS)) return "Windows";
	if(/iPhone/.test(OS)) return "iPhone";
	if(/iPad/.test(OS)) return "iPad";
	if(/Android/.test(OS)) return "Android";
	if(/Nokia/.test(OS)) return "Nokia";
	if(/PlayBook/.test(OS)) return "PlayBook";
	if(/Mac/.test(OS) && !/iPhone/.test(OS) && !/iPad/.test(OS)) return "Mac";
	return "未知";

};

//获取来源referer
var getKeyword = function(){
	var referer = document.referrer;
	var key = "";
	if(/sogou\.com/.test(referer)){
		key = /[\&\?]{1,1}query=([\w%?]+)/.exec(referer);
		return {"key":decodeURIComponent(key[1]),"domain":"搜狗"}
	}

	if(/baidu\.com/.test(referer)){
		key = /[\&\?]{1,1}wd=([\w%?]+)/.exec(referer);
		return {"key":decodeURIComponent(key[1]),"domain":"百度"}
	}

	if(/sm\.cn/.test(referer)){
		key = /[\&\?]{1,1}q=([\w%?]+)/.exec(referer);
		return {"key":decodeURIComponent(key[1]),"domain":"神马"}
	}
	
	return {"key":null,"domain":false}
}


//新增记录
var addKey = function(data){
	var url = "http://www.key.com/api/key"
	$.ajax({
		type:"POST",
		url:url,
		data:data,
		success:function(data){
			console.log(data)
		}
	})
}

/*


*/