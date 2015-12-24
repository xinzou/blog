<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

class Article extends Model
{
    const REIDS_ARTICLE_CACHE = 'redis_article_cache_';
    const REIDS_NEW_ARTICLE_CACHE = 'redis_new_article_cache_';
    const REIDS_HOT_ARTICLE_CACHE = 'redis_hot_article_cache_';
    const REIDS_TAGS_ARTICLE_CACHE = 'redis_tags_article_cache_';
    const REIDS_CATEGORY_ARTICLE_CACHE = 'redis_cagegory_article_cache_';
    const REIDS_KEYWORD_ARTICLE_CACHE = 'redis_keyword_article_cache_';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 关联User模型
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articleUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    /**
     * 根据文章id获取文章信息
     * @param $articleId
     * @return mixed
     */
    public static function getArticleModelByArticleId($articleId)
    {
        if(empty($article = Cache::get(self::REIDS_ARTICLE_CACHE.$articleId)))
        {
            $article = self::find($articleId);
            Cache::add(self::REIDS_ARTICLE_CACHE.$articleId, $article, config('site')['redis_cache_time']);

        }
        return $article;
    }

    /**
     * 获取热门文章列表
     * @param $n        取出数量
     * @return array
     */
    public static function getHotArticleList($n)
    {
        if(empty($articles = Cache::get(self::REIDS_HOT_ARTICLE_CACHE)))
        {
            $articles = [];
            $ids = ArticleStatus::limit($n)->orderBy('view_number', 'desc')->get();
            foreach($ids as $v)
            {
                if($article = self::getArticleModelByArticleId($v->art_id))
                {
                    array_push($articles, $article);
                }
            }
            Cache::add(self::REIDS_HOT_ARTICLE_CACHE, $articles, config('site')['redis_cache_time']);
        }

        return $articles;
    }

    /**
     * 获取最新文章列表
     * @return array
     */
    public static function getNewArticleList()
    {
        $page = Input::get('page', 1);
        if(empty($articles = Cache::tags(self::REIDS_NEW_ARTICLE_CACHE)->get(self::REIDS_NEW_ARTICLE_CACHE.$page)))
        {
            $articles = Article::with('articleUser')->orderBy('id', 'desc')->paginate(config('site')['article_list_count']);//文章列表（最新）
            Cache::tags(self::REIDS_NEW_ARTICLE_CACHE)->put(self::REIDS_NEW_ARTICLE_CACHE.$page, $articles, config('site')['redis_cache_time']);
        }

        return $articles;
    }

    /**
     * 根据标签id获取文章列表
     * @param $tagId       标签id
     * @return array
     */
    public static function getArticleListByTagId($tagId)
    {
        $page = Input::get('page', 1);
        if(empty($articleList = Cache::tags(self::REIDS_TAGS_ARTICLE_CACHE)->get(self::REIDS_TAGS_ARTICLE_CACHE.$page.$tagId)))
        {
            $model = self::select('id')->whereRaw(
                'find_in_set(?, tags)',
                [$tagId]
            )->orderBy('id', 'desc')->paginate(config('site')['article_list_count']);

            $articleList = array(
                'data' => [],
            );

            if(!empty($model)){
                foreach ($model as $key => $article) {
                    $articleList['data'][$key] = self::getArticleModelByArticleId($article->id);
                }
            }

            $articleList['page'] = $model;
            Cache::tags(self::REIDS_TAGS_ARTICLE_CACHE)->put(self::REIDS_TAGS_ARTICLE_CACHE.$page.$tagId, $articleList, config('site')['redis_cache_time']);
        }

        return $articleList;
    }

    /**
     * 根据分类id获取文章列表
     * @param $cate_id
     * @return array
     */
    public static function getArticleListByCatId($cate_id)
    {
        $page = Input::get('page', 1);
        if(empty($articleList = Cache::tags(self::REIDS_CATEGORY_ARTICLE_CACHE)->get(self::REIDS_CATEGORY_ARTICLE_CACHE.$page.$cate_id)))
        {
            $model = self::select('id')->where('cate_id', $cate_id)->orderBy('id', 'desc')->paginate(config('site')['article_list_count']);
            $articleList = array(
                'data' => [],
            );
            foreach ($model as $key => $article) {
                $articleList['data'][$key] = self::getArticleModelByArticleId($article->id);
            }

            $articleList['page'] = $model;
            Cache::tags(self::REIDS_CATEGORY_ARTICLE_CACHE)->put(self::REIDS_CATEGORY_ARTICLE_CACHE.$page.$cate_id, $articleList, config('site')['redis_cache_time']);
        }

        return $articleList;
    }

    /**
     * 关键字搜索
     * @todo 后期做成 Coreseek 分词搜索
     * @param $keyword
     * @return mixed
     */
    public static function getArticleListByKeyword($keyword)
    {
        $page = Input::get('page', 1);
        if(empty($articleList = Cache::tags(self::REIDS_KEYWORD_ARTICLE_CACHE)->get(self::REIDS_KEYWORD_ARTICLE_CACHE.$page.md5($keyword))))
        {
            $model = self::select('id')->where('title', 'like', "%$keyword%")->orderBy('id', 'desc')->paginate(config('site')['article_list_count']);

            $articleList = array(
                'data' => [],
            );
            if(!empty($model)){
                foreach ($model as $key => $article) {
                    $articleList['data'][$key] = self::getArticleModelByArticleId($article->id);
                }
            }
            $articleList['page'] = $model;
            Cache::tags(self::REIDS_KEYWORD_ARTICLE_CACHE)->put(self::REIDS_KEYWORD_ARTICLE_CACHE.$page.md5($keyword), $articleList, config('site')['redis_cache_time']);
        }

        return $articleList;
    }

    /**
     * 重置redis缓存数据
     */
    public static function resetRedisCache()
    {
        Cache::tags([self::REIDS_KEYWORD_ARTICLE_CACHE, self::REIDS_CATEGORY_ARTICLE_CACHE, self::REIDS_TAGS_ARTICLE_CACHE, self::REIDS_NEW_ARTICLE_CACHE])->flush();
        Cache::forget(self::REIDS_HOT_ARTICLE_CACHE);
    }
}
