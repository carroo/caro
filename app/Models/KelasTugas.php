<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasTugas extends Model
{
    use HasFactory;
    protected $table = "kelas_tugas";
    protected $fillable=['kelas_id','nama_tugas','deskripsi_tugas','batas_akhir'];
}
