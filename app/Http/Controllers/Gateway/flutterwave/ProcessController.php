<?php

namespace App\Http\Controllers\Gateway\flutterwave;

use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
{
    /*
     * flutterwave Gateway
     */

    public static function process($deposit)
    {
        $flutterAcc = json_decode($deposit->gateway_currency()->gateway_parameter);

        $send['API_publicKey'] = $flutterAcc->public_key;
        $send['customer_email'] = Auth::user()->email;
        $send['amount'] = round($deposit->final_amo, 2);
        $send['customer_phone'] = Auth::user()->mobile;
        $send['currency'] = $deposit->method_currency;
        $send['txref'] = $deposit->trx;



        $alias = $deposit->gateway->alias;
        $send['view'] = 'user.payment.' . $alias;
        return json_encode($send);
    }

    public function ipn($track, $type)
    {
        if ($type == 'error') {
            $notify[] = ['error', 'Transaction Failed, Ref: ' . $track];
        } else {
            if (isset($track)) {
                $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
                if (!$data) {
                    $notify[] = ['error', 'No deposit found with trx: ' . $track];
                    return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
                }

                $flutterAcc = json_decode($data->gateway_currency()->gateway_parameter);
                $query = array(
                    "SECKEY" => $flutterAcc->secret_key,
                    "txref" => $track
                );

                $data_string = json_encode($query);
                $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $response = curl_exec($ch);
                curl_close($ch);

                if ($response === false) {
                    $notify[] = ['error', 'CURL request failed'];
                    return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
                }

                $response = json_decode($response);

                if (!$response || !isset($response->status) || !isset($response->data)) {
                    $notify[] = ['error', 'Invalid response from payment gateway'];
                    return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
                }

                if ($response->status == "success" && $response->data->chargecode == "00" && $data->final_amo == $response->data->amount && $data->method_currency == $response->data->currency && $data->status == '0') {
                    (new PaymentController())->userDataUpdate($data->trx);
                    $notify[] = ['success', 'Transaction was successful, Ref: ' . $track];
                } else {
                    $notify[] = ['error', 'Transaction verification failed, Ref: ' . $track];
                }
            } else {
                $notify[] = ['error', 'Missing transaction reference'];
            }

            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
    }
}
