<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class DonationController extends Controller
{
    public function create(Request $request)
    {
        $amount = $request->input('amount', 1000);

        $buyOrder = uniqid();
        $sessionId = uniqid();
        $returnUrl = route('donations.callback');

        $environment = config('services.webpay.environment', Options::ENVIRONMENT_INTEGRATION);
        $apiKey = config('services.webpay.api_key', Options::INTEGRATION_API_KEY);
        $commerceCode = config('services.webpay.commerce_code', '597055555532');
        $options = new Options($apiKey, $commerceCode, $environment);

        $transaction = new Transaction($options);
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        return redirect($response->getUrl() . '?token_ws=' . $response->getToken());
    }

    public function callback(Request $request)
    {
        $token = $request->input('token_ws');

        $environment = config('services.webpay.environment', Options::ENVIRONMENT_INTEGRATION);
        $apiKey = config('services.webpay.api_key', Options::INTEGRATION_API_KEY);
        $commerceCode = config('services.webpay.commerce_code', '597055555532');
        $options = new Options($apiKey, $commerceCode, $environment);

        $transaction = new Transaction($options);
        $result = $transaction->commit($token);

        if ($result->isApproved()) {
            return "✅ Donación exitosa de {$result->getAmount()} CLP";
        } else {
            return "❌ Error en la donación";
        }
    }
}
