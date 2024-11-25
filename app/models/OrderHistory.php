<?php

class OrderHistory
{

    private $order_id;
    private $user_id;
    private $promotion_id;
    private $date_time;
    private $status;
    private $total_amount;
    private $card_number;
    private $product_id;

    private $pedido_id;
    private $payment_method;
    private $quantity;
    private $product_name;
    private $line_price;


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


    public function getPayment_method()
    {
        return $this->payment_method;
    }


    public function setPayment_method($payment_method)
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of product_name
     */
    public function getProduct_name()
    {
        return $this->product_name;
    }

    /**
     * Set the value of product_name
     *
     * @return  self
     */
    public function setProduct_name($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * Get the value of line_price
     */
    public function getLine_price()
    {
        return $this->line_price;
    }

    /**
     * Set the value of line_price
     *
     * @return  self
     */
    public function setLine_price($line_price)
    {
        $this->line_price = $line_price;

        return $this;
    }


    public function getPedido_id()
    {
        return $this->pedido_id;
    }



    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;

        return $this;
    }


    public function getProduct_id()
    {
        return $this->product_id;
    }


    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }
}