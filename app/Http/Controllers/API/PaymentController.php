<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function create(Request $request) : JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'sum_price' => 'required',
                'status' =>  'required',
                'code_fixed' => 'required',
                'bank_id' => 'required',
                'code_bank_user' => 'required'
            ]);

            if($validator->failed()) {
                return response()->json($validator->errors());
            }

            $data = [
                'order_id' => $request->order_id,
                'sum_price' =>  $request->sum_price,
                'status' =>   $this->paymentRepo->PAY_SUCCESS,
                'code_fixed' =>  'PAY'. Str::random(4),
                'bank_id' =>  $request->bank_id,
                'code_bank_user' =>  $request->code_bank_user,
                'user_id' => auth()->user()->id,
            ];

            $this->paymentRepo->create($data);

            return response()->json((object) 'success');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}

