<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installments extends Model
{
    use HasFactory;

    // Allow mass assignment for the fields you want to create/update
    protected $fillable = [
        'installment',      // Installment number
        'date',             // Due date
        'amount',           // Amount
        'payment_date',     // Payment date
        'penalty',          // Penalty
        'status',           // Status
    ];

    // Alternatively, you could use $guarded to specify which fields are not mass assignable
    // protected $guarded = ['id']; // This would protect the 'id' field from mass assignment.
}
