<?php 

namespace Cradle\OAuth;

use PHPUnit\Framework\TestCase;


class AbstractClassTest extends TestCase {

    protected function setUp()
    {
        $this->object = new AbstractSqlStub;
    }


    public function testAddHeaders() {
        $instance = $this->object->_addHeader('Authorization:', 'value');
        $this->assertInstanceOf(AbstractOAuth1::class, $instance);
    }

    public function testBuildQuery() {
        $params = [
            'token' => 'token',
            'params' => []
        ];
        $actual = $this->object->_buildQuery($params);

        $this->assertEquals('params=&token=token', $actual);
    }

    public function testEncode() {
        $string = 'http://foobar.com';
        $actual = $this->object->_encode($string);

        $this->assertEquals('http%3A%2F%2Ffoobar.com', $actual);
    }

    public function testDecode() {
        $string = 'http%3A%2F%2Ffoobar.com';
        $actual = $this->object->_decode($string);

        $this->assertEquals('http://foobar.com', $actual);
    }

    public function testGetAuthorization() {
        $signature = '123456';
        $actual = $this->object->_getAuthorization($signature, false);

        $expected = [
            'oauth_consumer_key' => 'foobar_consumer_key',
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_signature' => $signature,
            'oauth_timestamp' => '',
            'oauth_nonce' => '',
            'oauth_version' => '1.0'
        ];

        $this->assertArraySubset($expected, $actual);
    }

    public function testGetDomDocumentResponse() {
        $query = ['test' => 'test'];
        $actual = $this->object->getGetDomDocumentResponse($query);
        $this->assertInstanceOf('DOMDocument', $actual);
    } 

    public function testGetHmacPlainTextSignature() {
        $actual = $this->object->_getHmacPlainTextSignature();
        $this->assertEquals('foobar_consumer_secret', $actual);
    }

    public function testGetHmacSha1Signature() {
        $actual = $this->object->_getHmacSha1Signature([]);
        $this->assertEquals('OtOfx+wAOPn0OJmXAt2THQ6CcG0=', $actual);
    }

    public function testGetJsonResponse() {
        $actual = $this->object->_getJsonResponse([]);
        $this->assertArrayHasKey(CURLOPT_URL, $actual);
    }

    public function testGetMeta() {
        $token = 'foobar_token';
        $actual = $this->object->_getMeta();

        $this->assertArrayHasKey('query', $actual);
        $this->assertArrayHasKey('headers', $actual);
        $this->assertArrayHasKey('authorization', $actual);
    }

    public function testGetQueryResponse() {
        $token = 'foobar_token';
        $actual = $this->object->_getQueryResponse([]);

        $this->assertArrayHasKey('oauth_signature', $actual);
        $this->assertArrayHasKey('oauth_signature_method', $actual);
        $this->assertArrayHasKey('oauth_nonce', $actual);
    }

    public function testGetResponse() {
        $token = 'foobar_token';
        $actual = $this->object->_getResponse([]);

        $this->assertJson($actual);
    }

    public function testGetSignature() {
        $actual = $this->object->_getSignature([]);
        $this->assertEquals('OtOfx+wAOPn0OJmXAt2THQ6CcG0=', $actual);
    }
     
    public function testGetSimpleXmlResponse() {
        $actual = $this->object->_getSimpleXmlResponse([]);
        $this->assertInstanceOf('SimpleXMLElement', $actual);
    } 

