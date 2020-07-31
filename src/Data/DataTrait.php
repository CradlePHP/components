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
 * The DataTrait combines all the data features
 * in the Data package. Just a shortcut for having
 * all the features in one go.
 *
 * @package  Cradle
 * @category Data
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
trait DataTrait
{
  use ArrayAccessTrait,
    IteratorTrait,
    CountableTrait,
    DotTrait,
    MagicTrait,
    GeneratorTrait,
    CloneTrait;

  /**
   * @var array $ata registered data
   */
  protected $data = [];

  /**
   * Attempts to copy from one key/value to key
   *
   * @param *string $source
   * @param *string $destination
   *
   * @return DataTrait
   */
  public function copy(string $source, string $destination)
  {
    //if there is a source key in the data
    if (isset($this->data[$source])) {
      //send it over to the destiination
      $this->data[$destination] = $this->data[$source];
    //if the destination exists
    } else if (isset($this->data[$destination])) {
      //the source doesnt exist, so set it to null
      $this->data[$destination] = null;
    }

    //if the source and destination does not exist, do nothing
    return $this;
  }

  /**
   * Truncates data
   *
   * @return DataTrait
   */
  public function purge()
  {
    $this->data = [];
    return $this;
  }
}
