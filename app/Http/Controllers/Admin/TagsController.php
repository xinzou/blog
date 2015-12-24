<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class TagsController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'NRGL','Left'=>'BQGL'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('BQGL_INDEX')) return $result;
        $site = Config::get('site');
        $data['tagsList'] = Tags::paginate($site['page_size']);
        return view('admin.tags.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('BQGL_ADD')) return $result;
        return view('admin.tags.create');
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
            Tags::create($data);
            return redirect()->action('Admin\TagsController@index')->with(array(
                'dialog' => array(
                    'title' => '增加标签成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加标签失败, 请重试'.$e->getMessage()])->with($data);
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
        if($result = check_auth_to('BQGL_EDIT')) return $result;
        $data['tagsInfo'] = Tags::find($id);
        return view('admin.tags.edit', $data);
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
        unset($data['_token']);
        try {
            Tags::find($id)->update($data);
            return redirect()->action('Admin\TagsController@index')->with(array(
                'dialog' => array(
                    'title' => '修改标签成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改标签失败, 请重试'])->with($data);
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
        if($result = check_auth_to('BQGL_DELETE')) return $result;

        try {
            Tags::destroy($id);
            return redirect()->action('Admin\TagsController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除标签失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
