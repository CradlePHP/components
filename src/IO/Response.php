<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\IO;

use Cradle\Helper\InstanceTrait;
use Cradle\Helper\LoopTrait;
use Cradle\Helper\ConditionalTrait;

use Cradle\Profiler\InspectorTrait;
use Cradle\Profiler\LoggerTrait;

use Cradle\Resolver\StateTrait;

use Cradle\IO\Response\ResponseInterface;
use Cradle\IO\Response\ContentTrait;
use Cradle\IO\Response\HeaderTrait;
use Cradle\IO\Response\PageTrait;
use Cradle\IO\Response\RestTrait;
use Cradle\IO\Response\StatusTrait;

/**
 * IO Response Object
 *
 * @vendor   Cradle
 * @package  Server
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Response extends AbstractIO implements ResponseInterface, IOInterface
{
  use ContentTrait,
    HeaderTrait,
    PageTrait,
    RestTrait,
    StatusTrait;

  /**
   * Loads default data
   *
   * @return Response
   */
  public function load(): IOInterface
  {
    $this
      ->addHeader('Content-Type', 'text/html; charset=utf-8')
      ->setStatus(200, '200 OK');

    return $this;
  }
}
