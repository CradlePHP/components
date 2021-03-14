<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Data;

/**
 * Given that there's $data this will auto setup Countable interface
 *
 * @package  Cradle
 * @category Data
 * @standard PSR-2
 */
trait CountableTrait
{
  /**
   * Returns the data size
   * For Countable interface
   */
  public function count(): int
  {
    return count($this->data);
  }
}
