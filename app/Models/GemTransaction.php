<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GemTransaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $gems_added
 * @property int $old_value
 * @property string $tag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GemTransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereGemAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereOldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereUserId($value)
 * @mixin \Eloquent
 */
class GemTransaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
