<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkTugas extends Model
{
    use HasFactory;
    protected $table = "link_tugas";
    protected $fillable=['tugas_id','murid_id','link_tugas'];
}
