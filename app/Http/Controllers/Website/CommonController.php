<?php

namespace App\Http\Controllers\Website;

use App\Models\Article;
use App\Models\Links;
use App\Models\Navigation;
use App\Models\Tags;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    /**
     * 注册公共数据
     */
    public function setCommonData()
    {
        $data['navigationList'] = Navigation::getNavigationTreeArray();//导航列表数组
        $data['hotArticleList'] = Article::getHotArticleList(5);//热门文章列表
        $data['tagsList'] = Tags::orderBy('number', 'desc')->limit(15)->get();//标签云
        $data['linkList'] = Links::orderBy('sequence')->limit(10)->get();//友情链接列表
        View::share($data);
    }
}
