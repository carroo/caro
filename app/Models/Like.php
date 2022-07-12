<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory;
    protected $table = "like";
    protected $fillable=['penyuka','disuka'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
