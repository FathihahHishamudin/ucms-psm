<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    public $table = 'papers';
    protected $fillable = ['Author_id', 
                           'Conference_id', 
                           'Paper_title',
                           'Abstract',
                           'Review1_id',
                           'Status_abstract',
                           'Full_paper',
                            'Review2_id',
                            'Status_fullpaper',
                            'CR_paper',
                            'Status_cr'];
}
