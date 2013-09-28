<?php //-->
/*
 * This file is part of the Paypal package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Paypal;

/**
 * Paypal Express Checkout
 *
 * @package Eden
 * @category Paypal
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com 
 */
class Checkout extends Base
{
    const TEST_URL_CHECKOUT = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=%s';
    const LIVE_URL = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=%s';
    
    const SET_METHOD = 'SetExpressCheckout';
    const GET_METHOD = 'GetExpressCheckoutDetails';
    const DO_METHOD  = 'DoExpressCheckoutPayment';
    const DO_ADDRESS_VERIFY = 'AddressVerify';
    const CALL_BACK = 'Callback';
    const GET_BALANCE = 'GetBalance';
    const MASS_PAYMENT = 'MassPay';
    const GET_DETAIL = 'GetPalDetails';
    
    const SUCCESS = 'Success';
    const ACK = 'ACK';
    const TOKEN = 'TOKEN';
    const SALE = 'Sale';
    const ERROR = 'L_LONGMESSAGE0';
    
    const RETURN_URL = 'RETURNURL';             
    const CANCEL_URL = 'CANCELURL';                 
    const TOTAL_AMOUNT = 'PAYMENTREQUEST_0_AMT';        
    const SHIPPING_AMOUNT = 'PAYMENTREQUEST_0_SHIPPINGAMT';
    const CURRENCY = 'PAYMENTREQUEST_0_CURRENCYCODE';
    const ITEM_AMOUNT = 'PAYMENTREQUEST_0_ITEMAMT'; 
    const ITEM_NAME = 'L_PAYMENTREQUEST_0_NAME0';   
    const ITEM_DESCRIPTION = 'L_PAYMENTREQUEST_0_DESC0';        
    const ITEM_AMOUNT2 = 'L_PAYMENTREQUEST_0_AMT0';     
    const QUANTITY = 'L_PAYMENTREQUEST_0_QTY0';
    const EMAIL = 'EMAIL';
    const STREET = 'STREET';
    const ZIP = 'ZIP';
    const RETURN_CURRENCIES = 'RETURNALLCURRENCIES';
    const EMAIL_SUBJECT = 'EMAILSUBJECT';
    const SOLUTION_TYPE = 'SOLUTIONTYPE';
    
    const PAYMENT_ACTION = 'PAYMENTACTION';                 
    const PAYER_ID = 'PAYERID';                     
    const TRANSACTION_ID = 'PAYMENTINFO_0_TRANSACTIONID';
    
    protected $callBack = false;
    protected $currencies = 0;
    
    protected $amount = null;
    protected $shippingAmount = null;
    protected $currency = null;
    protected $itemAmount = null;
    protected $itemName = null;
    protected $itemDescription = null;
    protected $quantity = null;
    protected $email = null;
    protected $street = null;
    protected $zip = null;
    protected $emailSubject = null;
    protected $solutionType = 'Sole';
        
    public function __construct($user, $password, $signature, $certificate, $live = false)
    {
        parent::__construct($user, $password, $signature, $certificate, $live);
        
        $this->url  = self::TEST_URL_CHECKOUT;
        if($live) {
            $this->url = self::LIVE_URL;
        }
    }

    /**
     * Confirms whether a postal address and postal 
     * code match those of the specified PayPal 
     * account holder.  
     *
     * @return string
     */
    public function checkAddress()
    {
        $query = array(
            self::EMAIL     => $this->email,
            self::STREET    => $this->street,
            self::ZIP       => $this->zip);
        
        // call request method address verify
        $response = $this->request(self::DO_ADDRESS_VERIFY, $query);
        //  If checking successful
        if(isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) { 
            
            return $response;
        }
        
        return $response;
    }
    
    /**
     * Makes a payment to one or more PayPal account holders.
     *
     * @return string
     */
    public function doMassPayment()
    {
    
        $query = array(
            self::EMAIL_SUBJECT => $this->emailSubject,     // The subject line of the email that PayPal sends 
            self::CURRENCY      => $this->currency);        // currency code
        // call request method call back
        return $this->request(self::MASS_PAYMENT, $query);
                
    }
    
