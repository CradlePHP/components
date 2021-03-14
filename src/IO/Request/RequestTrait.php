<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\IO\Request;

use Cradle\IO\Request;

/**
 * Designed for the IOHandler we are parting this out
 * to lessen the confusion
 *
 * @package  Cradle
 * @category IO
 * @standard PSR-2
 */
trait RequestTrait
{
  /**
   * @var Request|null $request Request object to use
   */
  protected $request = null;

  /**
   * Returns a request object
   *
   * @return RequestInterface
   */
  public function getRequest(): RequestInterface
  {
    if (is_null($this->request)) {
      if (method_exists($this, 'resolve')) {
        $this->setRequest($this->resolve(Request::class)->load());
      } else {
        $request = new Request();
        $this->setRequest($request->load());
      }
    }

    return $this->request;
  }

  /**
   * Sets the request object to use
   *
   * @param RequestInterface $request
   *
   * @return RequestTrait
   */
  public function setRequest(RequestInterface $request)
  {
    $this->request = $request;

    return $this;
  }
}
