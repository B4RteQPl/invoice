<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => 'East Repair Inc.',
            'street_address' => '1912 Hearvest Lane',
            'city' => 'New York, ',
            'zip_code' => 'NY 12210',
            'phone' => null,
        ];
    }
}
