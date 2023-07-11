<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class assignReviewer extends Model
{
    use HasFactory;
    protected $table = 'assign_reviewer';
    protected $fillable = ['Conference_id',
                            'Paper_id', 
                            'User_id',
                            'status',
                            'due'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }

    public function conference():BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

    public function paper():BelongsTo
    {
        return $this->belongsTo(Paper::class, 'Paper_id');
    }
}
