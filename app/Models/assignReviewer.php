<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignReviewer extends Model
{
    use HasFactory;
    public $table = 'assign_reviewer';
    protected $fillable = ['Paper_id', 
                            'Reviewer_id',
                            'status',
                            'due'];
}
