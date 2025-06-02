<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Drug extends Model
{
    protected $primaryKey = 'drug_id';
    protected $fillable = ['name', 'count', 'disease', 'price', 'pharmacy_id'];

    public $timestamps = false; 
    
   public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }
}