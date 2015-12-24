<?php

namespace App\Http\Controllers\Website;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($asName)
    {
        $category = Category::getCatInfoModelByAsName($asName);
        $this->setCommonData();
        if (empty($category)) {
            return redirect(url(route('website.index')));
        }
        $data['articleList'] = Article::getArticleListByCatId($category->id);
        return view('website.article_list', $data);
    }
}
