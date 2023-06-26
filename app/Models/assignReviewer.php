<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignReviewer extends Model
{
    use HasFactory;
    public $table = 'assign_reviewer';
    protected $fillable = ['Conference_id',
                            'Paper_id', 
                            'User_id',
                            'status',
                            'due'];
}
