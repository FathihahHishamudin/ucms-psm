<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normal_Participant extends Model
{
    use HasFactory;
    public $table = 'normal_participants';
    protected $fillable = ['User_id', 
                           'Conference_id',
                           'Payment_id',];
}
