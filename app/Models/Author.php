<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    use HasFactory;
    public $table = 'authors';
    protected $primaryKey = 'Author_id';
    protected $fillable = ['User_id', 
                            'Conference_id', 
                            'Payment_id'];
    
    public function authorconference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

    public function authoruser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }

    public function authorpaper(): HasOne
    {
        return $this->hasOne(Paper::class, 'Author_id');
    }

}
