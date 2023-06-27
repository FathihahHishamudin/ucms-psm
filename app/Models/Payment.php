<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
