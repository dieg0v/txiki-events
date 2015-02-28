<?php

namespace Txiki\Events;

use Txiki\Events\EventException;
use Txiki\Callback\CallableObject;
use Txiki\Callback\Call;

/**
 * Simple class for manage events
 */
class Event
{
    /**
     * Store all events and callbacks
     *
     * @var array
     */
    protected $events = [];

    /**
     * Register event
     *
     * @param string $eventName event name
     * @param \Clousure  callback function
     *
     * @return boolean
     */
    public function on($eventName = false, $callback = false)
    {
        if (!$eventName) {
            throw new EventException("Event name is necesary");
        }

        if (!is_callable($callback)) {
            throw new EventException("Invalid event callback");
        }

        $eventName = strtolower($eventName);

        if (array_key_exists($eventName, $this->events)) {
            throw new EventException("Duplicate event name");
        }

        $this->events[$eventName] = $callback;

        return true;
    }

    /**
     * Remove event
     *
     * @param  string $eventName event name
     *
     * @return boolean           true/false if removed
     */
    public function off($eventName = '')
    {
        $eventName = strtolower($eventName);

        if (array_key_exists($eventName, $this->events)) {
            unset($this->events[$eventName]);
            return true;
        }

        return false;
    }

    /**
     * Trigger on event
     *
     * @param  string $eventName event name
     * @param  array  $params    params to callback function
     *
     * @return mixed
     */
    public function trigger($eventName = '', $params = array())
    {
        $eventName = strtolower($eventName);

        if (!array_key_exists($eventName, $this->events)) {
            throw new EventException("No event register");
        }

        $callback = $this->events[$eventName];

        return Call::dispatch(
            new CallableObject($callback, $params)
        );
    }

    /**
     * Return all events
     *
     * @return array events array
     */
    public function table()
    {
        return $this->events;
    }
}
