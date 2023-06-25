<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paper extends Model
{
    use HasFactory;
    public $table = 'papers';
    protected $primaryKey = 'Paper_id';
    protected $fillable = ['Author_id', 
                           'Conference_id',
                           'r1_id',
                           'r2_id', 
                           'paper_title',
                           'abstract',
                           'full_paper',
                           'review1_fp_id',
                           'review2_fp_id',
                           'stat_fp',
                           'Correction_fp',
                           'review1_cfp_id',
                           'review2_cfp_id',
                            'stat_cfp',
                            'cr_paper',
                            'status_cr'];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

    public function paperauthor(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'Author_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class, 'Paper_id');
    }

}
