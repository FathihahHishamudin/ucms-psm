<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fees extends Model
{
    use HasFactory;
    public $table = 'fees';
    protected $primaryKey = 'Fee_id';
    protected $fillable = ['Conference_id',
                            'Fee_details',
                            'amount'];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }
}
