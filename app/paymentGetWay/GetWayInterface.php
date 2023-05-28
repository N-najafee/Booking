<?php

namespace App\paymentGetWay;

interface GetWayInterface
{
    public function send($totalAmount, $description, $user);
    public function verify($authority, $totalAmount);


}
