<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Model\PC_Chair;
use App\Models\PC_CoChair;
use App\Models\Reviewer;
use App\Models\Normal_Participant;
use App\Models\Author;
use App\Models\Fees;
use App\Models\Paper;

class Conference extends Model
{
    use HasFactory;
    public $table = 'conferences';
    protected $primaryKey = 'Conference_id';
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

    public function pcchair(): HasOne
    {
        return $this->hasOne(PC_Chair::class, 'Conference_id');
    }

    public function pccochair(): HasMany
    {
        return $this->hasMany(PC_CoChair::class, 'Conference_id');
    }

    public function reviewer(): HasMany
    {
        return $this->hasMany(Reviewer::class, 'Conference_id');
    }

    public function nparticipant(): HasMany
    {
        return $this->hasMany(Normal_Participant::class, 'Conference_id');
    }

    public function author(): HasMany
    {
        return $this->hasMany(Author::class, 'Conference_id');
    }

    public function fee(): HasMany
    {
        return $this->hasMany(Fees::class, 'Conference_id');
    }

    public function paper(): HasMany
    {
        return $this->hasMany(Paper::class, 'Conference_id');
    }


}