    /**
     * Obtains the available balance for a PayPal account. 
     *
     * @return string
     */
    public function getBalance()
    {
        //  Indicates whether to return all currencies.
        $query = array(self::RETURN_CURRENCIES  => $this->currencies);
        // call request method call back
        return $this->request(self::GET_BALANCE, $query);
                    
    }
    
    /**
     * Obtains your Pal ID, which is the PayPal-assigned merchant 
     * account number, and other information about your account. 
     * You need the account number when working with dynamic 
     * versions of PayPal buttons and logos.
     *
     * @return string
     */
    public function getDetail()
    {           
        // call request method call back
        return $this->request(self::GET_DETAIL);
                
    }
    
    /**
     * Sends checkout information to paypal  
     *
     * @param string        The Return URL
     * @param string        The Cancel URL
     * @param array
     * @return string
     */
    public function getResponse($return, $cancel)
    {
        // Argument Test
        Argument::i()
            // Argument 1 must be a string
            ->test(1, 'string')
            // Argument 2 must be a string
            ->test(2, 'string');
        
        $query = array(
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Authorization',
            self::SOLUTION_TYPE => $this->solutionType,
            self::TOTAL_AMOUNT => $this->amount,                // amount of item
            self::RETURN_URL => $return,
            self::CANCEL_URL => $cancel,                    
            self::SHIPPING_AMOUNT => $this->shippingAmount,     // amount of shipping
            self::CURRENCY => $this->currency,                  // currency code
            self::ITEM_AMOUNT => $this->itemAmount,             // item amount is shippingAmount minus amount
            self::ITEM_NAME => $this->itemName,                 // name of item
            self::ITEM_DESCRIPTION => $this->itemDescription,   // description of item
            self::ITEM_AMOUNT2 => $this->itemAmount,            // item amount is shipping minus amount
            self::QUANTITY => $this->quantity);                 // quantity of item
        
        // call request method set express checkout
        $response = $this->request(self::SET_METHOD, $query, false);
        // if parameters are success
        if(isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) {
            // fetch token
            // if callback is true
            if($this->callBack) {
                $this->token = $response[self::TOKEN];
                return $this->getCallback();
            }
        }
        
        return $response;
    }
    
    /**
     * Set the amount of the item  
     *
     * @param integer or float      Amount of the item
     * @return Eden\Paypal\Checkout
     */
    public function getTransactionId($payerId)
    {
        $this->payer = $payerId;
        if(!$this->token) {
            return null;
        }
        
        // Get checkout details, including buyer information, call get express checkout method
        $checkoutDetails = $this->request(self::GET_METHOD, array(self::TOKEN => $this->token));
        
        // Complete the checkout transaction
        $query = array(
           self::TOKEN => $this->token,
           self::PAYMENT_ACTION => self::SALE,
           self::PAYER_ID => $this->payer,
           self::TOTAL_AMOUNT => $this->amount,         // Same amount as in the original request
           self::CURRENCY => $this->currency);          // Same currency as the original request
        
        // call request method do express checckout
        $response = $this->request(self::DO_METHOD, $query);
        
        // If payment successful\
        // Fetch the transaction ID 
        return $response;
    }

    /**
     * Set the amount of the item  
     *
     * @param integer or float      Amount of the item
     * @return Eden\Paypal\Checkout
     */
    public function setAmount($amount)
    {
        // Argument 1 must be an integer or float
        Argument::i()->test(1, 'integer', 'float'); 
        
        $this->amount = $amount;
        return $this;
    }
    
    /**
     * Set callback to true  
     *  
     * @return Eden\Paypal\Checkout
     */
    public function setCallBack()
    {   
        $this->callBack = 'true';
        return $this;
    }
    
