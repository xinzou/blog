<?php

namespace App\Http\Controllers\Admin;

use App\Models\Systems;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SystemsController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'XTSZ','Left'=>'JBSZ'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('JBSZ_INDEX')) return $result;
        $site = Config::get('site');
        $data['systemsList'] = Systems::paginate($site['page_size']);
        return view('admin.systems.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('JBSZ_ADD')) return $result;
        return view('admin.systems.create');
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
            Systems::create($data);
            Cache::tags(Systems::REDIS_SYSTEM_CONFIG)->flush();
            return redirect()->action('Admin\SystemsController@index')->with(array(
                'dialog' => array(
                    'title' => '增加基本设置成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加基本设置失败, 请重试'.$e->getMessage()])->with($data);
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
        if($result = check_auth_to('JBSZ_EDIT')) return $result;
        $data['systemsInfo'] = Systems::find($id);
        return view('admin.systems.edit', $data);
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
            Systems::find($id)->update($data);
            Cache::tags(Systems::REDIS_SYSTEM_CONFIG)->flush();
            return redirect()->action('Admin\SystemsController@index')->with(array(
                'dialog' => array(
                    'title' => '修改基本设置成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改基本设置失败, 请重试'])->with($data);
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
        if($result = check_auth_to('JBSZ_DELETE')) return $result;

        try {
            Systems::destroy($id);
            Cache::tags(Systems::REDIS_SYSTEM_CONFIG)->flush();
            return redirect()->action('Admin\SystemsController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除基本设置失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
