<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'links';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
