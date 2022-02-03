<?php

namespace App\Repositories;

use App\Models\Ticket;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TicketRepository.
 */
class TicketRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Ticket::class;
    }

    public function getTicketAll() {
        return Ticket::where('user_id', auth()->user()->id)->get();
    }
}
