<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    private static $catData = [
        0 => '顶级分类',
    ];
    /**
     * 获取分类树形列表
     * @return mixed
     */
    public static function getCategoryTreeList()
    {
        $category = self::all();
        $data = tree($category);
        return $data;
    }

    /**
     * 取得树结构的分类数组
     * @return array
     */
    public static function getCategoryTree()
    {
        $data = self::getCategoryTreeList();
        foreach ($data as $k => $v) {
            self::$catData[$v->id] = $v->html . $v->cate_name;
        }

        return self::$catData;
    }

    /**
     * 根据别名取分类信息
     * @param $asName
     * @return mixed
     */
    public static function getCatInfoModelByAsName($asName)
    {
        return self::where('as_name', '=', $asName)->first();
    }
}
