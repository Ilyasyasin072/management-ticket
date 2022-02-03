<?php

namespace App\Repositories;

use App\Models\Payment;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class PaymentRepository.
 */
class PaymentRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Payment::class;
    }

    public function getPaymentUser($orderId) {
        return Payment::where('order_id',$orderId)->get();
    }
}
