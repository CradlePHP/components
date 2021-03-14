<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\IO\Response;

/**
 * Designed for the Response Object; Adds methods to process status codes
 *
 * @vendor   Cradle
 * @package  Server
 * @standard PSR-2
 */
trait StatusTrait
{
  /**
   * Returns the status code
   *
   * @return int|null
   */
  public function getStatus()
  {
    return $this->get('code');
  }

  /**
   * Sets a status code
   *
   * @param *int  $code   Status code
   * @param *string $status The string literal code for header
   *
   * @return StatusTrait
   */
  public function setStatus(int $code, string $status)
  {
    return $this
      ->set('code', $code)
      ->setHeader('Status', $status);
  }
}
