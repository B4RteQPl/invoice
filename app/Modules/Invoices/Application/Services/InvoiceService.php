<?php

namespace App\Modules\Invoices\Application\Services;

use App\Modules\Invoices\Application\Interfaces\InvoiceRepositoryInterface;

class InvoiceService
{

    public function __construct(
        public InvoiceRepositoryInterface $repository,
    ) {
    }
}
