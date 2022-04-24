<?php

namespace App\Console\Commands\Currency;

use DateTime;
use Illuminate\Console\Command;
use Torann\Currency\Currency;

class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exchange rates from an online source';

    /**
     * Currency instance
     *
     * @var Currency
     */
    protected mixed $currency;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->currency = app('currency');

        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle()
    {
        // Get Settings
        $defaultCurrency = $this->currency->config('default');

        if (!$api = $this->currency->config('api_key')) {
            $this->error('An API key is needed from OpenExchangeRates.org to continue.');

            return !1;
        }

        $this->info('Updating currency exchange rates from OpenExchangeRates.org...');

        // Make request
        $content = json_decode(
            $this->request("https://openexchangerates.org/api/latest.json?base={$defaultCurrency}&app_id={$api}&show_alternative=1")
        );

        // Error getting content?
        if (isset($content->error)) {
            $this->error($content->description);

            return !1;
        }

        // Parse timestamp for DB
        $timestamp = (new DateTime())->setTimestamp($content->timestamp);

        // Update each rate
        foreach ($content->rates as $code => $value) {
            $this->currency->getDriver()->update($code, [
                'exchange_rate' => $value,
                'updated_at' => $timestamp,
            ]);
        }

        $this->currency->clearCache();

        $this->info('Update!');

        return !0;
    }

    /**
     * Make the request to the sever.
     *
     * @param $url
     *
     * @return string
     */
    private function request($url): string
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_MAXCONNECTS, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
