<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use Session;
use Auth;
use Mail;
use App\Model\GiftVoucher;
use App\Model\GiftCardPurchase;
use App\Model\UserGiftVoucher;

class PaymentController extends FrontController {

    public function giftPayment($id = null) {


        if ($id == null) {
            return redirect()->route('/');
        }
        $model = GiftCardPurchase::find($id);
        if (count($model) == 0) {
            return redirect()->route('/');
        }

        $pay_amount = $model->pay_amount;

        $paypal = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential($this->settings['paypal']['paypal_client_id'], $this->settings['paypal']['paypal_secret_id'])
        );


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Gift card purchase')
                ->setCurrency($this->settings['paypal']['paypal_currency'])
                ->setQuantity(1)
                ->setPrice($pay_amount);


        $itemList = new ItemList();
        $itemList->setItems(array($item1));


        $amount = new Amount();
        $amount->setCurrency($this->settings['paypal']['paypal_currency'])
                ->setTotal($pay_amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Gift card purchase')
                ->setInvoiceNumber(uniqid());


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Route('gift-payment-callback'))
                ->setCancelUrl(Route('/'));


        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($paypal);
        } catch (Exception $ex) {
            print_r($ex);
        }


        $approvalUrl = $payment->getApprovalLink();

        Session::put('transaction_id', $model->id);
        return redirect($approvalUrl);
    }

    public function giftPaymentCallback() {
        ini_set('max_execution_time', -1);
        $paypal = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential($this->settings['paypal']['paypal_client_id'], $this->settings['paypal']['paypal_secret_id'])
        );

        if (isset($_GET['paymentId']) && $_GET['paymentId'] != '') {

            $model = GiftCardPurchase::find(Session::get('transaction_id'));
            Session::forget('transaction_id');

            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $paypal);

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();


            $amount->setCurrency($this->settings['paypal']['paypal_currency']);
            $amount->setTotal($model->pay_amount);


            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);

            try {

                $result = $payment->execute($execution, $paypal);

                try {
                    $payment = Payment::get($paymentId, $paypal);
                } catch (Exception $ex) {
                    
                }
            } catch (Exception $ex) {
                
            }



            if ($payment->state == "approved") {
                $model->gateway_tran_id = $payment->getId();
                $model->site_tran_id = 'PAY-' . rand_string(6);
                $model->payment_datetime = date('Y-m-d H:i:s');
                $model->payment_status = '22';
                $model->save();

                $gift_cards = explode(',', $model->gift_card);
                $gift_card_path = [];
                foreach ($gift_cards as $row) {
                    $name = $model->recipient_name;
                    $usergift = new UserGiftVoucher;
                    $usergift->gift_voucher_id = $row;
                    $usergift->track_id = $model->id;
                    $usergift->email = $model->recipient_email;
                    $usergift->email_content = $model->message;
                    $usergift->gift_voucher_code = rand_string(12);
                    $usergift->using_type = '2';
                    $usergift->status = 1;
                    $usergift->created_at = date('Y-m-d H:i:s');
                    $usergift->save();

                    $file_name = $usergift->gift_voucher_code . '.pdf';
                    $file_path = public_path('uploads/gift_voucher/invoice_' . $file_name);
                    array_push($gift_card_path, $file_path);
                    $gift_voucher_html = view('gift_voucher', ['model' => $usergift, 'name' => $name])->render();
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($gift_voucher_html)->setPaper(array(0, 0, 540, 675))->setWarnings(false)->save($file_path);
                }

                $email_setting = $this->get_email_data('gift_voucher_purchase', array('NAME' => $model->recipient_name, 'EMAIL_CONTENT' => $model->message, 'FROM_USER' => $model->sender_name));


                $email = [
                    'to' => $model->recipient_email,
                    'subject' => $email_setting['subject'],
                    'gift_card_path' => $gift_card_path,
                    'support_name' => get_settings('Support', 'support_name'),
                    'support_email' => get_settings('Support', 'support_email'),
                ];
                Mail::send('mail', ['content' => $email_setting['body']], function($message)use ($email) {
                    $message->to($email['to'], '');
                    $message->subject($email['subject']);
                    $message->from($email['support_email'], $email['support_name']);
                    foreach ($email['gift_card_path'] as $path) {
                        $message->attach($path);
                    }
                });
                
                $email_setting = $this->get_email_data('gift_voucher_purchase_seneder', array('NAME' => $model->sender_name));
                $email = [
                    'to' => $model->sender_email,
                    'subject' => $email_setting['subject'],
                    'support_name' => get_settings('Support', 'support_name'),
                    'support_email' => get_settings('Support', 'support_email'),
                ];
                Mail::send('mail', ['content' => $email_setting['body']], function($message)use ($email) {
                    $message->to($email['to'], '');
                    $message->subject($email['subject']);
                    $message->from($email['support_email'], $email['support_name']);
                });

                Session::flash('success_msg', 'Payment has been successfull.');
            } else {
                $model->gateway_tran_id = $payment->getId();
                $model->payment_status = '23';
                $model->save();
                Session::flash('error_msg', 'Paymant is not successfull.');
            }
        } else {
            
        }

        return redirect()->route('gift-card');
    }

    public function giftPaymentCancel() {
        $model = GiftCardPurchase::find(Session::get('transaction_id'));
        Session::forget('transaction_id');

        return redirect()->route('gift-card')->with('error_msg', 'Payment cancelled');
    }

}
