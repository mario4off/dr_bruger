<?php

class OrderDetails
{
    private $lined_id;
    private $line_price;
    private $quantity;
    private $order_id;
    private $product_id;
    private $promotion_id;

    public function __construct()
    {

    }

    /**
     * Get the value of lined_id
     */
    public function getLined_id()
    {
        return $this->lined_id;
    }

    /**
     * Set the value of lined_id
     *
     * @return  self
     */
    public function setLined_id($lined_id)
    {
        $this->lined_id = $lined_id;

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
     * Get the value of product_id
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

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
}