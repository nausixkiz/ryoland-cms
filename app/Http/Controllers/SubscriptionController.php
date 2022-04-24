<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionAndPlan\Plan;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class SubscriptionController extends Controller
{
    private PayPalClient $provider;

    /**
     * @throws Throwable
     */
    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setCurrency(currency()->getUserCurrency());
        $token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($token);
    }

    public function subscription(): View|Factory|Application
    {
        return view('profile.subscription');
    }

    /**
     * @throws Throwable
     */
    public function createSubscription()
    {
        $data = [];
        $data['plan_id'] = 'RYOLAND-' . Str::uuid();
        $data['start_time'] = Carbon::now();
        $data['quantity'] = 1;
        $data['shipping_amount']['currency_code'] = currency()->getUserCurrency();
        $data['shipping_amount']['value'] = '100.00';
        $data['subscriber']['name']['given_name'] = 'John';
        $data['subscriber']['name']['surname'] = 'John';
        $data['email_address'] = auth()->user()->email;
        $data['application_context']['brand_name'] = config('app.name');
        $data['application_context']['locale'] = config('app.locale');
        $data['application_context']['shipping_preference'] = 'SET_PROVIDED_ADDRESS';
        $data['application_context']['user_action'] = 'SUBSCRIBE_NOW';
        $data['application_context']['payment_method']['payer_selected'] = 'PAYPAL';
        $data['application_context']['payment_method']['payee_preferred'] = 'IMMEDIATE_PAYMENT_REQUIRED';

        $subscription = $this->provider->createSubscription($data);

        dd($subscription);

    }

    public function createPlan()
    {
        $data = [];
        $data['product_id'] = 'RYOLAND-' . Str::uuid();
        $data['name'] = 'RyoLand Subscription';
        $data['description'] = 'RyoLand Subscription';
        $data['status'] = 'ACTIVE';

        $data['billing_cycles']['frequency']['interval_unit'] = 'MONTH';
        $data['billing_cycles']['frequency']['interval_count'] = 1;
        $data['billing_cycles']['tenure_type'] = 'TRIAL';
        $data['billing_cycles']['sequence'] = 1;
        $data['billing_cycles']['total_cycles'] = 2;
        $data['billing_cycles']['pricing_scheme']['fixed_price']['value'] = 2;
        $data['billing_cycles']['pricing_scheme']['fixed_price']['currency_code'] = currency()->getUserCurrency();

        $data['payment_preferences']['auto_bill_outstanding'] = true;
        $data['payment_preferences']['setup_fee']['value'] = 2;
        $data['payment_preferences']['setup_fee']['currency_code'] = 'USD';
        $data['payment_preferences']['setup_fee_failure_action'] = 'CONTINUE';
        $data['payment_preferences']['payment_failure_threshold'] = 3;
        // Phí
        $data['taxes']['percentage'] = 10;
        $data['taxes']['inclusive'] = true;


        $plan = $this->provider->createPlan($data, 'PLAN-18062019-001');
        dd($plan);
    }
}
