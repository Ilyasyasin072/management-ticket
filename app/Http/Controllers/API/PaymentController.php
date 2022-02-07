<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Ticket;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DNS1D;

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
                'status' =>  'required',
                'code_fixed' => 'required',
                'bank_id' => 'required',
                'code_bank_user' => 'required'
            ]);

            if($validator->failed()) {
                return response()->json($validator->errors());
            }

            $checkOrderTicket = Orders::with('ticket')->where('id', $request->order_id)->get();

            $price = 0;
            if($checkOrderTicket) {
                $price += ($checkOrderTicket[0]->ticket->price * $checkOrderTicket[0]->ticket_count);
            }

            $sizeW = 1;
            $sizeH = 33;
            $codeBarcode = 'C39+';
            $coloeBarcode = array(0,0,0);
            $textBarcode = true;

            $da = DNS1D::getBarcodePNGPath('PAY'.$this->paymentRepo->PAY_SUCCESS.$this->paymentRepo->PAY_SUCCESS.$request->bank_id, $codeBarcode,$sizeW,$sizeH,$coloeBarcode, $textBarcode);
            \Storage::disk('public')->put($da,(DNS1D::getBarcodePNGPath('PAY'.$this->paymentRepo->PAY_SUCCESS.$this->paymentRepo->PAY_SUCCESS.$request->bank_id, $codeBarcode,$sizeW,$sizeH,$coloeBarcode, $textBarcode)));


            $data = [
                'order_id' => $request->order_id,
                'sum_price' =>  $price,
                'status' =>   $this->paymentRepo->PAY_SUCCESS,
                'code_fixed' =>  'PAY'.$this->paymentRepo->PAY_SUCCESS.$this->paymentRepo->PAY_SUCCESS.$request->bank_id,
                'bank_id' =>  $request->bank_id,
                'code_bank_user' =>  $request->code_bank_user,
                'user_id' => auth()->user()->id,
                'url_barcode' => \URL::to($da)
            ];

            $this->paymentRepo->create($data);

            return response()->json((object) 'success');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function showPayOrder(Request $request) {
        try {
            return $this->paymentRepo->payUsersOrder($request->order_id);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}

