<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $string
 * @property-read int $length
 * @property int $user_id
 * @property-read User $user
 */
class InputString extends Model
{
    use HasFactory;

    protected $fillable = [
        'string',
        'user_id',
    ];

    protected static function booted()
    {
        static::creating(function (self $model) {
            $model->length = mb_strlen($model->string);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
