<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller {

    public $tickerRepo;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->tickerRepo = $ticketRepository;
    }

    public function index() : JsonResponse {

        $ticket = $this->tickerRepo->getTicketALl();

        try {
            return response()->json($ticket);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }
}

