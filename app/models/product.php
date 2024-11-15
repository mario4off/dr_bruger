<?php

class Product
{
    protected $product_id;
    protected $product_name;
    protected $base_price;
    protected $main_photo;

    protected $promotion_id;
    protected $category_id;
    protected $product_description;

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
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of product_description
     */
    public function getProduct_description()
    {
        return $this->product_description;
    }

    /**
     * Set the value of product_description
     *
     * @return  self
     */
    public function setProduct_description($product_description)
    {
        $this->product_description = $product_description;

        return $this;
    }
}