<?php

class Log
{
    private $log_id;
    private $action;
    private $user_id;
    private $altered_table;

    private $object_id;
    private $date_time;

    public function __construct()
    {

    }


    /**
     * Get the value of log_id
     */
    public function getLog_id()
    {
        return $this->log_id;
    }

    /**
     * Set the value of log_id
     *
     * @return  self
     */
    public function setLog_id($log_id)
    {
        $this->log_id = $log_id;

        return $this;
    }

    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */
    public function setAction($action)
    {
        $this->action = $action;

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
     * Get the value of object_id
     */
    public function getObject_id()
    {
        return $this->object_id;
    }

    /**
     * Set the value of object_id
     *
     * @return  self
     */
    public function setObject_id($object_id)
    {
        $this->object_id = $object_id;

        return $this;
    }

    /**
     * Get the value of altered_table
     */
    public function getAltered_table()
    {
        return $this->altered_table;
    }

    /**
     * Set the value of altered_table
     *
     * @return  self
     */
    public function setAltered_table($altered_table)
    {
        $this->altered_table = $altered_table;

        return $this;
    }
}