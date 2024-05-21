<?php

namespace App\Modules\Invoices\Agregate\Commands\Reject\Infrastructure\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Agregate\Commands\Reject\Application\Services\RejectInvoiceService;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class RejectInvoiceController extends Controller
{
    public function update(Request $request, string $id): JsonResponse
    {
        $id = Uuid::fromString($id);

        $repository = new InvoiceRepository();
        $service = new RejectInvoiceService($repository);

        $service->rejectInvoice($id);

        return response()->json(['message' => 'inovice rejected'], Response::HTTP_OK);
    }
}
