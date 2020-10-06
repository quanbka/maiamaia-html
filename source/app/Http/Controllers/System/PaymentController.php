<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/19/2018
 * Time: 10:59 AM
 */

namespace App\Http\Controllers\System;


class PaymentController
{
    public function history() {
        return view('system.payment.history.index');
    }

    public function checkout() {
        return view('system.payment.checkout.index');
    }
}