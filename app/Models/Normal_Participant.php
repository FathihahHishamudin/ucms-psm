<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Normal_Participant extends Model
{
    use HasFactory;
    public $table = 'normal_participants';
    protected $primaryKey = 'Participant_id';
    protected $fillable = ['User_id', 
                           'Conference_id',
                           'Payment_id',];

        public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

}
