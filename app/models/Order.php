<?php

class Order
{

    private $order_id;
    private $user_id;
    private $promotion_id;
    private $date_time;
    private $status;
    private $total_amount;
    private $card_number;

    private $payment_mehtod;

    public function __construct()
    {

    }



    public function getOrder_id()
    {
        return $this->order_id;
    }


    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }


    public function getUser_id()
    {
        return $this->user_id;
    }


    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }


    public function getPromotion_id()
    {
        return $this->promotion_id;
    }


    public function setPromotion_id($promotion_id)
    {
        $this->promotion_id = $promotion_id;

        return $this;
    }


    public function getDate_time()
    {
        return $this->date_time;
    }


    public function setDate_time($date_time)
    {
        $this->date_time = $date_time;

        return $this;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }


    public function getTotal_amount()
    {
        return $this->total_amount;
    }


    public function setTotal_amount($total_amount)
    {
        $this->total_amount = $total_amount;

        return $this;
    }


    public function getCard_number()
    {
        return $this->card_number;
    }


    public function setCard_number($card_number)
    {
        $this->card_number = $card_number;

        return $this;
    }


    public function getPayment_mehtod()
    {
        return $this->payment_mehtod;
    }


    public function setPayment_mehtod($payment_mehtod)
    {
        $this->payment_mehtod = $payment_mehtod;

        return $this;
    }
}