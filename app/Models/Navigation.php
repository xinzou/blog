<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'navigation';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    private static $catData = [
        0 => '顶级导航',
    ];
    /**
     * 获取分类树形列表
     * @return mixed
     */
    public static function getNavigationTreeList()
    {
        $navigation = self::orderBy('sequence')->get();
        $data = tree($navigation);
        return $data;
    }

    /**
     * 取得树结构的分类数组（列表）
     * @return array
     */
    public static function getNavigationTree()
    {
        $data = self::getNavigationTreeList();
        foreach ($data as $k => $v) {
            self::$catData[$v->id] = $v->html . $v->name;
        }

        return self::$catData;
    }

    /**
     * 获取分类树形数组(多维）
     * @return mixed
     */
    public static function getNavigationTreeArray()
    {
        $navigation = self::orderBy('sequence')->get();
        $data = treeArray($navigation);
        return $data;
    }
}
