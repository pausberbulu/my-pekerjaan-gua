<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workspace extends Model
{
    protected $fillable = [
        'name',
        'code',
        'owner_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            do {
                $code = Str::lower(Str::random(4));
            } while (self::where('code', $code)->exists());
            $model->code = $code;
            $model->owner_id = Auth::user()->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
