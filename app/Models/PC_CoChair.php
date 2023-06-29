<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PC_CoChair extends Model
{
    use HasFactory;
    public $table = 'pc_cochairs';
    protected $primaryKey = 'CoChair_id';
    protected $fillable = [
        'User_id',
        'Conference_id',
        'Co_status'
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }
    
}
