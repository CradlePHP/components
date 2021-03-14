<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Data;

/**
 * Allows $data to be iterable using generators
 *
 * @package  Cradle
 * @category Data
 * @standard PSR-2
 */
trait GeneratorTrait
{
  /**
   * Loop generator
   */
  public function generator()
  {
    foreach ($this->data as $key => $value) {
      yield $key => $value;
    }
  }
}
