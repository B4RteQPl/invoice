<?php

namespace Database\Factories;

use App\Domain\Enums\StatusEnum;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::factory()->create()->refresh();

        return [
            'id' => Uuid::uuid4()->toString(),
            'number' => Str::random(8),
            'date' => now()->toDateString(),
            'due_date' => now()->addDays(15)->toDateString(),
            'company_id' => $company->id,
            'status' => StatusEnum::DRAFT,
        ];
    }

    public function withCompany(Company $company)
    {
        return $this->state(function (array $attributes) use ($company) {
            return [
                'company_id' => $company->id,
            ];
        });
    }
}
