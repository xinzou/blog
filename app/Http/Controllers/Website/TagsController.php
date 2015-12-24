<?php

namespace App\Http\Controllers\Website;

use App\Models\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends CommonController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['articleList'] = Article::getArticleListByTagId($id);
        $this->setCommonData();
        return view('website.article_list', $data);
    }
}
