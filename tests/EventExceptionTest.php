<?php

namespace Txiki\Events\Tests;

use Txiki\Events\Event;

/**
 * EventException test class
 */
class EventExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Event object
     *
     * @var Txiki\Events\Event
     */
    private $event;

    /**
     * SetUp function
     *
     * @return void
     */
    public function setUp()
    {
        $this->event = new Event();
    }

    /**
     * Asserts event name exception
     *
     * @return void
     */
    public function testEventNameException()
    {
        $this->setExpectedException('Txiki\Events\EventException', 'Event name is necesary', 0);

        $this->event->on();
    }

    /**
     * Asserts event callback exception
     *
     * @return void
     */
    public function testEventCallbackException()
    {
        $this->setExpectedException('Txiki\Events\EventException', 'Invalid event callback', 0);

        $this->event->on('event-name', false);
    }

    /**
     * Asserts duplicate event name exception
     *
     * @return void
     */
    public function testDuplicateEventNameException()
    {
        $this->setExpectedException('Txiki\Events\EventException', 'Duplicate event name', 0);

        $this->event->on('event-name', function () {return true;});
        $this->event->on('event-name', function () {return true;});
    }

    /**
     * Asserts no event register exception
     *
     * @return void
     */
    public function testNoEventRegisterException()
    {
        $this->setExpectedException('Txiki\Events\EventException', 'No event register', 0);

        $this->event->trigger('event-name');
    }
}
