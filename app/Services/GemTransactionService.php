<?php

namespace App\Services;

use App\Exceptions\NoEnoughGemException;
use App\Models\GemTransaction;
use App\Models\User;
use App\Models\UserGem;
use Illuminate\Support\Facades\DB;
use Throwable;

class GemTransactionService
{

    /**
     * @throws Throwable
     */
    public static function increase(User $user, int $amount, array $tag = []): GemTransaction
    {
        return self::transact(...func_get_args());
    }

    /**
     * @throws Throwable
     */
    public static function decrease(User $user, int $amount, array $tag = []): GemTransaction
    {
        return self::transact($user, -$amount, $tag);
    }

    /**
     * @throws Throwable
     */
    private static function transact(User $user, int $amount, array $tag = []): GemTransaction
    {
        return DB::transaction(function () use ($user, $amount, $tag) {
            UserGem::upsert(
                ['user_id' => $user->id, 'gem_count' => $amount],
                'user_id',
                ['user_id' => $user->id, 'gem_count' => DB::raw("gem_count + $amount")]
            );

            $userGem = UserGem::find($user->id);

            if ($userGem->gem_count < 0) {
                throw new NoEnoughGemException();
            }

            return GemTransaction::create([
                'user_id' => $user->id,
                'gem_added' => $amount,
                'old_value' => $userGem->gem_count - $amount,
                'tag' => json_encode($tag),
            ]);
        }, 3);
    }
}
