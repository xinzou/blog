<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article_status';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 初始化文章浏览量
     * @param $articleId
     * @return bool
     */
    public static function initArticleStatus($art_id){
        try{
            self::insert(array('art_id'=>$art_id));
        }
        catch(\Exception $e){
            throw new \Exception('初始化文章浏览量失败！');
        }
    }

    /**
     * 删除文章浏览量数据
     * @param $art_id
     * @return mixed
     */
    public static function deleteArticleStatus($art_id){
        return self::where('art_id','=',$art_id)->first()->delete();
    }

    /**
     * 更新文章浏览量
     * @param $id
     * @return mixed
     */
    public static function update_view_number($art_id)
    {
        return self::where('art_id',$art_id)->increment('view_number');
    }
}
