<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserGem
 *
 * @property int $user_id
 * @property int $gem_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserGemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereGemCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGem whereUserId($value)
 * @mixin \Eloquent
 */
class UserGem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
