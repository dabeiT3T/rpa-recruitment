<?php

namespace MyGreeter;

use Carbon\Carbon;

/**
 * Class Client
 * @package MyGreeter
 */
class Client
{
    /**
     * default timezone is shanghai
     */
    const CLIENT_DEFAULT_TIMEZONE = 'Asia/Shanghai';

    /**
     * @var string
     */
    protected $_timezone;

    /**
     * Client constructor.
     * @param string $timezone
     */
    public function __construct($timezone = '')
    {
        $this->setTimezone($timezone);
    }

    /**
     * Set the timezone.
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->_timezone = $timezone?: self::CLIENT_DEFAULT_TIMEZONE;
    }

    /**
     * Return greeting message as required:
     * "Good morning" if it is after 6am and just before 12pm
     * "Good afternoon" if it is after 12pm and just before 6pm
     * "Good evening" if it is after 6pm and just before 6am
     *
     * @return string
     */
    public function getGreeting()
    {
        /**
         * Carbon is inherited from DateTime.
         * Its default timezone is given by date_default_timezone_get,
         * but here we don't use the (php)system level api date_default_timezone_set.
         * Carbon::setTestNow() which we will use in the test unit to simulate the time
         * can modify the value returned by now().
         */
        $now = Carbon::now($this->_timezone);
        // $hour is in range [0, 23]
        $hour = $now->hour;

        if ($hour >= 18 || $hour < 6)
            return 'Good evening';

        if ($hour < 12)
            return 'Good morning';

        return 'Good afternoon';
    }
}
