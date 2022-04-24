<?php

namespace Database\Seeders;

use App\Models\SubscriptionAndPlan\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Basic Monthly',
            'description' => 'Basic plan a month',
            'price' => 19.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        Plan::create([
            'name' => 'Basic Yearly',
            'description' => 'Basic plan within a year',
            'price' => 239.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'year',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 2,
            'currency' => 'USD',
        ]);

        Plan::create([
            'name' => 'Standard Yearly',
            'description' => 'Standard plan within a year',
            'price' => 499.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'year',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 3,
            'currency' => 'USD',
        ]);

        Plan::create([
            'name' => 'Standard Monthly',
            'description' => 'Standard plan within a month',
            'price' => 49.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 4,
            'currency' => 'USD',
        ]);

        Plan::create([
            'name' => 'Enterprise Yearly',
            'description' => 'Enterprise plan within a year',
            'price' => 1199.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'year',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 5,
            'currency' => 'USD',
        ]);

        Plan::create([
            'name' => 'Enterprise Monthly',
            'description' => 'Enterprise plan within a month',
            'price' => 99.00,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 1,
            'trial_interval' => 'day',
            'sort_order' => 6,
            'currency' => 'USD',
        ]);
    }
}
