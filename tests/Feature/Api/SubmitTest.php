<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubmitTest extends TestCase
{
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
}
