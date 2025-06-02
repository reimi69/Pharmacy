<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pharmacy extends Model
{
   protected $primaryKey = 'pharmacy_id';
    protected $fillable = ['pharmacy_name', 'street'];

    public function drugs(): HasMany
    {
        return $this->hasMany(Drug::class, 'pharmacy_id');
    }
}