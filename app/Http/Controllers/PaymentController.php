<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Order;
use App\Account;
use App\Package;
use Carbon\Carbon;

class PaymentController extends Controller{
  
  
  public function comandaCardRaspuns(Request $request){
    
    $order = Order::where('id_order',$request->order_id)->first();
    return ['success'=>true, 'order'=>$order];
  }
  
  public function sendOrder(Request $request){
        $user = Session::get('user');
        $user = Account::where('id',$user['id'])->first();
        
        $form_data = $request->only(['tip_pachet']);
        $validationRules = [
            'tip_pachet'    => ['required'],
        ];
        $validationMessages = [
            'tip_pachet.required'    => "Te rugam sa alegi un pachet!",
           
            
        ];
        $validator = Validator::make($form_data, $validationRules, $validationMessages);
        if ($validator->fails()){
            return ['success' => false, 'error' => $validator->errors()->all()];
        } else{
          $order=new Order;
          $order->id_user = $user->id;
          $order->email = $user->email;
          $order->id_abonament = $form_data['tip_pachet'];
          $order->status = 'asteptare';

          //   preiau pachetul
          $pachet = Package::find($form_data['tip_pachet']);
          $order->total = $pachet->pret;
          $order->id_order = null;
          $order->save();
//           Retrive order id, create order_id for mobilPay 
          $id_comanda_salvata = $order->id;
          $order_id_generated = $id_comanda_salvata.(new self())->generateRandomId(5);
//           Create new order object and update order_id
          $order = Order::find($id_comanda_salvata);
          $order->id_order = $order_id_generated;
          $order->save();
          $form = $this->procesare_plata_card($order);
          
//           return ['success'=>false, 'error' => $form];
          if($form!=null){
            return ['formular' => $form,'success'=>true];
          } else{
            return ['success'=>false,'error'=>'S-a produs o eroare, va rugam sa reincercati!'];
          }
        }
  }
  public static function generateRandomId($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '0';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if($randomString[0]== 0){
      $randomString[0] = "1";
    }
    return $randomString;
  }
  
  public function genereaza_formular() {
    $html = request()->get('html');
    return view('appform', ['html' => $html]);
  }
  
