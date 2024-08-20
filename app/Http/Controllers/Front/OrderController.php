<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobClass;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Mail\JobApplicationSubmitted;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Stripe\Customer;
use Stripe\Charge;


class OrderController extends Controller
{
    public function payment($price)
    {
        try {
            $price = decrypt($price);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404); // Handle decryption failure
        }

        if ($price == '2.95' || $price == '5.95' || $price == '9.95') {
            if($price == '2.95'){
                $sub_type = 'Standard';
                $price = 23.95;
            }else if($price == '5.95'){
                $sub_type = 'Premium';
                $price = 71.40;
            }else if($price == '9.95'){
                $sub_type = 'Enterprise';
                $price = 29.95;
            }else{
                $sub_type = 'Standard';
                $price = 23.95;
            }
            return view('front.auth.payment', compact('price', 'sub_type'));
        } else {
            abort(404); // Handle invalid price
        }
    }

    public function place_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'subscription_box' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if($request->input('payment_method') == 'stripe'){

            try {
                try {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                    $customer = \Stripe\Customer::create(array(
                        'email' => Auth::user()->email,
                        'name' => Auth::user()->name,
                        'phone' => Auth::user()->mobile_number,
                        'description' => "Client Created From Website",
                        'source'  => $request->stripeToken,
                    ));

                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
                // dd($total * 100);
                try {
                    $charge = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount'   => $request->input('price') * 100,
                        'currency' => 'USD',
                        'description' => "Payment From Website",
                        'metadata' => array("name" => Auth::user()->name, "email" => Auth::user()->email),
                    ));

                } catch (Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            } catch (Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }

            $chargeJson = $charge->jsonSerialize();
        }

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_amount = $request->input('price');
        $order->status = $paymentStatus === 'succeeded' ? 'completed' : 'failed';
        $order->payment_method = $request->input('payment_method');
        $order->payment_status = $paymentStatus === 'succeeded' ? 'paid' : 'unpaid';
        $order->subscription_box = $request->input('subscription_box');

		do {
            $orderNumber = rand(0, 999999999999999);
            $exists = Order::where('order_number', $orderNumber)->exists();
        } while ($exists);

        $order->save();

        return redirect()->back()->with('success', 'Subscription Successfully Purchased.');
    }
}
