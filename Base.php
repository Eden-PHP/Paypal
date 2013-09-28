<?php //-->
/*
 * This file is part of the Paypal package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Paypal;

use Eden\Core\Base as CoreBase;
use Eden\Curl\Base as Curl;

/**
 * Paypal Base
 *
 * @package Eden
 * @category Paypal
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com 
 */
class Base extends CoreBase
{
    const VERSION = '84.0';
    const TEST_URL = 'https://api-3t.sandbox.paypal.com/nvp';
    const LIVE_URL = 'https://api-3t.paypal.com/nvp';
    const SANDBOX_URL = 'https://test.authorize.net/gateway/transact.dll';
    protected $meta = array();
    protected $url = null;
    protected $user = null;
    protected $password = null;
    protected $signature = null;
    protected $certificate = null;
    
    public function __construct($user, $password, $signature, $certificate, $live = false)
    {
        $this->user = $user;
        $this->password = $password;
        $this->signature = $signature;
        $this->certificate = $certificate;            
        
        $this->url = self::TEST_URL;
        $this->baseUrl = self::TEST_URL;
        if($live) {
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
     * Get Access Key
     *
     * @param array
     * @return array
     */
    protected function accessKey($array)
    {
        foreach($array as $key => $val) {
            if(is_array($val)) {
                $array[$key] = $this->accessKey($val);
            }
            
            if($val == false || $val == null || empty($val) || !$val) {
                unset($array[$key]);
            }
            
        }
        
        return $array;
    }
    
    /**
     * Request a method
     *
     * @param string
     * @param array
     * @param boolean
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
            ->setCaInfo($this->certificate)
            ->setPost(true)
            ->setPostFields($query);
            
        $response = $curl->getQueryResponse();
        
        $this->meta['url'] = $this->baseUrl;
        $this->meta['query'] = $query;
        $this->meta['curl'] = $curl->getMeta();
        $this->meta['response'] = $response;
        
        return $response;
    }
}