<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Netopia\Payment\Address;
use Netopia\Payment\Invoice;
use Netopia\Payment\Request\Card;
use Netopia\Payment\Request\Notify;
use Netopia\Payment\Request\PaymentAbstract;
use App\Models\Transaction;

class IPNController extends Controller
{
    public $errorCode;
    public $errorType;
    public $errorMessage;
    public $paymentUrl;
    public $x509FilePath;

    public function index()
    {
        $this->errorType = PaymentAbstract::CONFIRM_ERROR_TYPE_NONE;
        $this->errorCode = 0;
        $this->errorMessage = '';

        $this->paymentUrl = config('app.netopia_paymenturl');
        $this->x509FilePath = config('app.netopia_privatecert');

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0){
            if(isset($_POST['env_key']) && isset($_POST['data'])){
                try {
                    $paymentRequestIpn = PaymentAbstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'],$this->x509FilePath);
                    $rrn = $paymentRequestIpn->objPmNotify->rrn;
                    $id_comanda = $paymentRequestIpn->orderId;
                    
                    if ($paymentRequestIpn->objPmNotify->errorCode == 0) {
                        switch($paymentRequestIpn->objPmNotify->action){
                            case 'confirmed':
                                //update DB, SET status = "confirmed/captured"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'confirmed']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            case 'confirmed_pending':
                                //update DB, SET status = "pending"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'pending']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            case 'paid_pending':
                                //update DB, SET status = "pending"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'pending']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            case 'paid':
                                //update DB, SET status = "open/preauthorized"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'open/preauthorized']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            case 'canceled':
                                //update DB, SET status = "canceled"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'canceled']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            case 'credit':
                                //update DB, SET status = "refunded"
                                Transaction::where('transaction_id', $id_comanda)->update(['status' => 'refunded']);
                                $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                                break;
                            default:
                                $errorType = PaymentAbstract::CONFIRM_ERROR_TYPE_PERMANENT;
                                $this->errorCode = PaymentAbstract::ERROR_CONFIRM_INVALID_ACTION;
                                $this->errorMessage = 'mobilpay_refference_action paramaters is invalid';
                        }
                    }else{
                        //update DB, SET status = "rejected"
                        Transaction::where('transaction_id', $id_comanda)->update(['status' => 'rejected']);
                        $this->errorMessage = $paymentRequestIpn->objPmNotify->errorMessage;
                    }
                }catch (Exception $e) {
                    $this->errorType = PaymentAbstract::CONFIRM_ERROR_TYPE_TEMPORARY;
                    $this->errorCode = $e->getCode();
                    $this->errorMessage = $e->getMessage();
                }
            }else{
                $this->errorType = PaymentAbstract::CONFIRM_ERROR_TYPE_PERMANENT;
                $this->errorCode = PaymentAbstract::ERROR_CONFIRM_INVALID_POST_PARAMETERS;
                $this->errorMessag = 'mobilpay.ro posted invalid parameters';
            }
        } else {
            $this->errorType = PaymentAbstract::CONFIRM_ERROR_TYPE_PERMANENT;
            $this->errorCode = PaymentAbstract::ERROR_CONFIRM_INVALID_POST_METHOD;
            $this->errorMessage = 'invalid request metod for payment confirmation';
        }

        /**
         * Communicate with NETOPIA Payments server
         */

        header('Content-type: application/xml');
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        if($this->errorCode == 0)
        {
            echo "<crc>{$this->errorMessage}</crc>";
        }
        else
        {
            echo "<crc error_type=\"{$this->errorType}\" error_code=\"{$this->errorCode}\">{$this->errorMessage}</crc>";
        }

    }
}
