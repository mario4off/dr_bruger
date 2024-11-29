<?php
class CartItem
{
    private $product_id;
    private $base_price;
    private $quantity;
    private $main_photo;
    private $product_name;

    public function __construct()
    {

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
     * Get the value of base_price
     */
    public function getBase_price()
    {
        return $this->base_price;
    }

    /**
     * Set the value of base_price
     *
     * @return  self
     */
    public function setBase_price($base_price)
    {
        $this->base_price = $base_price;

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
     * Get the value of main_photo
     */
    public function getMain_photo()
    {
        return $this->main_photo;
    }

    /**
     * Set the value of main_photo
     *
     * @return  self
     */
    public function setMain_photo($main_photo)
    {
        $this->main_photo = $main_photo;

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
}