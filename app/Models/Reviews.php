<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    public $table = 'reviews';
    protected $primaryKey = 'Review_id';
    protected $fillable = [
        'Paper_id',
        'Reviewer_id',
        'Review_Originality',
        'Review_Relevance',
        'Review_Suitable',
        'Review_Findings',
        'Review_Language',
        'Review_Marks',
        'Review_result',
        'Review_comment'
    ];
}
