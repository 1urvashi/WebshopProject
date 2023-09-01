<?php
namespace App\Payment;

use App\Contracts\PaymentService;
use Illuminate\Support\Facades\Http;

class SuperPaymentService implements PaymentService
{
    public function capturePayment($order_id, $customer_email,$amount)
    {
        // Simulate payment process using the Super Payment Provider
        $paymentResponse = Http::post('https://superpay.view.agentur-loop.com/pay', [
            'amount' => $amount,
        ]);

        return $paymentResponse->successful();
    }
}
