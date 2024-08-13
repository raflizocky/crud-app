<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scientific_Paper extends Model
{
    use HasFactory;

    protected $table = 'scientific_papers';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'year', 'nim', 'email', 'author', 'mentor'];
}
