<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class InvoiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'invoice_number' => $this->number,
            'invoice_date' => $this->date,
            'due_date' => $this->due_date,
            'company' => CompanyResource::make([]),
            'billed_company' => BilledCompanyResource::make($this->company),
            'products' => ProductResource::collection($this->products),
            'total_price' => $this->productsTotalPrice()->toString(),
        ];
    }
}
