<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller {
    public $ticketRepo;
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepo = $ticketRepository;
    }

    public function index() : JsonResponse {
        try {
            return response()->json($this->ticketRepo->getTicketAll());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }
}

