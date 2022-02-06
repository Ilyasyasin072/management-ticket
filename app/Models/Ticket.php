<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $guarded = [];

    public function order(): HasMany
    {
        return $this->hasMany(Orders::class, 'id');
    }

}
