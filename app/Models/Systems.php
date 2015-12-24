<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Systems extends Model
{
    const REDIS_SYSTEM_CONFIG = 'redis_system_config_';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'systems';

    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getSystemConfig($field)
    {
        if(empty($value = Cache::tags(self::REDIS_SYSTEM_CONFIG)->get(self::REDIS_SYSTEM_CONFIG.$field)))
        {
            $value = self::select('system_value')->where('system_key', $field)->pluck('system_value');
            Cache::tags(self::REDIS_SYSTEM_CONFIG)->put(self::REDIS_SYSTEM_CONFIG.$field, $value, config('site')['redis_cache_time']);
        }
        return $value;
    }
}
