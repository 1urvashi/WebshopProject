<?php

namespace App\Contracts;

interface PaymentService
{
    public function capturePayment($order_id, $customer_email, $amount);
}
