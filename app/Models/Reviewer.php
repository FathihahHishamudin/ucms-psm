<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reviewer extends Model
{
    use HasFactory;
    public $table = 'reviewers';
    protected $primaryKey = 'Reviewer_id';
    protected $fillable = [
        'User_id',
        'Conference_id',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class, 'Reviewer_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }
}
