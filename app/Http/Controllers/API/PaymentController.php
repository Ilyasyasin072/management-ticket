<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller {

    public $paymentRepo;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepo = $paymentRepository;
    }

    public function index() : JsonResponse {
        try {
            $payment = $this->paymentRepo->getPaymentUser('1');
            return response()->json($payment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}

