<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Http;

use Exception;

/**
 * HTTP exceptions
 *
 * @package  Cradle
 * @category Http
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class HttpException extends Exception
{
  /**
   * @const string ERROR_NOT_FOUND 404 Error template
   */
  const ERROR_NOT_FOUND = '404 Not Found';

  /**
   * Create a new exception for 404
   *
   * @return HttpException
   */
  public static function forResponseNotFound(): HttpException
  {
    return new static(static::ERROR_NOT_FOUND, 404);
  }
}
