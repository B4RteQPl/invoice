<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Resources;

use App\Domain\ValueObjects\Money;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'quantity' => $this->pivot->quantity,
            'unit_price' => Money::from($this->price)->toString(),
            'total' => '69.99'
        ];
    }
}
