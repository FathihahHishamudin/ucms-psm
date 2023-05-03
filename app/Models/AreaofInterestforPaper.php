<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaofInterestforPaper extends Model
{
    use HasFactory;
    public $table = 'area_of_interest_papers';
    protected $fillable = ['Conference_id',
                            'AoI_name'];
}
