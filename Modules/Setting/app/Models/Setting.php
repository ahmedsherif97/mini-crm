<?php

namespace Modules\Setting\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Whtht\PerfectlyCache\Traits\PerfectlyCachable;

class Setting extends Model
{
    use ModelTrait;
    use PerfectlyCachable;

    protected $fillable = [
        'slug', 'type', 'value', 'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