  function procesare_plata_card ($order) {
    require_once base_path('app/Mobilpay/Payment/Request/Abstract.php');
    require_once base_path('app/Mobilpay/Payment/Request/Card.php');
    require_once base_path('app/Mobilpay/Payment/Invoice.php');
    require_once base_path('app/Mobilpay/Payment/Address.php');
    
    #for testing purposes, all payment requests will be sent to the sandbox server. Once your account will be active you must switch back to the live server https://secure.mobilpay.ro
    #in order to display the payment form in a different language, simply add the language identifier to the end of the paymentUrl, i.e https://secure.mobilpay.ro/en for English
    $paymentUrl = 'http://sandboxsecure.mobilpay.ro'; //dev
//     $paymentUrl = 'https://secure.mobilpay.ro';
    // this is the path on your server to the public certificate. You may download this from Admin -> Conturi de comerciant -> Detalii -> Setari securitate
    $x509FilePath 	= base_path('app/Mobilpay/certificates/sandbox.DCVR-LVW8-5HPR-3DMJ-J6P6.public.cer');
    try
    {
      srand((double) microtime() * 1000000);
      $objPmReqCard 						= new \Mobilpay_Payment_Request_Card();
      #merchant account signature - generated by mobilpay.ro for every merchant account
      #semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Detalii -> Setari securitate
      $objPmReqCard->signature 			= 'DCVR-LVW8-5HPR-3DMJ-J6P6';
      #you should assign here the transaction ID registered by your application for this commercial operation
      #order_id should be unique for a merchant account
      $objPmReqCard->orderId 				= $order->id_order;
      #below is where mobilPay will send the payment result. This URL will always be called first; mandatory
      $objPmReqCard->confirmUrl 			= \URL::to('/').'/confirm-order'; 
      #below is where mobilPay redirects the client once the payment process is finished. Not to be mistaken for a "successURL" nor "cancelURL"; mandatory
      $objPmReqCard->returnUrl 			= \URL::to('/').'/return-order'; 
      #detalii cu privire la plata: moneda, suma, descrierea
      #payment details: currency, amount, description
      $objPmReqCard->invoice = new \Mobilpay_Payment_Invoice();
      #payment currency in ISO Code format; permitted values are RON, EUR, USD, MDL; please note that unless you have mobilPay permission to 
      #process a currency different from RON, a currency exchange will occur from your currency to RON, using the official BNR exchange rate from that moment
      #and the customer will be presented with the payment amount in a dual currency in the payment page, i.e N.NN RON (e.ee EUR)
      $objPmReqCard->invoice->currency	= 'RON';
      $objPmReqCard->invoice->amount		= $order->total;
      #available installments number; if this parameter is present, only its value(s) will be available
      //$objPmReqCard->invoice->installments= '2,3';
      #selected installments number; its value should be within the available installments defined above
      //$objPmReqCard->invoice->selectedInstallments= '3';
      //platile ulterioare vor contine in request si informatiile despre token. Prima plata nu va contine linia de mai jos.
      $objPmReqCard->invoice->tokenId = $order->id_order;
      $objPmReqCard->invoice->details		= 'Plata online cu cardul';
      #detalii cu privire la adresa posesorului cardului
      #details on the cardholder address (optional)
      $facturare_user = explode(' ', $order->name);
      $first_name = 'Guest';
      $last_name = 'Guest';
      if(isset($facturare_user[0])){
        $first_name = $facturare_user[0];
      }
      if(isset($facturare_user[1])){
        $last_name = $facturare_user[1];
      }
      $billingAddress 				= new \Mobilpay_Payment_Address();
//       $billingAddress->type			= $_POST['billing_type']; //should be "person"
      $billingAddress->firstName		= $first_name;
      $billingAddress->lastName		= $last_name;
      $billingAddress->address		= "no Address";
      $billingAddress->email			= $order->email;
      $billingAddress->mobilePhone		= '123';
      $objPmReqCard->invoice->setBillingAddress($billingAddress);

      #detalii cu privire la adresa de livrare
//       if(isset($livrare_user[0])){
//         $first_name = $livrare_user[0];
//       }
//       if(isset($livrare_user[1])){
//         $last_name = $livrare_user[1];
//       }
      #details on the shipping address
      $shippingAddress 				= new \Mobilpay_Payment_Address();
//       $shippingAddress->type			= $_POST['shipping_type'];
      $shippingAddress->firstName		= $first_name;
      $shippingAddress->lastName		= $last_name;
      $shippingAddress->address		= "No Address";
      $shippingAddress->email			= $order->email;
      $shippingAddress->mobilePhone		= '1234';
      $objPmReqCard->invoice->setShippingAddress($shippingAddress);

      #uncomment the line below in order to see the content of the request
      //echo "<pre>";print_r($objPmReqCard);echo "</pre>";
      $objPmReqCard->encrypt($x509FilePath);
      $mobilpayFormData = new \stdClass();
			$mobilpayFormData->postUrl = $paymentUrl;
			$mobilpayFormData->env_key = $objPmReqCard->getEnvKey();
			$mobilpayFormData->data = $objPmReqCard->getEncData();
//       return $objPmReqCard;
      return json_encode( $mobilpayFormData );
    }
    catch(Exception $e)
    {
      return null;
    }
  }
  
  
  public function confirm_order() {
    require_once base_path('app/Mobilpay/Payment/Request/Abstract.php');
    require_once base_path('app/Mobilpay/Payment/Request/Card.php');
    require_once base_path('app/Mobilpay/Payment/Request/Notify.php');
    require_once base_path('app/Mobilpay/Payment/Invoice.php');
    require_once base_path('app/Mobilpay/Payment/Address.php');

    $errorCode 		= 0;
    $errorType		= \Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_NONE;
    $errorMessage	= '';

    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0)
    {
      if(isset($_POST['env_key']) && isset($_POST['data']))
      {
        #calea catre cheia privata
        #cheia privata este generata de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate
        $privateKeyFilePath = base_path('app/Mobilpay/certificates/sandbox.DCVR-LVW8-5HPR-3DMJ-J6P6private.key');

        try
        {
        $objPmReq = \Mobilpay_Payment_Request_Abstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'], $privateKeyFilePath);
        #uncomment the line below in order to see the content of the request
//         dd($objPmReq);
        $rrn = $objPmReq->objPmNotify->rrn;
        // action = status only if the associated error code is zero
          
          $id_comanda = $objPmReq->orderId;      
          $order = Order::where('id_order', $id_comanda)->first();
//           dd($order, json_encode($objPmReq))
        if ($objPmReq->objPmNotify->errorCode == 0) {
            
              switch($objPmReq->objPmNotify->action)
              {
            #orice action este insotit de un cod de eroare si de un mesaj de eroare. Acestea pot fi citite folosind $cod_eroare = $objPmReq->objPmNotify->errorCode; respectiv $mesaj_eroare = $objPmReq->objPmNotify->errorMessage;
            #pentru a identifica ID-ul comenzii pentru care primim rezultatul platii folosim $id_comanda = $objPmReq->orderId;
            
            case 'confirmed':
              #cand action este confirmed avem certitudinea ca banii au plecat din contul posesorului de card si facem update al starii comenzii si livrarea produsului
            //update DB, SET status = "confirmed/captured"
            $errorMessage = $objPmReq->objPmNotify->errorMessage;
            if($order->status != "platita"){
                $order->status = "platita";
                $order->save();
                $user = Account::find($order->id_user);
                if($order->id_abonament ==1){
                  $user->id_pachet = $order->id_abonament;
                  $user->exp_date = Carbon::now()->addMonths(6);
                }
                if($order->id_abonament ==2){
                  $user->id_pachet = $order->id_abonament;
                  $user->exp_date = Carbon::now()->addYears(1);
                }
                $user->save();
            }
            break;
            case 'confirmed_pending':
              #cand action este confirmed_pending inseamna ca tranzactia este in curs de verificare antifrauda. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
            //update DB, SET status = "pending"
              $errorMessage = $objPmReq->objPmNotify->errorMessage;
              $order->status = "asteptare";
              $order->save();
              break;
            case 'paid_pending':
              #cand action este paid_pending inseamna ca tranzactia este in curs de verificare. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
            //update DB, SET status = "pending"
              $errorMessage = $objPmReq->objPmNotify->errorMessage;
              $order->status = "asteptare";
              $order->save();
                  
              break;
            case 'paid':
              #cand action este paid inseamna ca tranzactia este in curs de procesare. Nu facem livrare/expediere. In urma trecerii de aceasta procesare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
            //update DB, SET status = "open/preauthorized"
              $errorMessage = $objPmReq->objPmNotify->errorMessage;
              $order->status = "asteptare";
              $order->save();
              break;
            case 'canceled':
              #cand action este canceled inseamna ca tranzactia este anulata. Nu facem livrare/expediere.
            //update DB, SET status = "canceled"
            $errorMessage = $objPmReq->objPmNotify->errorMessage;
                  
            $order->status = "canceled";
            $order->save();
              break;
            case 'credit':
              #cand action este credit inseamna ca banii sunt returnati posesorului de card. Daca s-a facut deja livrare, aceasta trebuie oprita sau facut un reverse. 
            //update DB, SET status = "refunded"
            $errorMessage = $objPmReq->objPmNotify->errorMessage;
              break;
          default:
            $errorType		= \Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
              $errorCode 		= \Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_ACTION;
              $errorMessage 	= 'mobilpay_refference_action paramaters is invalid';
              break;
              }
        }
        else {
          //update DB, SET status = "rejected"
          $errorMessage = $objPmReq->objPmNotify->errorMessage;
          $order->status = "canceled";
            $order->save();
            }
        }
        catch(Exception $e)
        {
          $errorType 		= \Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_TEMPORARY;
          $errorCode		= $e->getCode();
          $errorMessage 	= $e->getMessage();
        }
        }
        else
        {
          $errorType 		= \Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
          $errorCode		= \Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_PARAMETERS;
          $errorMessage 	= 'mobilpay.ro posted invalid parameters';
        }
        }
        else 
        {
          $errorType 		= \Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
          $errorCode		= \Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_METHOD;
          $errorMessage 	= 'invalid request metod for payment confirmation';
        }

        header('Content-type: application/xml');
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        if($errorCode == 0)
        {
          echo "<crc>{$errorMessage}</crc>";
        }
        else
        {
          echo "<crc error_type=\"{$errorType}\" error_code=\"{$errorCode}\">{$errorMessage}</crc>";
        }
      }
  
}