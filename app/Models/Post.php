<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends Model
{use SoftDeletes;
    use HasFactory;
    
        protected $fillable = [
        'artist_name',
        'venue',
        'theday',
        'seat',
        'stage_distance',
        'others',
        'fan_service',
        'falling_objects',
        'visible',
        'comment',
    ];
    
        public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
