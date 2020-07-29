<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Async;

use Exception;

/**
 * Async exceptions
 *
 * @package  Cradle
 * @category Async
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class AsyncException extends Exception
{
  /**
   * @const string ERROR_INVALID_COROUTINE Error template
   */
  const ERROR_INVALID_COROUTINE = 'Argument 1 was expecting either a Generator or callable, %s used.';

  /**
   * Create a new exception for invalid task
   *
   * @return AsyncException
   */
  public static function forInvalidCoroutine($value): AsyncException
  {
    return new static(sprintf(static::ERROR_INVALID_COROUTINE, gettype($value)));
  }
}
