<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Terminal;

use Exception;

/**
 * Terminal exceptions
 *
 * @package  Cradle
 * @category Terminal
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class TerminalException extends Exception
{
  /**
   * @const string ERROR_ARGUMENT_COUNT
   */
  const ERROR_ARGUMENT_COUNT = 'Not enough arguments.';

  /**
   * @const string ERROR_NOT_FOUND 404 Error template
   */
  const ERROR_NOT_FOUND = '404 Not Found';

  /**
   * Create a new exception for 404
   *
   * @return TerminalException
   */
  public static function forArgumentCount(): TerminalException
  {
    return new static(static::ERROR_ARGUMENT_COUNT);
  }

  /**
   * Create a new exception for 404
   *
   * @return TerminalException
   */
  public static function forResponseNotFound(): TerminalException
  {
    return new static(static::ERROR_NOT_FOUND, 404);
  }
}