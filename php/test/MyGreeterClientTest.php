<?php

use Carbon\Carbon;
use MyGreeter\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class MyGreeterClientTest
 */
class MyGreeterClientTest extends TestCase
{

    /**
     * @var Client
     */
    protected $greeter;

    public function setUp()
    {
        $this->greeter = new Client();
    }

    /**
     * If instance is created.
     */
    public function testInstance()
    {
        $this->assertEquals(
            'MyGreeter\Client',
            get_class($this->greeter)
        );
    }

    /**
     * At least get something...
     */
    public function testGetGreeting()
    {
        $this->assertTrue(
            strlen($this->greeter->getGreeting()) > 0
        );
    }

    /**
     * If greeting message is as expected.
     *
     * @dataProvider additionProvider
     * @param string $dateString
     * @param string $expected
     */
    public function testGreetingMessage($dateString, $expected)
    {
        // Carbon::now() will get the fake time if this function is called before.
        /** Don't forget to restore!!! */
        Carbon::setTestNow(Carbon::parse($dateString));

        $this->assertEquals(
            $expected,
            $this->greeter->getGreeting()
        );

        // restore
        Carbon::setTestNow(null);
    }

    /**
     * Test cases
     *
     * @return string[][]
     */
    public function additionProvider()
    {
        return [
            ['2021-07-21 06:00:00', 'Good morning'],
            ['2021-07-21 12:00:00', 'Good afternoon'],
            ['2021-07-21 18:00:00', 'Good evening'],
            ['2021-07-21 00:00:00', 'Good evening'],
            ['2021-07-21 05:59:59', 'Good evening'],
            ['2021-07-21 11:59:59', 'Good morning'],
            ['2021-07-21 17:59:59', 'Good afternoon'],
            ['2021-07-21 23:59:59', 'Good evening'],
            ['2021-07-21 06:00:01', 'Good morning'],
            ['2021-07-21 12:00:01', 'Good afternoon'],
            ['2021-07-21 18:00:01', 'Good evening'],
            ['2021-07-21 00:00:01', 'Good evening'],
        ];
    }

    /**
     * Question 2
     * As a production code, the timezone could be anywhere.
     * Here we may add some test cases so that using different timezone
     * can also work.
     * Use while to test some random time in the specific period like morning.
     */
}
