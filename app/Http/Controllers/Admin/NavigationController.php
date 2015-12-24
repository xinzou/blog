<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class NavigationController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'XTSZ','Left'=>'DHGL'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('DHGL_INDEX')) return $result;
        $data['navigationList'] = Navigation::getNavigationTreeList();
        return view('admin.navigation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('DHGL_ADD')) return $result;
        $data['navigationTreeList'] = Navigation::getNavigationTree();
        return view('admin.navigation.create',$data);
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
            Navigation::create($data);
            return redirect()->action('Admin\NavigationController@index')->with(array(
                'dialog' => array(
                    'title' => '增加导航成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加导航失败, 请重试'.$e->getMessage()])->with($data);
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
        if($result = check_auth_to('DHGL_EDIT')) return $result;
        $data['navigationTreeList'] = Navigation::getNavigationTree();
        $data['navigationInfo'] = Navigation::find($id);
        return view('admin.navigation.edit', $data);
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
            Navigation::find($id)->update($data);
            return redirect()->action('Admin\NavigationController@index')->with(array(
                'dialog' => array(
                    'title' => '修改导航成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改导航失败, 请重试'])->with($data);
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
        if($result = check_auth_to('DHGL_DELETE')) return $result;

        try {
            $count = Navigation::where('parent_id', '=', $id)->count();
            if ($count !== 0) {
                throw new \Exception("请先删除下级导航");
            }
            Navigation::destroy($id);
            return redirect()->action('Admin\NavigationController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除导航失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
