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
 * OAuth 1 User Interface
 *
 * @vendor   Cradle
 * @package  OAuth
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
interface OAuth1Interface
{
  /**
   * Returns the access token
   *
   * @param *string $responseToken
   * @param *string $requestSecret from getRequestToken() usually
   * @param *string $verifier
   *
   * @return array
   */
  public function getAccessTokens(
    string $responseToken,
    string $requestSecret,
    string $verifier
  ): array;

  /**
   * Returns the URL used for login.
   *
   * @param *string $requestToken
   * @param bool  $force    force user re-login
   *
   * @return string
   */
  public function getLoginUrl(
    string $requestToken,
    bool $force = false
  ): string;

  /**
   * Return a request token
   *
   * @return array
   */
  public function getRequestTokens(): array;
}
