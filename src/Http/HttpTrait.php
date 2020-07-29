<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Http;

use Cradle\IO\IOTrait;

use Cradle\Http\Router\RouterTrait;

use Cradle\Http\Dispatcher\DispatcherTrait;

/**
 * You can optionally adopt these methods into an existing class
 *
 * @vendor   Cradle
 * @package  Http
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
trait HttpTrait
{
  use IOTrait,
    RouterTrait,
    DispatcherTrait
    {
      IOTrait::run as runIO;
  }

  /**
   * Main processor
   *
   * @param *Request  $request
   * @param *Response $response
   *
   * @return bool
   */
  public function main($request, $response): bool
  {
    return $this->getRouter()->process($request, $response);
  }

  /**
   * Process and output
   *
   * @param ?bool $emulate If you really want it to echo (for testing)
   *
   * @return bool
   */
  public function run(bool $emulate = false): bool
  {
    $response = $this->getResponse();

    if (!is_callable($this->processor)) {
      $this->processor = [$this, 'main'];
    }

    $continue = $this->prepare()
      && $response->getStatus() == 200
      && $this->process();

    if (!$continue) {
      return false;
    }

    //check for content
    //check for redirect
    if (!$response->hasContent()
      && !$response->hasJson()
      && !$this->hasRedirect()
    ) {
      $request = $this->getRequest();
      $response->setStatus(404, HttpHandler::STATUS_404);

      $error = HttpException::forNotFound();
      $continue = $this->getErrorProcessor()->process($request, $response, $error);
    }

    if ($continue) {
      $this->getDispatcher()->dispatch($response, $emulate);
    }

    //the connection is already closed
    //also remember there are no more sessions
    return $this->shutdown();
  }

  /**
   * Returns true if there is a Location header
   *
   * @return bool
   */
  protected function hasRedirect(): bool
  {
    $headers = $this->getResponse()->getHeaders();
    if (isset($headers['Location'])
      || isset($headers['location'])
    ) {
      return true;
    }

    //we need to also check the PHP headers
    foreach (headers_list() as $header) {
      //if there was a redirect set
      if (strpos(strtolower($header), 'location:') === 0) {
        return true;
      }
    }

    //no redirect was found
    return false;
  }
}
