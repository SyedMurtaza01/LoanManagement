<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    // Define the fillable properties for mass assignment
    protected $fillable = ['status', 'file'];

    // Optionally, you can define the table name if it's different from the default
    // protected $table = 'documents';
}
