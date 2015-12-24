<?php

namespace App\Http\Controllers\Admin;

use App\Models\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class LinksController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'XTSZ','Left'=>'YQLJ'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('YQLJ_INDEX')) return $result;
        $site = Config::get('site');
        $data['linksList'] = Links::paginate($site['page_size']);
        return view('admin.links.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('YQLJ_ADD')) return $result;
        return view('admin.links.create');
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
            Links::create($data);
            return redirect()->action('Admin\LinksController@index')->with(array(
                'dialog' => array(
                    'title' => '增加友情链接成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加友情链接失败, 请重试'.$e->getMessage()])->with($data);
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
        if($result = check_auth_to('YQLJ_EDIT')) return $result;
        $data['linksInfo'] = Links::find($id);
        return view('admin.links.edit', $data);
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
            Links::find($id)->update($data);
            return redirect()->action('Admin\LinksController@index')->with(array(
                'dialog' => array(
                    'title' => '修改友情链接成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改友情链接失败, 请重试'])->with($data);
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
        if($result = check_auth_to('YQLJ_DELETE')) return $result;

        try {
            Links::destroy($id);
            return redirect()->action('Admin\LinksController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除友情链接失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
