<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_new_user(): void
    {
        $this->artisan('test:user')
        ->assertSuccessful()
        ->expectsOutput('A new user has been created.')
        ->expectsOutputToContain('The username is')
        ->expectsOutputToContain('And the password is');
    }
}
