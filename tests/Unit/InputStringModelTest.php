<?php

namespace Tests\Unit;


use App\Models\InputString;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InputStringModelTest extends TestCase
{
    use RefreshDatabase,
        WithFaker;

    #[Test]
    public function it_stores_the_length_of_the_string(): void
    {
        $user = User::factory()->create();
        $string = fake()->word();

        $inputString = InputString::query()->create([
            'user_id' => $user->id,
            'string' => $string,
        ]);

        $this->assertSame(mb_strlen($string), $inputString->length);
    }
}
