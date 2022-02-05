<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller {

    public $orderRepo;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepo = $orderRepository;
    }

    public function index() : JsonResponse {
        try {
            $orders = $this->orderRepo->getOrder();

            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function create(Request $request) : JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'ticket_count' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors());
            }


            $getPriceTicket = Ticket::find($request->ticket_id)->first();

           if($getPriceTicket) {
               $data = [
                   'user_id' => auth()->user()->id,
                   'ticket_id' => $request->ticket_id,
                   'ticket_count' => $request->ticket_count,
                   'price' => $getPriceTicket->price,
//                'code_temp' => 'ODR' . strtoupper(Str::random(4)),
                   'status' => 0
               ];

               $this->orderRepo->create($data);

               return response()->json((object) 'success');
           }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}

