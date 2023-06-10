<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaofInterest extends Model
{
    use HasFactory;
    public $table = 'area_of_interests';
    protected $primaryKey = 'AoI_id';
    protected $fillable = ['Conference_id',
                            'AoI_name'];
}
