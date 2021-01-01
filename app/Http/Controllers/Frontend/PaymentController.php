<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
;


class PaymentController extends Controller
{
    private $apiContext;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypalConf = Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypalConf['client_id'],
                $paypalConf['secret'])
        );

        $this->apiContext->setConfig($paypalConf['settings']);
    }

    public function payWithPaypal(Request $request)
    {
        $shipping = 0;
        $tax = 0;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();

        $products = \Cart::session(auth()->id())->getContent();

        $total = \Cart::session(auth()->id())->getTotal();
        foreach($products as $product) {
            $item->setName($product->name) /** item name **/
            ->setCurrency('USD')
                ->setQuantity($product->quantity)
                ->setPrice($product->price); /** unit price **/
        }

        $itemList = new ItemList();
        $itemList->setItems(array($item));

        $details = new Details();
        $details->setShipping($shipping)
            ->setTax($tax)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total + $tax + $shipping)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Payment description')
            ->setInvoiceNumber(uniqid());

        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/paypal-status") /** Specify return URL **/
        ->setCancelUrl("$baseUrl/paypal-status");

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->apiContext));exit; **/

        try {

            $payment->create($this->apiContext);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (Config::get('app.debug')) {

                Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirectUrl = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirectUrl)) {

            /** redirect to paypal **/
            return Redirect::away($redirectUrl);

        }

        Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus()
    {

        $request=request();//try get from method

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        //if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        if (empty($request->PayerID) || empty($request->token)) {

            Session::put('error', 'Payment failed');
            return Redirect::to('/');

        }

        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        //$execution->setPayerId(Input::get('PayerID'));
        $execution->setPayerId($request->PayerID);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {

            Session::put('success', 'Payment success');
            //add update record for cart
//            $email='yangcheebeng@hotmail.com';
//            Notification::route('mail', $email)->notify(new \App\Notifications\orderPaid($email));
            return Redirect::to('products');  //back to product page

        }

        Session::put('error', 'Payment failed');
        return Redirect::to('/');

    }

}
