<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Paypal Website Payments Pro - Billing Agreement
 *
 * @package Eden
 * @category Paypal
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Billing extends Base
{
	const SET_AGREEMENT		= 'SetCustomerBillingAgreement';
	const GET_AGREEMENT		= 'GetBillingAgreementCustomerDetails';
	const TOKEN				= 'TOKEN';
	const RETURN_URL		= 'RETURNURL';
	const CANCEL_URL		= 'CANCELURL';
	
	const ANY				= 'Any';
	const INSTANT_ONLY		= 'InstantOnly';
	const ACK				= 'ACK';
	const SUCCESS			= 'Success';
	
	const BILLING_TYPE		= 'L_BILLINGTYPEn';
	const BILLING_DESC		= 'L_BILLINGAGREEMENTDESCRIPTIONn';
	const PAYMENT_TYPE		= 'L_PAYMENTTYPEn';
	const AGREEMENT_CUSTOM	= 'L_BILLINGAGREEMENTCUSTOMn';
	const AMOUNT			= 'AMT';
	
		
	protected $token			= NULL;
	protected $amout			= NULL;
	protected $currency		= NULL;
	protected $completeType	= NULL;
	protected $billingType		= NULL;
	protected $billingDesc		= NULL;
	protected $paymentType		= NULL;
	protected $agreementCustom	= NULL;
	
	/**
	 * initiates the creation of a billing agreement. 
	 *
	 * @param string		Returing URL
	 * @param string		Cancel URL
	 * @return string
	 */
	public function getResponse($return, $cancel)
	{
		//Argument Test
		Argument::i()
			//Argument 1 must be a string
			->test(1, 'string')
			//Argument 2 must be a string
			->test(2, 'string');
		
    	//populate fields
		$query = array(
			self::RETURN_URL		=> $return,
			self::CANCEL_URL		=> $cancel,
			self::BILLING_TYPE		=> $this->billingType,	
			self::BILLING_DESC		=> $this->billingDesc,			//Description associated with the billing agreement.
			self::PAYMENT_TYPE		=> $this->paymentType,			//Valid vaules are Any or InstantOnly
			self::AGREEMENT_CUSTOM	=> $this->agreementCustom);	//Custom annotation field for your own use.
		
		//call request method
		$response = $this->request(self::SET_AGREEMENT, $query);
		
		//if parameters are success
		if(isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) {
			//fetch token
			$this->token = $response[self::TOKEN];  
			//if token is exist and not empty
			if($this->token) {
				return $this->getAgreement();
			}
		} 
		
		return $response;	
	}
	
	/**
	 * Custom annotation field for your own use.
	 *
	 * @param string
	 * @return this
	 * @note For recurring payments, this field is ignored.
	 */
	public function setAgreementCustom($agreementCustom)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->agreementCustom = $agreementCustom;
		return $this;
	}
	
	/**
	 * Description of goods or services associated 
	 * with the billing agreement.
	 *
	 * @param string
	 * @return this
	 */
	public function setBillingDesc($billingDesc)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->billingDesc = $billingDesc;
		return $this;
	}
	
	/**
	 * Set billing type
	 * 
	 * @param string
	 * @return this
	 */
	public function setBillingType($billingType)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->billingType = $billingType;
		return $this;
	}
	
	/**
	 * Set payment type to Any
	 *
	 * @return this
	 * @note For recurring payments, this field is ignored.
	 */
	public function setToAny()
	{
		$this->paymentType = self::ANY;
		return $this;
	}
	
	/**
	 * Set payment type to Instant Only
	 *
	 * @return this
	 * @note For recurring payments, this field is ignored.
	 */
	public function setToInstantOnly()
	{
		$this->paymentType = self::INSTANT_ONLY;
		return $this;
	}
	
	protected function getAgreement()
	{
		//populate fields
		$query = array(self::TOKEN => $this->token);
		//call request method
		return $this->request(self::GET_AGREEMENT, $query);
	}
}