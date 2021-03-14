<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

/**
 * Interface for Queue used to match standards
 *
 * @package  Cradle
 * @category Async
 * @standard PSR-2
 */
interface QueueInterface
{
  /**
   * Adds a task
   *
   * @param *Task|Generator|callable $coroutine
   *
   * @return string
   */
  public function add($coroutine): Coroutine;

  /**
   * Runs all the tasks in the queue, considering steps
   *
   * @return QueueInterface
   */
  public function run(): QueueInterface;
}
