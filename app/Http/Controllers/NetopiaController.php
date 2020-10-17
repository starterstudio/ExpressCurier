<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Netopia\Payment\Address;
use Netopia\Payment\Invoice;
use Netopia\Payment\Request\Card;

class NetopiaController extends Controller
{
    /**
     * SANDBOX : http://sandboxsecure.mobilpay.ro
     * LIVE : https://secure.mobilpay.ro
    **/

    public function SendPayment(Request $request)
    {
        // if ($request->is('post')) // with this gives blank page
        // {
            $x509FilePath = config('app.netopia_publiccert');
            
            try 
            {
                $paymentRequest = new Card();
                $paymentRequest->signature  = config('app.netopia_signature');
                
                $order_hash = $request->input('ffshi');
                // check from DB if this trans has same values from http req
                // check if with this trans already is a browser open (store in DB)
                // bill info & pret_curier, pret_site + curier name

                $trtable = Transaction::where('transaction_id', '<>', null)->get();
                $dbdata = [];
                $tid = "";
                $pret = "";

                foreach ($trtable as $tr)
                {
                    if (hash("sha512", $tr->transaction_id) == $order_hash)
                    {
                        $tid = $tr->transaction_id;
                        $pret = $tr->pret_site;              
                        $dbdata = [
                            //$tr->curier,
                            // $tr->pret_curier,
                            // $tr->pret_site,
                            $tr->nume_factura,
                            $tr->judet_factura,
                            $tr->localitate_factura,
                            $tr->codpostal_factura,
                            $tr->strada_factura,
                            $tr->nrstrada_factura,
                            $tr->bloc_factura,
                            $tr->intrare_factura,
                            $tr->etaj_factura,
                            $tr->apartament_factura,
                            $tr->telefon_factura,
                            $tr->email_factura
                        ];
                    }
                }

                $reqs = [
                    //$request->input('c'),
                    // Crypt::decryptString($request->input('a')),
                    // Crypt::decryptString($request->input('b')),
                    $request->input('Nume_Bill'),
                    $request->input('Judet_Bill'),
                    $request->input('Localitate_Bill'),
                    $request->input('CodPostal_Bill'),
                    $request->input('Strada_Bill'),
                    $request->input('StradaNr_Bill'),
                    $request->input('bfbloc'),
                    $request->input('bfentr'),
                    $request->input('bfetaj'),
                    $request->input('bfapart'),
                    $request->input('Telefon_Bill'),
                    $request->input('Email_Bill')
                ];

                if ($dbdata === $reqs)
                {
                    $paymentRequest->orderId    = $tid;
                
                    // is where mobilPay redirects the client once the payment process is finished 
                    $paymentRequest->confirmUrl = config('app.url') . '/confirm';
                    // is where mobilPay will send the payment result
                    $paymentRequest->returnUrl  = config('app.url') . '/ipn';
    
                    $paymentRequest->invoice = new Invoice();
                    $paymentRequest->invoice->currency  = 'RON';
                    $paymentRequest->invoice->amount    =  $pret;
    
                    $paymentRequest->invoice->tokenId   = null;
                    $paymentRequest->invoice->details   = 'Plata prin card pe - ' . config('app.url');
    
                    $billingAddress = new Address();
                    $billingAddress->type = "person";
                    
                    if (strpos($dbdata[0], ' ') !== false)
                    {
                        $billingAddress->firstName = explode(" ", $dbdata[0])[0];
                        $billingAddress->lastName  = explode(" ", $dbdata[0])[1];
                    }
                    else
                    {
                        $billingAddress->lastName = $billingAddress->firstName = $dbdata[0];
                    }
    
                    $location = $dbdata[1]. " (" . $dbdata[2] . "),\r\n" . $dbdata[3] . ", Nr." . $dbdata[4] . ", Bl." . $dbdata[5] . ", Intrare: " . $dbdata[6]. ", Etaj: " . $dbdata[7] . ", Ap." . $dbdata[8];              
                    $billingAddress->address      = $location;
                    $billingAddress->email        = $dbdata[11];
                    $billingAddress->mobilePhone  = $dbdata[10];
                    $paymentRequest->invoice->setBillingAddress($billingAddress);
    
                    $paymentRequest->encrypt($x509FilePath);
    
                    $EnvKey = $paymentRequest->getEnvKey();
                    $data = $paymentRequest->getEncData();
    
                    $pdata = [ 'env_key' => $EnvKey, 'data' => $data ];
                    if ($pdata != null)
                    {
                        return View('redirect-pay', $pdata);
                    }
                    else
                    {
                        return response()->json([ 'error' => 'Eroare de plata' ]);
                    }
                }         
            }
            catch (Exception $e)
            {
                return "Oops, There is a problem!";
            }
        //}
    }
}
?>