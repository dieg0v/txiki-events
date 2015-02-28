<?php

namespace Txiki\Events\Tests;

/**
 * DummyClass
 */
class DummyClass
{
    /**
     * DummyClass method1
     *
     * @param  mixed $id
     * @param  mixed $name
     *
     * @return string
     */
    public function method1($id, $name)
    {
        return 'Hello world ' .$id . ' '. $name;
    }

    /**
     * DummyClass static method2
     *
     * @param  mixed $id
     * @param  mixed $name
     *
     * @return string
     */
    public static function method2($id, $name)
    {
        return 'Hello world ' .$id . ' '. $name;
    }
}
