<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\PC_Chair;

class Conference extends Model
{
    use HasFactory;
    public $table = 'conferences';
    protected $fillable = ['Conference_org', 
                           'Conference_website',
                           'Conference_status',
                           'Conference_name',
                           'Conference_abbr',
                           'Conference_desc',
                           'Conference_venue',
                           'Conference_time',
                            'Conference_date',
                            'Conference_announcement'];

    public function pcchair(){
        return $this->hasOne(PC_Chair::class);
    }


}
