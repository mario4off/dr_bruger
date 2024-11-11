<?php

class Product
{
    private $product_id;
    private $product_name;
    private $base_price;
    private $main_photo;

    private $promotion_id;
    private $category_id;

    public function __construct()
    {

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


    public function getProduct_name()
    {
        return $this->product_name;
    }


    public function setProduct_name($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }


    public function getBase_price()
    {
        return $this->base_price;
    }


    public function setBase_price($base_price)
    {
        $this->base_price = $base_price;

        return $this;
    }


    public function getMain_photo()
    {
        return $this->main_photo;
    }


    public function setMain_photo($main_photo)
    {
        $this->main_photo = $main_photo;

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


    public function getCategory_id()
    {
        return $this->category_id;
    }


    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }
}