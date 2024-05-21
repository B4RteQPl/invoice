<?php

namespace App\Modules\Invoices\Agregate\Commands\Approve\Infrastructure\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Agregate\Commands\Approve\Application\Services\ApproveInvoiceService;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class ApproveInvoiceController extends Controller
{
    public function update(Request $request, string $id): JsonResponse
    {
        $id = Uuid::fromString($id);

        $repository = new InvoiceRepository();
        $service = new ApproveInvoiceService($repository);

        $service->approveInvoice($id);

        return response()->json(['message' => 'invoice approved'], Response::HTTP_OK);
    }
}
