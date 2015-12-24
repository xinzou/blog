<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Models\Article;
use Illuminate\Support\Facades\Input;

class SearchController extends CommonController
{
    public function show()
    {
        $keyword = Input::get('keyword');
        if (empty($keyword)) {
            return redirect()->action('Website\IndexController@index');
        }
        $data['articleList'] = Article::getArticleListByKeyword($keyword);
        $this->setCommonData();
        return view('website.article_list', $data);
    }
}
