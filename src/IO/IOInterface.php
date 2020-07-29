<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\IO;

/**
 * IO Interface
 *
 * @vendor   Cradle
 * @package  IO
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
interface IOInterface
{
  /**
   * Loads default data given by PHP
   *
   * @return Request
   */
  public function load(): IOInterface;
}
