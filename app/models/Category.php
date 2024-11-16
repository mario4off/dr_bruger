<?php
class Category
{
    private $category_id;
    private $category_name;

    public function __construct()
    {

    }


    public function getCategory_name()
    {
        return $this->category_name;
    }


    public function setCategory_name($category_name)
    {
        $this->category_name = $category_name;

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