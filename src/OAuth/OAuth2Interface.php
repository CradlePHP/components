<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\OAuth;

/**
 * OAuth 2 User Interface
 *
 * @vendor   Cradle
 * @package  OAuth
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
interface OAuth2Interface
{
  /**
   * Returns the access token given the code
   *
   * @param string* $code
   *
   * @return array
   */
  public function getAccessTokens(string $code): array;

  /**
   * Returns the generated login url
   *
   * @return string
   */
  public function getLoginUrl(): string;
}
