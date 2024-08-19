<?php

namespace Tests\Feature\Api;

use App\Models\InputString;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubmitTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_field_called_text_is_required(): void
    {
        $this->postJson('api/submit', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'text' => 'The text field must be present.',
            ])
            ->assertJsonPath('message', 'The text field must be present.');
    }

    #[Test]
    public function the_field_called_text_must_be_a_string(): void
    {
        $this->postJson('api/submit', ['text' => 123])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'text' => 'The text field must be a string.',
            ])
            ->assertJsonPath('message', 'The text field must be a string.');
    }

    #[Test]
    public function the_field_called_text_can_be_empty(): void
    {
        $this->postJson('api/submit', ['text' => ''])
            ->assertOk();
    }

    #[Test]
    public function it_returns_the_number_of_characters(): void
    {
        $numberOfCharacters = mt_rand(1, 100);
        $inputValue = Str::random($numberOfCharacters);

        $this->postJson('/api/submit', ['text' => $inputValue])
            ->assertOk()
            ->assertJson(['message' => $numberOfCharacters]);
    }

    #[Test]
    public function it_does_not_store_the_string_into_the_database_if_the_user_has_not_logged_in(): void
    {
        $numberOfCharacters = mt_rand(1, 100);
        $inputValue = Str::random($numberOfCharacters);

        $this->postJson('/api/submit', ['text' => $inputValue])
            ->assertOk();

        $this->assertDatabaseEmpty(InputString::class);
    }

    #[Test]
    public function it_stores_the_string_in_the_db_when_user_is_logged_ind(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $numberOfCharacters = mt_rand(1, 100);
        $inputValue = Str::random($numberOfCharacters);

        $this->postJson('/api/submit', ['text' => $inputValue])
            ->assertOk();

        $this->assertDatabaseHas(
            table: InputString::class,
            data: [
                'user_id' => $user->getKey(),
                'string' => $inputValue,
                'length' => $numberOfCharacters,
            ]);
    }
}
