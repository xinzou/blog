<?php
/**
 * 站点配置.
 * User: simon <email:1052214395@qq.com>
 * Date: 15-12-2
 * Time: 下午5:47
 */
return [
    'administrator'     => 'systemuser',//系统管理员用户名
    'page_size'         => 50,//分页大小
    'auth_type'         => ['权限中心','内容管理','系统设置'],//权限类型
    'salt_length'       => 5,//salt长度
    'image_path'        => 'upload/images/',//上传图片保存目录
    'disqus_shortname'  => 'simon',   // disqus评论id
    'redis_cache_time'  => '1440',//redis缓存数据失效时间
    'article_list_count'=> '10',//前台文章列表数量
];