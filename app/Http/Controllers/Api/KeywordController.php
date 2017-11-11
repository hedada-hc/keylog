<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\keylog;

class KeywordController extends Controller
{
    public function store(Request $request){
        $data = [
            "referer" => $request->get("referer"),
            "keyword" => $request->get("key"),
            "region" => $request->get("region"),
            "domain" => $request->get("domain"),
            "ip" => $request->get("ip"),
            "user_agent" => $request->get("user_agent"),
        ];
        $data['keyword'] = $data['keyword'] == null ? "未追踪到" : $data['keyword'];
        if(!$this->isKey($data)){
            return keylog::create($data);
        }
        return ["msg" => "重复数据"];
    }

    public function isKey($data){
        //关键词重复 ip重复
        return keylog::where(['keyword' => $data['keyword'], 'ip' => $data['ip']])->get()->toArray();
    }

    public function KeyLog(){
        $count = keylog::all()->count();
        $data = keylog::latest()->take(10)->get();

        return response()->json([
            "code" => "200",
            "result" => $data,
            "count" => $count
        ]);
    }

    /*
     * 分页数据   
    */
    public function Page(Request $request){
        $count = keylog::all()->count();
        if($request->get("page")){
            $page = (abs($request->get("page")) * 100) - 100;
            $pageData = keylog::latest("created_at")->offset($page)->limit(100)->get();
        }else{
            $pageData = keylog::latest("created_at")->offset(0)->limit(100)->get();
        }
        return response()->json([
            "code" => 200,
            "result" => $pageData,
            "count" => $count
        ]);
    }
}
