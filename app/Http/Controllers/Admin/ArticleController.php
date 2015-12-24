<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'NRGL','Left'=>'WZGL'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('WZGL_INDEX')) return $result;
        $site = Config::get('site');
        $data['articleList'] = Article::with('articleUser')->paginate($site['page_size']);
        return view('admin.article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('WZGL_ADD')) return $result;
        $data['categoryTreeList'] = Category::getCategoryTree();
        $data['tagsList'] = Tags::all();
        return view('admin.article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token'],$data['pic']);

        try {
            $data['tags'] = implode(',',Tags::saveArticleTags($data['tags']));
            $data['user_id'] = session('loginUser')->user_id;
            if($request->hasFile('pic')){
                $data['pic'] = $this->fileUpload($request);
            }
            $article = Article::create($data);
            ArticleStatus::initArticleStatus($article->id);
            Article::resetRedisCache();
            return redirect()->action('Admin\ArticleController@index')->with(array(
                'dialog' => array(
                    'title' => '增加文章成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加文章失败, 请重试'.$e->getMessage()])->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($result = check_auth_to('WZGL_EDIT')) return $result;
        $data['categoryTreeList'] = Category::getCategoryTree();
        $data['articleInfo'] = Article::find($id);
        $data['tagsList'] = Tags::all();
        $data['articleInfo']->tags = Tags::getTagsName($data['articleInfo']->tags);
        return view('admin.article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token'],$data['pic']);

        try {
            $data['tags'] = implode(',',Tags::saveArticleTags($data['tags']));
            $data['user_id'] = session('loginUser')->user_id;
            if($request->hasFile('pic')){
                $data['pic'] = $this->fileUpload($request);
            }
            Article::find($id)->update($data);
            Article::resetRedisCache();
            Cache::forget(Article::REIDS_ARTICLE_CACHE.$id);
            return redirect()->action('Admin\ArticleController@index')->with(array(
                'dialog' => array(
                    'title' => '修改文章成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改文章失败, 请重试'.$e->getMessage()])->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($result = check_auth_to('WZGL_DELETE')) return $result;

        try {
            ArticleStatus::deleteArticleStatus($id);
            Article::destroy($id);
            Article::resetRedisCache();
            Cache::forget(Article::REIDS_ARTICLE_CACHE.$id);
            return redirect()->action('Admin\ArticleController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除文章失败,请重试(' . $e->getMessage() . ')']);
        }
    }

    /**
     * 上传文件
     * @param $request
     * @return string
     * @throws \Exception
     */
    public function fileUpload($request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('pic')){
            throw new \Exception("上传文件为空!");
        }
        $file = $request->file('pic');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            throw new \Exception("文件上传出错!");
        }
        $newFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
        $savePath = Config::get('site')['image_path'];
        if(!$file->move($savePath, $newFileName)){
            throw new \Exception("保存文件失败!");
        }
        return $newFileName;
    }
}
