<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'matricule_user',
        'plan',
        'duration',
        'amount',
        'payment_method',
        'phone_number',
        'status',
        'starts_at',
        'ends_at',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'matricule');
    }
}
