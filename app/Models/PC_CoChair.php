<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PC_CoChair extends Model
{
    use HasFactory;
    public $table = 'pc_cochairs';
    protected $fillable = [
        'User_id',
        'Conference_id',
        'Co_status'
    ];
}
