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

    public function getTicketAll($from = null, $to = null) {
        if(!isset($from) && !isset($to)) {
            return Ticket::paginate(10);
        } else {
            if($from && $to == null) {
                return Ticket::where('from', 'LIKE', '%' .$from .'%')->paginate();
            }
            else if($to && $from == null) {
                return Ticket::where('to', $to)->get();
            } else {
                return Ticket::where('from', $from)->where('to', 'LIKE', '%'. $to .'%')->paginate();
            }

        }
    }
}
