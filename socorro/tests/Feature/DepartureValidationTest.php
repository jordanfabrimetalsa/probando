<?php

namespace Tests\Feature;

use Tests\TestCase;

class DepartureValidationTest extends TestCase
{
    public function test_departure_requires_all_critical_fields(): void
    {
        $response = $this->postJson(route('departure.create'), []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'lastname',
                'document_type',
                'document_number',
                'email',
                'phone',
                'departure_date',
                'return_date',
            ]);
    }

    public function test_departure_search_requires_document_data(): void
    {
        $this->postJson(route('departure.search'), [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['tipo_documento', 'rut']);
    }

    public function test_departure_cannot_be_finished_without_an_id(): void
    {
        $this->postJson(route('departure.finish'), [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    public function test_return_date_must_be_at_least_one_hour_after_departure(): void
    {
        $payload = [
            'departure_date' => '2026-08-24 10:00:00',
            'return_date' => '2026-08-24 10:30:00',
        ];

        $this->postJson(route('departure.create'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['return_date']);
    }
}
