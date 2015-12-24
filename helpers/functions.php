<?php
/**
 * User: Simon<email:1052214395@qq.com>
 * Time: 2015.03.18 下午4:08
 */
if (! function_exists('check_auth_to')) {
    /**
     * 检查是否具有权限并跳转
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_auth_to($authStr)
    {
        if(!check_auth($authStr))
        {
            return redirect()->action("Admin\LoginController@noAuthority",'callback='.base64_encode(Request::getRequestUri()));
        }
    }
}

if (! function_exists('check_auth')) {
    /**
     * 检查是否具有权限（模板使用）
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_auth($authStr)
    {
        if(check_admin())
        {
            return true;
        }

        if(in_array($authStr, session('loginUser')->auth['authList']))
        {
            return true;
        }
        return false;
    }
}

if (! function_exists('check_admin')) {
    /**
     * 检查是否是管理员
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_admin()
    {
        $site_config = config('site');
        if($site_config['administrator'] === \Illuminate\Support\Facades\Auth::user()->username)
        {
            return true;
        }
        return false;
    }
}

if (! function_exists('recovery_user')) {
    /**
     * 恢复用户登陆信息
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function recovery_user()
    {
        if(!Session::get('loginUser')){
            $user = \Illuminate\Support\Facades\Auth::user();
            $user->auth = \App\Models\Role::getUserAuthList($user->role_id);
            session(['loginUser' => $user]);
        }
    }
}

if (!function_exists('tree')) {
    /**
     * 列表变换为树形列表
     * @param $model
     * @param int $parentId
     * @param int $level
     * @param string $html
     * @return array
     */
    function tree($model, $parentId = 0, $level = 0, $html = '-')
    {
        $data = array();
        foreach ($model as $k => $v) {
            if ($v->parent_id == $parentId) {
                if ($level != 0) {
                    $v->html = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    $v->html .= '|';
                }
                $v->html .= str_repeat($html, $level);
                $data[] = $v;
                $data = array_merge($data, tree($model, $v->id, $level + 1));
            }
        }
        return $data;
    }
}

if (!function_exists('treeArray')) {
    /**
     * 列表变换为树形列表
     * @param $model
     * @param int $parentId
     * @param array $data
     * @return array
     */
    function treeArray(&$model, $parentId = 0)
    {
        $data = array();
        foreach ($model as $k => &$v) {
            if ($v->parent_id == $parentId) {
                $v->children = treeArray($model, $v->id);
                $data[] = $v;
            }
        }
        return $data;
    }
}


if (!function_exists('systemConfig')) {
    /**
     * 获取系统设置
     * @param $field
     * @param string $default
     * @return string
     */
    function systemConfig($field, $default = '')
    {
        $system = app('App\Models\Systems');
        $val = $system->getSystemConfig($field);
        return !empty($val) ? $val : $default;
    }
}

if (!function_exists('strCut')) {
    /**
     * 字符串截取
     * @param string $string
     * @param integer $length
     * @param string $suffix
     * @return string
     */
    function strCut($string, $length, $suffix = '...')
    {
        $resultString = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strLength = strlen($string);
        for ($i = 0; (($i < $strLength) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $resultString .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $resultString .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $resultString = htmlspecialchars($resultString, ENT_QUOTES, 'UTF-8');
        if ($i < $strLength) {
            $resultString .= $suffix;
        }
        return $resultString;
    }
}