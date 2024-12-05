<?php

class Promotion
{
    private $promotion_id;
    private $code;
    private $start_date;
    private $end_date;

    private $discount_value;

    private $discount_type;
    private $object;

    public function __construct()
    {

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
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of start_date
     */
    public function getStart_date()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */
    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of end_date
     */
    public function getEnd_date()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */
    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of discount_value
     */
    public function getDiscount_value()
    {
        return $this->discount_value;
    }

    /**
     * Set the value of discount_value
     *
     * @return  self
     */
    public function setDiscount_value($discount_value)
    {
        $this->discount_value = $discount_value;

        return $this;
    }

    /**
     * Get the value of discount_type
     */
    public function getDiscount_type()
    {
        return $this->discount_type;
    }

    /**
     * Set the value of discount_type
     *
     * @return  self
     */
    public function setDiscount_type($discount_type)
    {
        $this->discount_type = $discount_type;

        return $this;
    }

    /**
     * Get the value of object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set the value of object
     *
     * @return  self
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }
}