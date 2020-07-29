<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\IO;

use Cradle\Data\Registry;

/**
 * IO Request Object
 *
 * @vendor   Cradle
 * @package  IO
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
abstract class AbstractIO extends Registry
{
  /**
   * @var metaData private data not registered
   */
  protected $metaData = [];

  /**
   * Loads default data given by PHP
   *
   * @return Request
   */
  abstract public function load(): IOInterface;

  /**
   * Sets/Get private data not registered
   *
   * @return mixed
   */
  public function meta($key, $value = null)
  {
    if (!is_null($value)) {
      $this->metaData[$key] = $value;
      return $this;
    }

    if (isset($this->metaData[$key])) {
      return $this->metaData[$key];
    }

    return null;
  }
}
