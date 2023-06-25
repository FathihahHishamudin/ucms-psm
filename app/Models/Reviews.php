<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reviews extends Model
{
    use HasFactory;
    public $table = 'reviews';
    protected $primaryKey = 'Review_id';
    protected $fillable = [
        'Paper_id',
        'Reviewer_id',
        'originality',
        'relevance',
        'suitable',
        'findings',
        'reference',
        'language',
        'total',
        'status',
        'p_status',
        'comment'
    ];

    public function paper(): BelongsTo
    {
        return $this->belongsTo(Paper::class, 'Paper_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Reviewer::class, 'Reviewer_id');
    }

}
