<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Conference;
use App\Models\User;

class PC_Chair extends Model
{
    use HasFactory;
    public $table = 'pc_chairs';
    protected $primaryKey = 'Chair_id';
    protected $fillable = [
        'User_id',
        'Conference_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

}
