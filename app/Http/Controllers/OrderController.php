<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
//use App\Services\PaymentService;
use App\Contracts\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $order = Order::all();
        return response()->json(['data' =>  $order]);
    }

    public function store(Request $request)
    {
        // Create order in the database
        Order::create($request->all());
        return response()->json(['message' => 'Order created']);
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return  response()->json(['message' => 'Order updated', 'data' => $order]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }

    public function addProduct($id, Request $request)
    {
        $order = Order::findOrFail($id);

        if ($order->paid) {
            return response()->json(['message' => 'Cannot add product to paid order'], 422);
        }

        $product = Product::findOrFail($request->input('product_id'));

        // Attach product to the order
        $order->products()->attach($product->id);

        return response()->json(['message' => 'Product added to order']);
    }

    public function payOrder($id, Request $request,PaymentService $paymentService)
    {
        $order = Order::findOrFail($id);

        if ($order->paid) {
            return response()->json(['message' => 'Order is already paid'], 422);
        }

         // Capture payment using the injected PaymentService
        $paymentResponse = $paymentService->capturePayment(
            $order->id,
            $request->input('customer_email'),
            $request->input('value')
        );

        //If you are using direct check with demo data, you can utilize the paymentService.uncomment code in the App\Services\PaymentService above the "top up" section.

        // $paymentResponse = $this->paymentService->capturePayment(
        //     $order->id,
        //     $request->input('customer_email'),
        //     $request->input('value')
        // );

        if ($paymentResponse['status'] === 'success') {
            $order->update(['paid' => true]);
            return response()->json(['message' => 'Order paid successfully']);
        } else {
            return response()->json(['message' => 'Payment failed'], 422);
        }
    }


}
