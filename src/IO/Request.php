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

use Cradle\IO\Request\RequestInterface;
use Cradle\IO\Request\CliTrait;
use Cradle\IO\Request\ContentTrait;
use Cradle\IO\Request\CookieTrait;
use Cradle\IO\Request\FileTrait;
use Cradle\IO\Request\GetTrait;
use Cradle\IO\Request\RouteTrait;
use Cradle\IO\Request\PostTrait;
use Cradle\IO\Request\ServerTrait;
use Cradle\IO\Request\SessionTrait;
use Cradle\IO\Request\StageTrait;

/**
 * IO Request Object
 *
 * @vendor   Cradle
 * @package  IO
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Request extends AbstractIO implements RequestInterface, IOInterface
{
  use CliTrait,
    ContentTrait,
    CookieTrait,
    FileTrait,
    GetTrait,
    PostTrait,
    RouteTrait,
    ServerTrait,
    SessionTrait,
    StageTrait;

  /**
   * Loads default data given by PHP
   *
   * @return IOInterface
   */
  public function load(): IOInterface
  {
    global $argv;

    $this
      ->setArgs($argv)
      ->setContent(file_get_contents('php://input'));

    if (isset($_COOKIE)) {
      $this->setCookies($_COOKIE);
    }

    // @codeCoverageIgnoreStart
    if (isset($_SESSION)) {
      $this->setSession($_SESSION);
    }
    // @codeCoverageIgnoreEnd

    if (isset($_GET)) {
      $this->setGet($_GET)->setStage($_GET);
    }

    if (isset($_POST)) {
      $this->setPost($_POST)->setStage($_POST);
    }

    if (isset($_FILES)) {
      $this->setFiles($_FILES);
    }

    if (isset($_SERVER)) {
      $this->setServer($_SERVER);
    }

    return $this;
  }
}
