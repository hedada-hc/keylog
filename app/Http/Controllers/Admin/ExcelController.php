<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\keylog;
use Excel;
class ExcelController extends Controller
{
    //excel文件导出功能
    public function export(){
    	$cellData = [
    		["ID","关键词","来源地址","搜索引擎","地区","IP","操作系统","时间"],
    		['1',"补肾吃什么","http://www.baidu.com","武汉市","111.172.113.135","Windows","2017-11-10 17:50:07"],
    		['2',"补肾吃什么","http://www.baidu.com","武汉市","111.172.113.135","Windows","2017-11-10 17:50:07"],
    		['3',"补肾吃什么","http://www.baidu.com","武汉市","111.172.113.135","Windows","2017-11-10 17:50:07"]
    	];
    	Excel::create('今日关键词',function($excel) use ($cellData){
    		$excel->sheet('score',function($sheet) use ($cellData){
    			$sheet->rows($cellData);
    		});
    	})->export("xls");
    	return response()->json([
    		"code" => 200,
    		"message" => "正在导出文档"
    	]);
    }
}
