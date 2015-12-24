<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tags extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['number'];

    /**
     * 保存文章标签并返回标签id数组
     * @param $tags
     * @return array
     * @throws \Exception
     */
    public static function saveArticleTags($tags)
    {
        if(!$tags) return [];
        $tagArray = explode(',', $tags);
        $tags_ids = array();

        //获取已经存在的标签id数组
        $result = self::whereIn('name',$tagArray)->get();
        foreach($tagArray as $key => $val)
        {
            foreach($result as $obj)
            {
                if($obj->name == $val)
                {
                    array_push($tags_ids, $obj->id);
                    unset($tagArray[$key]);//去除已经存在的标签
                }
            }
        }

        try{
            $addTagsIds = self::addNewTags($tagArray);
            $tags_ids = array_merge($tags_ids, $addTagsIds);
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

        return $tags_ids;
    }

    /**
     * 添加不存在的新标签并返回新增标签id数组
     * @param $tagArray
     * @return array
     * @throws \Exception
     */
    public static function addNewTags($tagArray)
    {
        $tags_ids = array();
        try{
            DB::transaction(function () use($tagArray,&$tags_ids) {
                $saveData = array();
                foreach($tagArray as $value)
                {
                    unset($saveData);
                    $saveData['name'] = $value;
                    $saveData['number'] = 1;
                    if(!empty($saveData))
                    {
                        $id = self::insertGetId($saveData);
                        array_push($tags_ids, $id);
                    }
                }
            });
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
        return $tags_ids;
    }

    /**
     * 获取标签name数组
     * @param $idStr
     * @return array
     */
    public static function getTagsName($idStr)
    {
        $idArray = explode(',', $idStr);
        $tags_names = array();

        //获取已经存在的标签id数组
        $result = self::whereIn('id',$idArray)->get();
        foreach($result as $key => $val)
        {
            array_push($tags_names, $val->name);
        }
        return implode(',', $tags_names);
    }
}
