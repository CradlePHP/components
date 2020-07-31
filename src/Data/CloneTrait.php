<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Data;

/**
 * Allows class to bbe cloneable
 *
 * @package  Cradle
 * @category Data
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
trait CloneTrait
{
  /**
   * In instance method for cloning
   *
   * @param bool $flushData
   */
  public function clone(bool $purge = false)
  {
    $clone = clone $this;
    if ($purge) {
      $clone->purge();
    }

    return $clone;
  }
}
