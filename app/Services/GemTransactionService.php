<?php

namespace App\Services;

use App\Enums\GemTransactionType;
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
    public static function increase(User $user, int $count, array $meta = []): GemTransaction
    {
        return DB::transaction(function () use ($user, $count, $meta) {
            $transaction = self::transact($user, $count, GemTransactionType::INCREASE, $meta);
            $userGem = UserGem::createOrFirstForUser($user);
            $userGem->count += $count;
            $userGem->save();
            return $transaction;
        });
    }

    /**
     * @throws Throwable
     */
    public static function decrease(User $user, int $count, array $meta = []): GemTransaction
    {
        return DB::transaction(function () use ($user, $count, $meta) {
            $transaction = self::transact($user, $count, GemTransactionType::DECREASE, $meta);
            $userGem = UserGem::createOrFirstForUser($user);
            $userGem->count -= $count;
            if ($userGem->count < 0) {
                throw new NoEnoughGemException();
            }
            $userGem->save();
            return $transaction;
        });
    }

    private static function transact(User $user, int $count, GemTransactionType $type, array $meta = []): GemTransaction
    {
        return GemTransaction::create([
            'user_id' => $user->id,
            'count' => $count,
            'type' => $type,
            'meta' => json_encode($meta),
        ]);
    }
}
