<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;
    public $table = 'payments';
    protected $primaryKey = 'Payment_id';
    protected $fillable = [
        'Conference_id',
        'Fee_id',
        'payment_status',
        'file',
    ];

    public function fee (): BelongsTo
    {
        return $this->belongsTo(Fees::class, 'Fee_id');
    }

    public function author(): HasOne
    {
        return $this->hasOne(Author::class, 'Payment_id');
    }

    public function nparticipant(): HasOne
    {
        return $this->hasOne(Normal_Participant::class, 'Payment_id');
    }
}
