<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SubscriptionAndPlan\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    public function orderCallback(Request $request)
    {
        $orderData = $request->input('orderData');
        $user = User::findBySlugOrFail(($request->input('user_slug')));
        $amount = $orderData['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

        $payment = new Payment();
        $payment->order_id = $orderData['id'];
        $payment->currency = $orderData['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
        $payment->amount = $amount;
        $payment->payment_channel = 'Paypal';
        $payment->dataCapture = json_encode($request->orderData);
        $payment->status = $orderData['status'];

        $payment->user()->associate($user);

        $payment->save();

        $plan = Plan::wherePrice($amount)->first();

        if($user->subscribedTo($plan->id)){
            $user->planSubscription('primary')->renew();
        }
        else{
            $user->newPlanSubscription('primary', $plan);
        }

        return response()->json('ok');
    }
}
