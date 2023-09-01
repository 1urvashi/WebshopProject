<?php
namespace App\Services;

class PaymentService
{
   
    public function capturePayment($order_id, $customer_email, $value)
    {
        // Call the Super Payment Provider API here
        if ($value >= 33.4) {
            return ['status' => 'success', 'message' => 'Payment Successful'];
        } else {
            return ['status' => 'failed', 'message' => 'Insufficient Funds'];
        }
    }
}

?>
