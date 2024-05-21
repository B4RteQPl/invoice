<?php

namespace App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Agregate\Queries\Get\Application\Services\GetInvoiceService;
use App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Resources\InvoiceResource;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class GetInvoiceController extends Controller
{
    public function index(Request $request, string $id): InvoiceResource
    {
        $id = Uuid::fromString($id);

        $repository = new InvoiceRepository();
        $service = new GetInvoiceService($repository);

        $invoice = $service->getInvoice($id);

        return InvoiceResource::make($invoice);
    }
}
