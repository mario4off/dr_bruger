<?php
class User
{
    protected $user_id;
    protected $name;
    protected $last_name;
    protected $address;
    protected $city;
    protected $cp;
    protected $mail;
    protected $phone;
    protected $role;
    protected $pass;

    public function __construct()
    {

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


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function getLast_name()
    {
        return $this->last_name;
    }


    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }


    public function getAddress()
    {
        return $this->address;
    }


    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }


    public function getCity()
    {
        return $this->city;
    }


    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }


    public function getCp()
    {
        return $this->cp;
    }


    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }


    public function getPhone()
    {
        return $this->phone;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }


    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    public function getPass()
    {
        return $this->pass;
    }


    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}