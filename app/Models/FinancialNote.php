<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialNote extends Model
{
    protected $fillable = [
        'user_id', 'advisor_id', 'advice',
    ];

    // The user this note is written about
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The advisor who wrote this note
    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }
}
