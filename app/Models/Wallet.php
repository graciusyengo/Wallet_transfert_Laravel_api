<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'balance', 'currency'])]
class Wallet extends Model
{

public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //
}
