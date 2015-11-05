<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Paypal;

use Eden\Curl\Index as Curl;

/**
 * Base Class
 *
 * @vendor   Eden
 * @package  Paypal
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @author   Airon Paul Dumael <airon.dumael@gmail.com>
 * @standard PSR-2
 */
class Base extends \Eden\Core\Base
{
    /**
     * @const string VERSION PayPal version
     */
    const VERSION = '84.0';

    /**
     * @const string TEST_URL
     */
    const TEST_URL = 'https://api-3t.sandbox.paypal.com/nvp';

    /**
     * @const string LIVE_URL
     */
    const LIVE_URL = 'https://api-3t.paypal.com/nvp';

    /**
     * @const string SANDBOX_URL
     */
    const SANDBOX_URL = 'https://test.authorize.net/gateway/transact.dll';

    /**
     * @var array $meta Request/response meta data
     */
    protected $meta = array();

    /**
     * @var string|null $url API url call
     */
    protected $url = null;

    /**
     * @var string|null $user user id
     */
    protected $user = null;

    /**
     * @var string|null $password user password
     */
    protected $password = null;

    /**
     * @var string|null $signature PayPal REST signature
     */
    protected $signature = null;
    protected $certificate = null;

    /**
     * Save required fields, determine the root url to use
     *
     * @param string* $user        User ID
     * @param string* $password    User password
     * @param string* $signature   PayPal REST signature
     * @param string* $certificate Location of the certificate file
     * @param bool    $live        Flag ofor whether to use the live URL or not
     *
     * @return void
     */
    public function __construct(
        $user,
        $password,
        $signature,
        $certificate,
        $live = false
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->signature = $signature;
        $this->certificate = $certificate;

        $this->url = self::TEST_URL;
        $this->baseUrl = self::TEST_URL;
        if ($live) {
            $this->url = self::LIVE_URL;
            $this->baseUrl = self::LIVE_URL;
        }
    }

    /**
     * Populates after a request has been sent
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Helper function for replacing n and x of fields
     * @param  string*  $string
     * @param  bool     $n
     * @param  bool     $x
     *
     * @return string
     */
    public function nxReplace($string, $n = false, $x = false)
    {
        // Argument test
        Argument::i()
            // Argument 1 must be string
            ->test(1, 'string')
            // Argument 2 must be int
            ->test(2, 'int')
            // Argument 3 must be int
            ->test(3, 'int');

        if ($n !== false) {
            $string = str_replace('n', $n, $string);
        }

        if ($x !== false) {
            $string = str_replace('x', $x, $string);
        }

        return $string;
    }

    /**
     * Get Access Key
     *
     * @param array* $array
     *
     * @return array
     */
    protected function accessKey(array $array)
    {
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = $this->accessKey($val);
            }

            if ($val == false || $val == null || empty($val) || !$val) {
                unset($array[$key]);
            }

        }

        return $array;
    }

    /**
     * Request a method
     *
     * @param string* $method
     * @param array   $query
     * @param bool    $post
     *
     * @return string
     */
    protected function request($method, array $query = array(), $post = true)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');

        //Our request parameters
        $default = array(
            'USER' => $this->user,
            'PWD' => $this->password,
            'SIGNATURE' => $this->signature,
            'VERSION' => self::VERSION,
            'METHOD' => $method);

        //generate URL-encoded query string to build our NVP string
        $query = http_build_query($query + $default);

        $curl = Curl::i()
            ->setUrl($this->baseUrl)
            ->setVerbose(true)
            // ->setCaInfo($this->certificate)
            ->setPost(true)
            ->setPostFields($query);

        $response = $curl->getQueryResponse();

        $this->meta['url']      = $this->baseUrl;
        $this->meta['query']    = $query;
        $this->meta['curl']     = $curl->getMeta();
        $this->meta['response'] = $response;

        return $response;
    }
}
