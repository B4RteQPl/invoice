<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'address', 'city', 'country', 'phone', 'email',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'company_id');
    }
}
