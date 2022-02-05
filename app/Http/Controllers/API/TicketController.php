<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller {
    public $ticketRepo;
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepo = $ticketRepository;
    }

    public function index(Request $request) : JsonResponse {
        try {
            $from = $request->from;
            $to = $request->to;
            return response()->json($this->ticketRepo->getTicketAll($from, $to));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }
}

