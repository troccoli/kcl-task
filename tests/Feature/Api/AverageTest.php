<?php

namespace Feature\Api;

use App\Models\InputString;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AverageTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_requires_a_logged_in_user(): void
    {
        $this->getJson('/api/average-length')
            ->assertUnauthorized();
    }

    #[Test]
    public function it_returns_the_average_length(): void
    {
        $user = User::factory()->create();

        InputString::factory()
            ->count(10)
            ->for($user)
            ->create();

        $averageLength = InputString::query()
            ->where('user_id', $user->getKey())
            ->avg('length');

        $this->actingAs($user)
            ->getJson('/api/average-length')
            ->assertOk()
            ->assertJsonPath('averageLength', (int) round($averageLength));
    }
}
