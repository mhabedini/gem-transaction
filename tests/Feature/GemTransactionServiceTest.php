<?php

use App\Enums\GemTransactionType;
use App\Exceptions\NoEnoughGemException;
use App\Models\GemTransaction;
use App\Models\User;
use App\Models\UserGem;
use App\Services\GemTransactionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GemTransactionServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception|Throwable
     */
    public function testUserCanIncreaseItsGem(): void
    {
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        GemTransactionService::increase($user, $gemCount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'type' => GemTransactionType::INCREASE
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'count' => $gemCount,
        ]);
    }


    /**
     * @throws Exception|Throwable
     */
    public function testUserCanDecreaseItsGem(): void
    {
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        $gemDecreaseAmount = $gemCount - 1;
        GemTransactionService::increase($user, $gemCount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'type' => GemTransactionType::INCREASE
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'count' => $gemCount,
        ]);

        GemTransactionService::decrease($user, $gemDecreaseAmount);

        $this->assertDatabaseHas(GemTransaction::class, [
            'user_id' => $user['id'],
            'type' => GemTransactionType::DECREASE
        ]);

        $this->assertDatabaseHas(UserGem::class, [
            'user_id' => $user['id'],
            'count' => $gemCount - $gemDecreaseAmount,
        ]);
    }

    /**
     * @throws Exception|Throwable
     */
    public function testDecreaseGemBelowZeroFails(): void
    {
        $this->expectException(NoEnoughGemException::class);
        $user = User::factory()->create();
        $gemCount = random_int(10, 10000);
        GemTransactionService::decrease($user, $gemCount);
    }
}
