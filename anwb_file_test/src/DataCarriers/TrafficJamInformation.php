<?php
namespace App\DataCarriers;


class TrafficJamInformation
{
    private $from;
    private $to;
    private $fromLoc;
    private $toLoc;
    private $start;
    private $distance;
    private $delay;
    private $dateTime;
    private $road;

    /**
     * @return mixed
     */
    public function getRoad()
    {
        return $this->road;
    }

    /**
     * @param mixed $road
     */
    public function setRoad($road)
    {
        $this->road = $road;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getFromLoc()
    {
        return $this->fromLoc;
    }

    /**
     * @param mixed $fromLoc
     */
    public function setFromLoc($fromLoc)
    {
        $this->fromLoc = $fromLoc;
    }

    /**
     * @return mixed
     */
    public function getToLoc()
    {
        return $this->toLoc;
    }

    /**
     * @param mixed $toLoc
     */
    public function setToLoc($toLoc)
    {
        $this->toLoc = $toLoc;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param mixed $delay
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }
}