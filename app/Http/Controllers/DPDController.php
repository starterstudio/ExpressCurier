<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Transaction;

class DPDController extends Controller
{
    // public $dpd_price;
    // public $total_price;

    public function RequestAWB(Request $request)
    {
        //check if status is paid
        
        
        //call api

        //return view thank-you

    }

    public function SaveUserInfo(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $error_message = "";
            $pack          = "";
            $val_dec       = "";
            $continut      = "";
            $observatii    = "";
            $date_import   = "";
            $documents     = "";

            // # start validation #
            if (empty($request->input('greutate')))
            {
                $error_message = "Ai uitat sa completezi greutatea coletului.";
            }
            else if (empty($request->input('continut')))
            {
                $error_message = "Ai uitat sa completezi continutul coletului.";
            }
            else if (!empty($val_dec) && (int)$val_dec <= 0)
            {
                $error_message = "Valoarea declarata este invalida.";
            }
            else if ((int)$request->input('ramburs') > 0 && empty($request->input('fibanc')))
            {
                $error_message = "Ai uitat sa completezi IBAN-ul.";
            }
            else if ((int)$request->input('ramburs') > 0 && $this->validate_iban($request->input('fibanc')) != '1')
            {
                $error_message = "IBAN-ul este invalid.";
            }
            else if (empty($request->input('Nume_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Numele expeditorului.";
            }
            else if (empty($request->input('Judet_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Judetul expeditorului.";
            }
            else if (empty($request->input('Localitate_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Localitatea expeditorului.";
            }
            else if (empty($request->input('CodPostal_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Codul Postal al expeditorului.";
            }
            else if (empty($request->input('Strada_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Strada expeditorului.";
            }
            else if (empty($request->input('StradaNr_Expeditor')))
            {
                $error_message = "Ai uitat sa completezi Numarul Strazii expeditorului.";
            }
            else if (empty($request->input('Telefon_Expeditor')) | !$this->validate_phone_number($request->input('Telefon_Expeditor'))) //validate tel nr
            {
                $error_message = "Ai uitat sa completezi Telefonul expeditorului sau numarul este invalid.";
            }
            else if (empty($request->input('Nume_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Numele destinatarului.";
            }
            else if (empty($request->input('Judet_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Judetul destinatarului.";
            }
            else if (empty($request->input('Localitate_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Localitatea destinatarului.";
            }
            else if (empty($request->input('CodPostal_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Codul Postal al destinatarului.";
            }
            else if (empty($request->input('Strada_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Numele Strazii destinatarului.";
            }
            else if (empty($request->input('StradaNr_Destinatar')))
            {
                $error_message = "Ai uitat sa completezi Numarul Strazii destinatarului.";
            }
            else if (empty($request->input('Telefon_Destinatar')) | !$this->validate_phone_number($request->input('Telefon_Destinatar'))) //validate tel nr
            {
                $error_message = "Ai uitat sa completezi Telefonul destinatarului sau numarul este invalid.";
            }
            else if (empty($request->input('Nume_Bill')))
            {
                $error_message = "Ai uitat sa completezi Numele la Adresa de Facturare.";
            }
            else if (empty($request->input('Judet_Bill')))
            {
                $error_message = "Ai uitat sa completezi Judetul la Adresa de Facturare.";
            }
            else if (empty($request->input('Localitate_Bill')))
            {
                $error_message = "Ai uitat sa completezi Localitatea la Adresa de Facturare.";
            }
            else if (empty($request->input('CodPostal_Bill')))
            {
                $error_message = "Ai uitat sa completezi Codul Postal la Adresa de Facturare.";
            }
            else if (empty($request->input('Strada_Bill')))
            {
                $error_message = "Ai uitat sa completezi Numele Strazii la Adresa de Facturare.";
            }
            else if (empty($request->input('StradaNr_Bill')))
            {
                $error_message = "Ai uitat sa completezi Numarul Strazii la Adresa de Facturare.";
            }
            else if (empty($request->input('Telefon_Bill')) | !$this->validate_phone_number($request->input('Telefon_Bill')))
            {
                $error_message = "Ai uitat sa completezi Numarul de Telefon sau numarul este invalid la Adresa de Facturare.";
            }
            else if (empty($request->input('Email_Bill')) | !filter_var($request->input('Email_Bill'), FILTER_VALIDATE_EMAIL)) // validate email
            {
                $error_message = "Ai uitat sa completezi Adresa de E-Mail sau este invalida la Adresa de Facturare.";
            }

            // # end validation #

            $colet       = $request->input('colet');
            $plic        = $request->input('plic');
            $eximport    = $request->input('import_expeditor');
            $deimport    = $request->input('import_destinatar');

            $weight      = $request->input('greutate');
            $length      = $request->input('lungime');
            $height      = $request->input('inaltime');
            $width       = $request->input('latime');        

            if ($colet == "true") //check if pack is colet or plic
            {
                //calculate KG based on W H L
                if ((int)$weight == 0) { $weight = 1; }
                else if ((int)$weight > 31) { $weight = 31; }    

                $val_dec    = $request->input('valoare');
                $continut   = $request->input('continut');
                $observatii = $request->input('observatii');
                $documents  = "false";
                $pack       = "colet";
            }
            else if ($plic == "true")
            {
                $weight     = "0";
                $val_dec    = $request->input('plic_valoare');
                $continut   = $request->input('plic_continut');
                $observatii = $request->input('plic_observatii');
                $documents  = "true";
                $pack       = "plic";
            }
            else
            {
                $error_message = "Nu ai selectat colet sau plic.";
            }

            if ($eximport == "true")
            {
                $date_import = "adresa expeditor";
            }
            else if ($deimport == "true")
            {
                $date_import = "adresa destinatar";
            }

            $trid = md5(uniqid(rand()));

            $data = [
                'type' =>  $pack,
                'greutate' => $weight,
                'lungime' => $length,
                'latime' => $width,
                'inaltime' => $height,

                'valoarea_declarata' => $val_dec,
                'continut' => $continut,
                'observatii' => $observatii,
                'ramburs' => $request->input('ramburs'),
                'iban' => $request->input('fibanc'),

                'nume_expeditor' => $request->input('Nume_Expeditor'),
                'judet_expeditor' => $request->input('Judet_Expeditor'),
                'localitate_expeditor' => $request->input('Localitate_Expeditor'),
                'codpostal_expeditor' => $request->input('CodPostal_Expeditor'),
                'strada_expeditor' => $request->input('Strada_Expeditor'),
                'nrstrada_expeditor' => $request->input('StradaNr_Expeditor'),
                'bloc_expeditor' => $request->input('Bloc_Expeditor'),
                'intrare_expeditor' => $request->input('Intrare_Expeditor'),
                'etaj_expeditor' => $request->input('Etaj_Expeditor'),
                'apartament_expeditor' => $request->input('Apartament_Expeditor'),
                'telefon_expeditor' => $request->input('Telefon_Expeditor'),
                'persoana_contact_expeditor' => $request->input('NumeContact_Expeditor'),

                'nume_destinatar' => $request->input('Nume_Destinatar'),
                'judet_destinatar' => $request->input('Judet_Destinatar'),
                'localitate_destinatar' => $request->input('Localitate_Destinatar'),
                'codpostal_destinatar' => $request->input('CodPostal_Destinatar'),
                'strada_destinatar' => $request->input('Strada_Destinatar'),
                'nrstrada_destinatar' => $request->input('StradaNr_Destinatar'),
                'bloc_destinatar' => $request->input('Bloc_Destinatar'),
                'intrare_destinatar' => $request->input('Intrare_Destinatar'),
                'etaj_destinatar' => $request->input('Etaj_Destinatar'),
                'apartament_destinatar' => $request->input('Apartament_Destinatar'),
                'telefon_destinatar' => $request->input('Telefon_Destinatar'),
                'persoana_contact_destinatar' => $request->input('NumeContact_Destinatar'),

                'date_facturare_importate' => $date_import,

                'nume_factura' => $request->input('Nume_Bill'),
                'cui_factura' => $request->input('bfcui'),
                'reg_comert_factura' => $request->input('bfregnr'),
                'judet_factura' => $request->input('Judet_Bill'),
                'localitate_factura' => $request->input('Localitate_Bill'),
                'codpostal_factura' => $request->input('CodPostal_Bill'),
                'strada_factura' => $request->input('Strada_Bill'),
                'nrstrada_factura' => $request->input('StradaNr_Bill'),
                'bloc_factura' => $request->input('bfbloc'),
                'intrare_factura' => $request->input('bfentr'),
                'etaj_factura' => $request->input('bfetaj'),
                'apartament_factura' => $request->input('bfapart'),
                'telefon_factura' => $request->input('Telefon_Bill'),
                'email_factura' => $request->input('Email_Bill'),

                'status' => 'neplatit',
                'awb' => '',
                'curier' => $request->input('c'),
                'data_ridicare' => '',
                'data_livrare' => '',
                'transaction_id' => $trid,
                'pret_curier' => Crypt::decryptString($request->input('a')),
                'pret_site' => Crypt::decryptString($request->input('b'))
            ];
            if (!$error_message)
            {
                if (Transaction::create($data))
                {
                    return response()->json(['x' => hash("sha512", $trid)]);
                }
            }
            else
            {
                return response()->json([ 'error' => $error_message ]);
            }            
        }
        else
        {
            return back();
        }
    }

    public function CalculateChange(Request $request) //make also for plic
    {
        if ($request->isMethod('post'))
        {
            $error_message = "";

            $weight    = "";
            $length     = "";
            $height     = "";
            $width      = "";
            $documents  = "";
            $val_dec    = "";
            $total_weight = "";
            $ramburs_value  = "";
            //$continut   = "";
            //$observatii = "";

            if ($request->input('colet') == "true") //check if pack is colet or plic
            {
                //calculate KG based on W H L
                $weight = $request->input('weight');
                $length = $request->input('length');
                $height = $request->input('height');
                $width  = $request->input('width');

                if ((int)$weight == 0) { $weight = 1; }
                else if ((int)$weight > 31) { $weight = 31; }    

                $val_dec    = $request->input('declared_value');

                $calc           = ((int)$length * (int)$height * (int)$width)/6000;
                $total_weight   = number_format($calc > $weight ? $calc : $weight);
                $ramburs_value  = $request->input('ramburs_value');
                //$continut   = $request->input('continut');
                //$observatii = $request->input('observation');
                $documents  = "false";
            }
            else if ($request->input('plic') == "true")
            {
                $total_weight     = "0";
                $val_dec    = $request->input('plic_valoare');
                $ramburs_value  = "0"; // here modify
                //$continut   = $request->input('plic_continut');
                //$observatii = $request->input('plic_observatii');
                $documents  = "true";
            }
            else
            {
                $error_message = "Nu ai selectat colet sau plic.";
            }

            // $weight         = $request->input('weight');
            // $length         = $request->input('length');
            // $height         = $request->input('height');
            // $width          = $request->input('width');

            // if ((int)$weight == 0) { $weight = 1; }
            // else if ((int)$weight > 31) { $weight = 31; }
   
            // $calc           = ((int)$length * (int)$height * (int)$width)/6000;
            // $total_weight   = number_format($calc > $weight ? $calc : $weight);

            //$content        = $request->input('content');
            //$declared_value = $request->input('declared_value');
            //$observation    = $request->input('observation');
            //$ramburs_value  = $request->input('ramburs_value');
            
            $dpd_pdata = array(
                'userName'  => config('app.dpd_username'),
                'password'  => config('app.dpd_password'),
                'recipient' => array(
                    'privatePerson'   => 'true',
                    'addressLocation' => array(
                        'siteId'   => '642279132',
                        'postCode' => '010572'
                    )
                ),
                'service'   => array(
                    'autoAdjustPickupDate' => 'true',
                    'serviceIds'           => array(
                        '2505'
                    ),
                    'additionalServices'   => array(
                        'cod'           => array(
                            'amount'               => $ramburs_value,
                            'currencyCode'         => 'RON',
                            'processingType'       => 'CASH',
                            'includeShippingPrice' => 'false'
                        ),
                        'declaredValue' => array(
                            'amount'  => $val_dec,
                            'currencyCode' => 'RON',
                            'fragile' => 'false'
                        ),
                    )
                ),
                'payment'   => array(
                    'courierServicePayer' => 'SENDER',
                    'packagePayer' => 'SENDER'
                ),
                'content'   => array(
                    //'contents' => '',
                    'documents' => $documents,
                    'pendingParcels' => 'false',
                    'package' => 'BOX',
                    'palletized' => 'false',
                    'parcelsCount' => '1',
                    'totalWeight' => $total_weight,
                    'parcels' => array(
                        array(
                            'seqNo' => '1',
                            'size' => array(
                                'width' => $width,
                                'depth' => $length,
                                'height' => $height
                            ),
                            'weight' => $total_weight
                        )
                    ),
                    //'shipmentNote' => $observation
                ),                
            );

            // DPD Service
            $dpd_req_url = config('app.dpd_baseurl') . '/calculate?';
            $dpd_result  = Http::post($dpd_req_url, $dpd_pdata);
            $dpd_jdata   = json_decode($dpd_result, true);

            $dpd_sum     = $dpd_jdata['calculations']['0']['price']['total'];  //store in db
            // if (!isset($dpd_sum))
            //     $error_message = "Eroare DPD";

            $dpd_total   = (int)$dpd_sum + (((int)$dpd_sum * 15)/100);
            $dpd_calc    = number_format((float)((int)$ramburs_value > 0 ? ($dpd_total + 6) : $dpd_total), 2, '.', '');

            if (!$error_message)
            {
                // send info to client view
                return response()->json([
                    'dpd_greutate'   => $total_weight,
                    'ramburs'        => ((int)$ramburs_value > 0 ? "6 Lei" : "0 Lei"),
                    'dpd_transport'  => number_format((float)$dpd_total, 2, '.', ''),
                    'dpd_total'      => $dpd_calc,
                    'ax'             => Crypt::encryptString($dpd_sum),
                    'bx'             => Crypt::encryptString($dpd_calc)
                ]);           
            }
            else
            {
                return response()->json([ 'error' => $error_message ]);
            }
        }
    }

    private function CalculateKG($kg, $a, $b, $c)
    {
        if ((int)$kg == 0) { $kg = 1; }
        else if ((int)$kg > 31) { $kg = 31; }
        if ((int)$a >= 120)
        {
            $a = 120;
            $b = 155;
            $c = 1;
        }
        else if ((int)$b >= 120)
        {
            $b = 120;
            $a = 155;
            $c = 1;
        }
        else if ((int)$c >= 120)
        {
            $c = 120;
            $a = 155;
            $b = 1;
        }
        $x = ($a * $b * $c)/6000;
        $rkg = ($x > $kg) ? $x :$kg;
        return ;
    }

    public function GetLocalities(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $pdata = array(
                'userName'  => config('app.dpd_username'),
                'password'  => config('app.dpd_password'),
                'countryId' => '642',
                'name'      => $request->input('sn')
                );
            
                $uri = config('app.dpd_baseurl') . '/location/site?';
                $result = Http::post($uri, $pdata);
                return $result;
        }
    }

    private function validate_phone_number($phone)
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
        return true;
        }
    }

    private function validate_iban($input)
    {
        $iban = strtolower($input);

        // The official min length is 5. Also prevents substringing too short input.
        if(strlen($iban) < 5) return false;

        // lengths of iban per country
        $Countries = array(
            'al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,'cr'=>21,'hr'=>21,'cy'=>28,'cz'=>24,
            'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,'gt'=>28,'hu'=>28,
            'is'=>26,'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,'lt'=>20,'lu'=>20,'mk'=>19,
            'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,'nl'=>18,'no'=>15,'pk'=>24,'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,
            'ro'=>24,'sm'=>27,'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,'ch'=>21,'tn'=>24,'tr'=>26,'ae'=>23,'gb'=>22,'vg'=>24
        );
        // subsitution scheme for letters
        $Chars = array(
            'a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15,'g'=>16,'h'=>17,'i'=>18,'j'=>19,'k'=>20,'l'=>21,'m'=>22,
            'n'=>23,'o'=>24,'p'=>25,'q'=>26,'r'=>27,'s'=>28,'t'=>29,'u'=>30,'v'=>31,'w'=>32,'x'=>33,'y'=>34,'z'=>35
        );

        // Check input country code is known
        if (!isset($Countries[ substr($iban,0,2) ])) return false;

        // Check total length for given country code
        if (strlen($iban) != $Countries[ substr($iban,0,2) ]) { return false; }

        // Move first 4 chars to end
        $MovedChar = substr($iban, 4) . substr($iban,0,4);

        // Replace letters by their numeric variant
        $MovedCharArray = str_split($MovedChar);
        $NewString = "";
        foreach ($MovedCharArray as $k => $v) {
            if ( !is_numeric($MovedCharArray[$k]) ) {
                // if any other cahracter then the known letters, its bogus
                if(!isset($Chars[$MovedCharArray[$k]])) return false;
                $MovedCharArray[$k] = $Chars[$MovedCharArray[$k]];
            }
            $NewString .= $MovedCharArray[$k];
        }

        // Now we just need to validate the checksum
        // Use bcmod if available
        if (function_exists("bcmod")) { return bcmod($NewString, '97') == 1; }

        // Else use this workaround
        // http://au2.php.net/manual/en/function.bcmod.php#38474
        $x = $NewString; $y = "97";
        $take = 5; $mod = "";
        do {
            $a = (int)$mod . substr($x, 0, $take);
            $x = substr($x, $take);
            $mod = $a % $y;
        }
        while (strlen($x));
        return (int)$mod == 1;

    }
}
