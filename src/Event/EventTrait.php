<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Event;

use Closure;
use Cradle\Async\AsyncTrait;
use Cradle\Helper\BinderTrait;

/**
 *
 * @package  Cradle
 * @category Event
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
trait EventTrait
{
  use AsyncTrait;

  /**
   * @var Resolver|null $globalEventEmitter The resolver instance
   */
  protected static $globalEventEmitter = null;

  /**
   * @var EventEmitter|null $eventEmitter
   */
  private $eventEmitter = null;

  /**
   * Asyncronous trigger
   *
   * @param *string $event The event to trigger
   * @param mixed   ...$args The arguments to pass to the emitter
   *
   * @return EventTrait
   */
  public function async(string $event, ...$args)
  {
    //get the event emitter
    $emitter = $this->getEventEmitter();

    //set up the async callback
    $callback = function () use ($emitter, &$event, &$args) {
      yield $emitter->emit($event, ...$args);
    };

    //add the callback in the async handler
    $this->getAsyncHandler()->add($callback);

    return $this;
  }

  /**
   * Returns an EventEmitter object
   * if none was set, it will auto create one
   *
   * @return EventEmitter
   */
  public function getEventEmitter(): EventInterface
  {
    if (is_null(self::$globalEventEmitter)) {
      //no need for a resolver because
      //there is a way to set this
      self::$globalEventEmitter = new EventEmitter();
    }

    if (is_null($this->eventEmitter)) {
      $this->eventEmitter = self::$globalEventEmitter;
    }

    return $this->eventEmitter;
  }

  /**
   * Attaches an instance to be notified
   * when an event has been triggered
   *
   * @param *string|array   $event   the name of the event
   * @param *callable     $callback  the event emitter
   * @param int       $priority  if true will be prepended in order
   *
   * @return EventTrait
   */
  public function on($event, callable $callback, int $priority = 0)
  {
    $dispatcher = $this->getEventEmitter();

    //if it's a closure, they meant to bind the callback
    if ($callback instanceof Closure) {
      //so there's no scope
      $callback = $this->bindCallback($callback);
    }

    $dispatcher->on($event, $callback, $priority);

    return $this;
  }

  /**
   * Allow for a custom dispatcher to be used
   *
   * @param *EventInterface $emitter
   * @param bool      $static
   *
   * @return EventTrait
   */
  public function setEventEmitter(EventInterface $emitter, bool $static = false)
  {
    if ($static) {
      self::$globalEventEmitter = $emitter;
    }

    $this->eventEmitter = $emitter;

    return $this;
  }

  /**
   * Notify all observers of that a specific
   * event has happened
   *
   * @param *string $event The event to trigger
   * @param mixed   ...$args The arguments to pass to the emitter
   *
   * @return EventTrait
   */
  public function emit(string $event, ...$args)
  {
    $this->getEventEmitter()->emit($event, ...$args);
    return $this;
  }
}
