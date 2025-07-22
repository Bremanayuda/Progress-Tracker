<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'tenggat_waktu',
        'pic',
        'progress',
        'file',
        'created_by',
    ];
} 