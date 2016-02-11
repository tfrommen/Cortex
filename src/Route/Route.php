<?php
/*
 * This file is part of the Cortex package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brain\Cortex\Route;

/**
 * @author  Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @package Cortex
 */
final class Route implements RouteInterface
{

    /**
     * @var array
     */
    private static $defaults = [
        'defaults'           => null,
        'host'               => null,
        'priority'           => null,
        'group'              => null,
        'merge_query_string' => null,
        'skip_vars'          => null,
        'paged'              => null,
        'method'             => null,
        'scheme'             => null,
        'before'             => null,
        'after'              => null,
        'template'           => null,
        'path'               => null,
        'handler'            => null
    ];

    /**
     * @var array
     */
    private $storage = [];

    /**
     * Route constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $id = is_string($data['id']) && $data['id'] ? $data['id'] : 'route_'.spl_object_hash($this);
        $storage = array_intersect_key($data, self::$defaults);
        $storage['id'] = $id;
        $this->storage = $storage;
    }

    /**
     * @inheritdoc
     */
    public function id()
    {
        return $this->storage['id'];
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return $this->storage;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->storage);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->storage[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->storage[$offset] = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->storage[$offset]);
        }
    }
}