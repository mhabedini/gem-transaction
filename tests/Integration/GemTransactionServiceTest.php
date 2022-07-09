<?php

namespace Tests\Integration;

use App\Exceptions\NoEnoughGemException;
use App\Models\GemTransaction;
use App\Models\User;
use App\Models\UserGem;
use App\Services\GemTransactionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class GemTransactionServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Throwable
     */
    public function testUserCanIncreaseItsGem(): void
    {
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        GemTransactionService::increase($user, $gemCount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'gems_added' => $gemCount,
            'old_value' => 0,
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'gem_count' => $gemCount,
        ]);
    }


    /**
     * @throws Throwable
     */
    public function testUserCanDecreaseItsGem(): void
    {
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        $gemDecreaseAmount = $gemCount - 1;
        GemTransactionService::increase($user, $gemCount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'gems_added' => $gemCount,
            'old_value' => 0,
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'gem_count' => $gemCount,
        ]);

        GemTransactionService::decrease($user, $gemDecreaseAmount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'gems_added' => -$gemDecreaseAmount,
            'old_value' => $gemCount,
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'gem_count' => $gemCount - $gemDecreaseAmount,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function testDecreaseGemBelowZeroFails(): void
    {
        $this->expectException(NoEnoughGemException::class);
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        GemTransactionService::decrease($user, $gemCount);
    }
}
