<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function fppaper1(): HasOne
    {
        return $this->hasOne(Paper::class, 'review1_fp_id');
    }

    public function fppaper2(): HasOne
    {
        return $this->hasOne(Paper::class, 'review2_fp_id');
    }

    public function cfppaper1(): HasOne
    {
        return $this->hasOne(Paper::class, 'review1_cfp_id');
    }

    public function cfppaper2(): HasOne
    {
        return $this->hasOne(Paper::class, 'review2_cfp_id');
    }

}
