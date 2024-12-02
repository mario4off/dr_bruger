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
    private $payment_method;
    private $delivery_cost;
    private $iva;

    public function __construct()
    {

    }



    /**
     * Get the value of order_id
     */
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of promotion_id
     */
    public function getPromotion_id()
    {
        return $this->promotion_id;
    }

    /**
     * Set the value of promotion_id
     *
     * @return  self
     */
    public function setPromotion_id($promotion_id)
    {
        $this->promotion_id = $promotion_id;

        return $this;
    }

    /**
     * Get the value of date_time
     */
    public function getDate_time()
    {
        return $this->date_time;
    }

    /**
     * Set the value of date_time
     *
     * @return  self
     */
    public function setDate_time($date_time)
    {
        $this->date_time = $date_time;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of total_amount
     */
    public function getTotal_amount()
    {
        return $this->total_amount;
    }

    /**
     * Set the value of total_amount
     *
     * @return  self
     */
    public function setTotal_amount($total_amount)
    {
        $this->total_amount = $total_amount;

        return $this;
    }


    /**
     * Get the value of card_number
     */
    public function getCard_number()
    {
        return $this->card_number;
    }

    /**
     * Set the value of card_number
     *
     * @return  self
     */
    public function setCard_number($card_number)
    {
        $this->card_number = $card_number;

        return $this;
    }

    /**
     * Get the value of payment_method
     */
    public function getPayment_method()
    {
        return $this->payment_method;
    }

    /**
     * Set the value of payment_method
     *
     * @return  self
     */
    public function setPayment_method($payment_method)
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * Get the value of delivery_cost
     */
    public function getDelivery_cost()
    {
        return $this->delivery_cost;
    }

    /**
     * Set the value of delivery_cost
     *
     * @return  self
     */
    public function setDelivery_cost($delivery_cost)
    {
        $this->delivery_cost = $delivery_cost;

        return $this;
    }

    /**
     * Get the value of iva
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set the value of iva
     *
     * @return  self
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }
}