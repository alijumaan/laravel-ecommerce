<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\User;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

use Illuminate\Http\Request;

use PayPal\Api\PaymentExecution;

class PurchaseController extends Controller
{
    public function createPayment(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'Aaqco3nIPqsLzJoIsGnkE1bscCDPmPkyGUOgTbRzNFfAg_QowlV2R3XhMjpGM25CVbfRGJBGaJF5bDLI',
                'ECtirpK9v9UNofFiaUJLXvIkqRwfR126_IuBMjn1wow8XmLQ8osQpSKIzgqolsZZxRvmU1LvK_b0N-vS')
        );

        $shipping = 0;
        $tax = 0;

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $products = User::find($request->userId)->productsInCart;
//        $products = \Cart::session(auth()->id())->getContent();

        $itemsArray = array();

        $total = \Cart::session(auth()->id())->getTotal();

        foreach($products as $product) {

            $item = new Item();
            $item->setName($product->name)
                ->setCurrency('USD')
                ->setQuantity($product->quantity)
                ->setSku($product->id) // Similar to `item_number` in Classic API
                ->setPrice($product->price);

            array_push($itemsArray, $item);
        }

        $itemList = new ItemList();
        $itemList->setItems($itemsArray);

        $details = new Details();
        $details->setShipping($shipping)
            ->setTax($tax)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total + $tax + $shipping)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/cart")
            ->setCancelUrl("$baseUrl/cart");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);
        } catch (\Exception $ex) {
            echo $ex;
            exit(1);
        }
        $approvalUrl = $payment->getApprovalLink();
        return $payment;
    }

    public function executePayment(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'Aaqco3nIPqsLzJoIsGnkE1bscCDPmPkyGUOgTbRzNFfAg_QowlV2R3XhMjpGM25CVbfRGJBGaJF5bDLI',
                'ECtirpK9v9UNofFiaUJLXvIkqRwfR126_IuBMjn1wow8XmLQ8osQpSKIzgqolsZZxRvmU1LvK_b0N-vS')
        );

        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $apiContext);


        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);

        // $transaction = new Transaction();
        // $amount = new Amount();
        // $details = new Details();

        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(17.50);

        // $amount->setCurrency('USD');
        // $amount->setTotal(21);
        // $amount->setDetails($details);
        // $transaction->setAmount($amount);

        // $execution->addTransaction($transaction);
        try {
            $result = $payment->execute($execution, $apiContext);
            $user = User::find($request->userId);
            $products = $user->productsInCart;
            foreach($products as $product) {
                $user->productsInCart()->updateExistingPivot($product->id, ['is_paid' => TRUE]);
                $product->save();
            }
        } catch (\Exception $ex) {
            echo $ex;
        }

        return $result;
    }
}