    /**
     * Set Solution type, value are
     * Sole –   Buyer does not need to create a 
     *          PayPal account to check out. This 
     *          is referred to as PayPal Account Optional.
     * Mark –   Buyer must have a PayPal account to 
     *          check out.
     *  
     * @param string
     * @return Eden\Paypal\Checkout
     */
    public function setSolutionType($solutioType = 'Sole')
    {
        // Argument 1 must be an string
        Argument::i()->test(1, 'string');   
        
        $this->solutionType = $solutioType;
        return $this;
    }
    
    /**
     * Indicates whether to return all currencies.   
     *  
     * @return Eden\Paypal\Checkout
     */
    public function setCurrencies()
    {
        $this->currencies = 1;
        return $this;
    }
    
    /**
     * Set currrency  
     *
     * @param string        Currency code
     * @return Eden\Paypal\Checkout
     */
    public function setCurrency($currency)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->currency = $currency;
        return $this;
    }
    
    /**
     * Set consumer email  
     *
     * @param string        consumer email
     * @return Eden\Paypal\Checkout
     */
    public function setEmail($email)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->email = $email;
        return $this;
    }
    
    /**
     * Indicates whether to return all currencies.   
     *
     * @param boolean       
     * @return Eden\Paypal\Checkout
     */
    public function setEmailSubject($emailSubject)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->emailSubject = $emailSubject;
        return $this;
    }
    
    /**
     * Set total amount of the item 
     *
     * @param integer or float      Total amount of the item
     * @return Eden\Paypal\Checkout
     */
    public function setItemAmount($itemAmount)
    {
        // Argument 1 must be an integer or float
        Argument::i()->test(1, 'integer', 'float'); 
        
        $this->itemAmount = $itemAmount;
        return $this;
    }
    
    /**
     * Set item descrption  
     *
     * @param string        Item Description
     * @return Eden\Paypal\Checkout
     */
    public function setItemDescription($itemDescription)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->itemDescription = $itemDescription;
        return $this;
    }
    
    /**
     * Set item name  
     *
     * @param string        Item name
     * @return Eden\Paypal\Checkout
     */
    public function setItemName($itemName)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->itemName = $itemName;
        return $this;
    }
    
    /**
     * Set quantity of item  
     *
     * @param integer       Item quantity
     * @return Eden\Paypal\Checkout
     */
    public function setQuantity($quantity)
    {
        // Argument 1 must be a integer
        Argument::i()->test(1, 'int');  
        
        $this->quantity = $quantity;
        return $this;
    }
    
    /**
     * Set shipping amount of the item  
     *
     * @param integer or float      Shipping amount of the item
     * @return Eden\Paypal\Checkout
     */
    public function setShippingAmount($shippingAmount)
    {
        // Argument 1 must be an integer or float
        Argument::i()->test(1, 'integer', 'float'); 
        
        $this->shippingAmount = $shippingAmount;
        return $this;
    }
    
    /**
     * Set consumer street  
     *
     * @param string        consumer street
     * @return Eden\Paypal\Checkout
     */
    public function setStreet($street)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->street = $street;
        return $this;
    }
    
    /**
     * Set Token for Paypal
     *
     * @param string
     * @param boolean
     * @return Eden\Paypal\Checkout
     */
    public function setToken($token, $redirect = false)
    {
        $this->token = $token;
        if($redirect == true){
            header('Location: '. sprintf($this->url, urlencode($this->token)) );
            return;
        }
        
        return $this;
    }
    
    /**
     * Set consumer zip code  
     *
     * @param string        consumer zip code
     * @return Eden\Paypal\Checkout
     */
    public function setZip($zip)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');   
        
        $this->zip = $zip;
        return $this;
    }
    
    /**
     * Get Callback  
     *
     * @return string
     */
    protected function getCallback()
    {
        // currency code
        $query = array(self::CURRENCY => $this->currency,
                       self::TOKEN => $this->token);   
        // call request method call back
        return $this->request(self::CALL_BACK, $query);
    }
}