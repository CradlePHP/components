<?php //-->
/**
 * This file is part of the Cradle PHP Project.
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
