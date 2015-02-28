<?php

namespace Txiki\Events\Tests;

use Txiki\Events\Event;

/**
 * Event test class
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Event object
     *
     * @var [Txiki\Events\Event
     */
    private $event;

    /**
     * Event name
     *
     * @var string
     */
    private $eventName = 'event-name';

    /**
     * SetUp function
     *
     * @return void
     */
    public function setUp()
    {
        $this->event = new Event();

        $this->event->on($this->eventName, function () { return 'ok';});
    }

    /**
     * Asserts on event function
     *
     * @return void
     */
    public function testOnEvent()
    {
        $this->assertEquals(count($this->event->table()), 1);

        $this->assertEquals(array_key_exists($this->eventName, $this->event->table()), true);
    }

    /**
     * Asserts off event function
     *
     * @return void
     */
    public function testOffEvent()
    {
        $result = $this->event->off($this->eventName);

        $this->assertEquals(true, $result);

        $this->assertEquals(count($this->event->table()), 0);

        $this->assertEquals(array_key_exists($this->eventName, $this->event->table()), false);

        $result = $this->event->off('no-exists-event-name');

        $this->assertEquals(false, $result);
    }

    /**
     * Asserts trigger event function
     *
     * @return void
     */
    public function testTriggerEvent()
    {
        $result = $this->event->trigger($this->eventName);

        $this->assertEquals($result, 'ok');

        $this->event->on('foo-bar', function ($foo, $bar) { return $foo.' '.$bar;});

        $result = $this->event->trigger('foo-bar', ['foo', 'bar']);

        $this->assertEquals($result, 'foo bar');

        $this->event->on('DummyEvent1', 'Txiki\Events\Tests\DummyClass::method1');

        $result = $this->event->trigger('DummyEvent1', ['foo', 'bar']);

        $this->assertEquals($result, 'Hello world foo bar');

        $this->event->on('DummyEvent2', 'Txiki\Events\Tests\DummyClass::method2');

        $result = $this->event->trigger('DummyEvent2', ['foo', 'bar']);

        $this->assertEquals($result, 'Hello world foo bar');
    }
}
