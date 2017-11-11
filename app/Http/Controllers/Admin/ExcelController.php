<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\keylog;
use Excel;
class ExcelController extends Controller
{
    //excel文件导出功能
    public function export(Request $request){
    	$start = $request->get('start')." 00:00:00";
    	$end = $request->get('end')." 23:59:59";
    	$count = keylog::whereBetween('created_at',[$start,$end])->count();
    	if($count > 0){
	    	$cellData = keylog::whereBetween('created_at',[$start,$end])->select("id","keyword","referer","domain","region","ip","user_agent","created_at")->get()->toArray();
	    	array_unshift($cellData, ["ID","关键词","来源地址","搜索引擎","地区","IP","操作系统","时间"]);
	    	Excel::create('今日关键词',function($excel) use ($cellData){
	    		$excel->sheet('score',function($sheet) use ($cellData){
	    			$sheet->rows($cellData);
	    		});
	    	})->export("xls");
	    	return response()->json([
	    		"code" => 200,
	    		"message" => "查询成功 ".$start." 至 ".$end." 的数据!"
	    	]);
    	}
    	return response()->json([
    		"code" => 404,
    		"message" => "未查询到 ".$start." 至 ".$end." 的数据!"
    	]);
    }
}
