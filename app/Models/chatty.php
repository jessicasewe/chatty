<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\ChattyCreated;

class chatty extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => ChattyCreated::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
