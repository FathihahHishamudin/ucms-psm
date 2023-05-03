<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;
    public $table = 'reviewers';
    protected $fillable = [
        'User_id',
        'Conference_id',
    ];
}
