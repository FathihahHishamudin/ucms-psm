<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conference;
use App\Models\User;

class PC_Chair extends Model
{
    use HasFactory;
    public $table = 'pc_chairs';
    protected $fillable = [
        'User_id',
        'Conference_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function conference(){
        return $this->belongsTo(Conference::class);
    }

}
