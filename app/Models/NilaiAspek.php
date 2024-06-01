<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiAspek extends Model
{
    use HasFactory;
    protected $table = "nilai_aspek";
    protected $fillable=['user','guru','tanggung_jawab', 'kedisiplinan', 'sosialisasi', 'perilaku','keaktifan'];
}
