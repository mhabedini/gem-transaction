<?php

namespace App\Models;

use App\Enums\GemTransactionType;
use Database\Factories\UserGemFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserGem
 *
 * @property int $id
 * @property int $user_id
 * @property int $count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static UserGemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem newQuery()
 * @method static Builder|UserGem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereUserId($value)
 * @method static Builder|UserGem withTrashed()
 * @method static Builder|UserGem withoutTrashed()
 * @mixin Eloquent
 */
class UserGem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public static function createOrFirstForUser(User $user): UserGem
    {
        return UserGem::firstOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