    public function testGetJsonEncodeQuery() {
        $actual = $this->object->_getJsonEncodeQuery([]);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetCallback() {
        $url = 'http://foobar.com';
        $actual = $this->object->_setCallback($url);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetHeaders() {
        $headers[] = 'Authorization: Basic';
        $actual = $this->object->_setHeaders($headers);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetUrl() {
        $url = 'http://foobar.com';
        $actual = $this->object->_setUrl($url);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetMethodToGet() {
        $actual = $this->object->_setMethodToGet();
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetMethodToPost() {
        $actual = $this->object->_setMethodToPost();
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetRealm() {
        $realm = 'api';
        $actual = $this->object->_setRealm($realm);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetSignatureToHmacSha1() {
        $actual = $this->object->_setSignatureToHmacSha1();
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetSignatureToRsaSha1() {
        $actual = $this->object->_setSignatureToRsaSha1();
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetSignatureToPlainText() {
        $actual = $this->object->_setSignatureToPlainText();
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testSetToken() {
        $token = 'foobar_token';
        $secret = 'foobar_secret';
        $actual = $this->object->_setToken($token, $secret);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

     public function testSetVerifier() {
        $verifier = 'foobar_verifier';
        $actual = $this->object->_setVerifier($verifier);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }

    public function testUseAuthorization() {
        $actual = $this->object->_useAuthorization(true);
        $this->assertInstanceOf(AbstractOAuth1::class, $actual);
    }
}

if(!class_exists('Cradle\Storm\AbstractSqlStub')) {
    class AbstractSqlStub extends AbstractOAuth1 implements OAuth1Interface
    {

        public function __construct() {
            $this->consumerKey = 'foobar_consumer_key';
            $this->consumerSecret = 'foobar_consumer_secret';
            $this->urlRedirect = 'http://foobar.com/url_redirect';
            $this->urlRequest = 'http://foobar.com/url_request';
            $this->urlAuthorize = 'http://foobar.com/url_authorize';
            $this->urlAccess = 'http://foobar.com/url_access';

            $this->map = function($options) {
                $options['response'] = json_encode($options);
                return $options;
            };
        }

        public function _addHeader($key) {
            return $this->addHeader($key);
        }

        public function _buildQuery(
            array $params,
            string $separator = '&',
            bool $noQuotes = true,
            bool $subList = false
        ): string {
            return $this->buildQuery($params, $separator, $noQuotes, $subList);
        }

        public function _encode($string) {
            return $this->encode($string);
        }

        public function _decode($string) {
            return $this->decode($string);
        }

        public function _getAuthorization($signature, $string) {
            return $this->getAuthorization($signature, $string);
        }
        
        public function getGetDomDocumentResponse($query) {
            $this->setUrl('http://foobar.com');
            $this->map = function($options) {
                $options['response'] = '<root></root>';
                return $options;
            };
            return $this->getDomDocumentResponse($query);
        }

        public function _getHmacPlainTextSignature() {
            return $this->getHmacPlainTextSignature();
        }

        public function _getHmacSha1Signature($query) {
            return $this->getHmacSha1Signature($query);
        }

        public function _getJsonResponse($query) {
            return $this->getJsonResponse($query);
        }

        public function _getMeta() {
            $this->getJsonResponse([]);

            return $this->getMeta();
        }
        
        public function _getQueryResponse($query) {
            return $this->getQueryResponse($query);
        }
        
        public function _getResponse($query) {
            $this->jsonEncodeQuery();
            $this->setMethodToPost();
            return $this->getResponse($query);
        }

        public function _getSignature($query) {
            $this->setSignatureToHmacSha1();
            return $this->getSignature($query);
        }

        public function _getSimpleXmlResponse($query) {
            $this->getJsonResponse([]);
            $this->map = function($options) {
                $options['response'] = '<root></root>';
                return $options;
            };
            return $this->getSimpleXmlResponse($query);
        }   

        public function _getJsonEncodeQuery() {
            return $this->jsonEncodeQuery();
        }

        public function _setCallback($url) {
            return $this->setCallback($url);
        }

        public function _setHeaders($headers) {
            return $this->setHeaders($headers);
        }

        public function _setUrl($url) {
            return $this->setUrl($url);
        }

        public function _setMethodToGet() {
            return $this->setMethodToGet();
        }

        public function _setMethodToPost() {
            return $this->setMethodToPost();
        }

        public function _setRealm($realm) {
            return $this->setRealm($realm);
        }

        public function _setSignatureToHmacSha1() {
            return $this->setSignatureToHmacSha1();
        }

        public function _setSignatureToRsaSha1() {
            return $this->setSignatureToRsaSha1();
        }

        public function _setSignatureToPlainText() {
            return $this->setSignatureToPlainText();
        }

        public function _setToken($token, $secret) {
            return $this->setToken($token, $secret);
        }

        public function _setVerifier($verifier) {
            return $this->setVerifier($verifier);
        }

        public function _useAuthorization($bool) {
            return $this->useAuthorization($bool);
        }

        public function getAccessTokens(
            string $responseToken,
            string $requestSecret,
            string $verifier
        ): array {
           
        }

        public function getLoginUrl(
            string $requestToken,
            bool $force = false
        ): string {}

        public function getRequestTokens(): array {}
    }
}