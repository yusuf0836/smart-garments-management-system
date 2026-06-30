<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'company', 'phone', 'email', 'address', 'status'
    ];

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class);
    }
}