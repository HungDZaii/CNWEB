<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'computer_id',
        'reporter_by',
        'reporter_date',
        'description',
        'urgency',
        'status'
    ];

    public function computer()
    {
        return $this->belongsTo(Computer::class, 'computer_id', ownerKey: 'id');
    }
}
