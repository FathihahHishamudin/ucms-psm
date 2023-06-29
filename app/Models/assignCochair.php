<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class assignCochair extends Model
{
    use HasFactory;
    public $table = 'assign_cochair';
    protected $fillable = ['Conference_id',
                            'User_id',
                            'status'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }

    public function conference():BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }
    
}
