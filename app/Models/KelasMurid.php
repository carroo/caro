<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasMurid extends Model
{
    use HasFactory;
    protected $table = "kelas_murid";
    protected $fillable=['murid_id','kelas_id'];
}
