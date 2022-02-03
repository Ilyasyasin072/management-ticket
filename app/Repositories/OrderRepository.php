<?php

namespace App\Repositories;

use App\Models\Orders;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Orders::class;
    }

    public function getOrder() {
        return Orders::with(['users', 'ticket'])->get();
    }
}
