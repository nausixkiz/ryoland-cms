<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionAndPlan\Plan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubscriptionController extends Controller
{
    public function subscription(): View|Factory|Application
    {

        $breadcrumbs = [
            ['link' => route('home'), 'name' => __('Home')],
            ['name' => __('Pricing Plans')],
        ];

        return view('profile.subscription', [
            'breadcrumbs' => $breadcrumbs,
            'plans' => Plan::all(),
        ]);
    }
}
