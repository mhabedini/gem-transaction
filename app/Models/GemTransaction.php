<?php

namespace App\Models;

use App\Enums\GemTransactionType;
use Database\Factories\GemTransactionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\GemTransaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $count
 * @property int $type
 * @property string $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static GemTransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction newQuery()
 * @method static Builder|GemTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GemTransaction whereUserId($value)
 * @method static Builder|GemTransaction withTrashed()
 * @method static Builder|GemTransaction withoutTrashed()
 * @mixin Eloquent
 */
class GemTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
}
