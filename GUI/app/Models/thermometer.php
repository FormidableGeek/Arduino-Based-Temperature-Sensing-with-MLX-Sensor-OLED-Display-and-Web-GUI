<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class thermometer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="thermometer_readings";
    protected $fillable=[
        'readings',
        'picture',
        'user_id'
    ];
    
    public function user(){
        return $this->BelongsTo(thermometer::class);
    }
}
