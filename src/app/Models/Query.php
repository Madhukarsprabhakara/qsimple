<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public function database()
    {
        return $this->belongsTo(Database::class);
    }
    public function status()
    {
        return $this->hasMany(QueryStatus::class)->orderBy('created_at', 'DESC');
    }

}
