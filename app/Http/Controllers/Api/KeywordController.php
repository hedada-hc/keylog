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
}
