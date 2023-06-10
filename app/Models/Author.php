<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    use HasFactory;
    public $table = 'authors';
    protected $primaryKey = 'Author_id';
    protected $fillable = ['User_id', 
                            'Conference_id', 
                            'Payment_id'];
    
        public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class, 'Conference_id');
    }

}
