<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'NRGL','Left'=>'FLGL'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('FLGL_INDEX')) return $result;
        $data['categoryList'] = Category::getCategoryTreeList();
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('FLGL_ADD')) return $result;
        $data['categoryTreeList'] = Category::getCategoryTree();
        return view('admin.category.create', $data);
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
        unset($data['_token']);

        try {
            Category::create($data);
            return redirect()->action('Admin\CategoryController@index')->with(array(
                'dialog' => array(
                    'title' => '增加文章分类成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加文章分类失败, 请重试'])->with($data);
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
        if($result = check_auth_to('FLGL_EDIT')) return $result;
        $data['categoryTreeList'] = Category::getCategoryTree();
        $data['categoryInfo'] = Category::find($id);
        return view('admin.category.edit', $data);
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
        try {
            Category::find($id)->update($data);
            return redirect()->action('Admin\CategoryController@index')->with(array(
                'dialog' => array(
                    'title' => '修改文章分类成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改文章分类失败, 请重试'])->with($data);
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
        if($result = check_auth_to('FLGL_DELETE')) return $result;

        try {
            $count = Category::where('parent_id', '=', $id)->count();
            if ($count !== 0) {
                throw new \Exception("请先删除下级分类");
            }
            Category::destroy($id);
            return redirect()->action('Admin\CategoryController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除文章分类失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
