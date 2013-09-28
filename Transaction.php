<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Paypal Website Payments Pro - Common transaction
 *
 * @package Eden
 * @category Paypal
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Transaction extends Base
{
	const GET_DETAIL			= 'GetTransactionDetails';
	const MANAGE_STATUS			= 'ManagePendingTransactionStatus';
	const REFUND_TRANSACTION	= 'RefundTransaction';
	const SEARCH				= 'TransactionSearch';
	
	const ACTION			= 'ACTION';
	const REFUND_TYPE		= 'REFUNDTYPE';
	const STORE_ID			= 'STOREID';
	const START				= 'STARTDATE';
	const END				= 'ENDDATE';
	const EMAIL				= 'EMAIL';
	const RECEIVER			= 'RECEIVER';
	const RECEIPT_ID		= 'RECEIPTID';
	const TRANSACTION_ID	= 'TRANSACTIONID';
	const CARD_NUMBER		= 'ACCT';
	const AMOUNT			= 'AMT';				
	const CURRENCY			= 'CURRENCYCODE';
	const STATUS			= 'STATUS';
	const NOTE				= 'NOTE';
	
		
	protected $action			= NULL;
	protected $refundType		= NULL;
	protected $amount			= NULL;
	protected $currency		= NULL;
	protected $note			= NULL;
	protected $storeId			= NULL;
	protected $start			= NULL;	
	protected $end				= NULL;
	protected $email			= NULL;
	protected $receiver		= NULL;
	protected $receiptId		= NULL;
	protected $transactionId	= NULL;
	protected $cardNumber		= NULL;
	protected $status			= NULL;
	
	/**
	 * Obtains information about a specific transaction. 
	 *
	 * @return string
	 */
	public function getDetail()
	{
    	//populate fields
		$query = array(self::TRANSACTION_ID => $this->transactionId);
		//call request method
		$response = $this->request(self::GET_DETAIL, $query);
		
		return $response;
	}
	
	/**
	 * Accepts or denys a pending transaction held 
	 * by Fraud Management Filters. 
	 *
	 * @return string
	 */
	public function manageStatus()
	{
    	//populate fields
		$query = array(
			self::TRANSACTION_ID	=> $this->transactionId,	//The transaction ID of the payment transaction.
			self::ACTION			=> $this->action);			//Valid values are Accept or Deny
		//call request method
		$response = $this->request(self::MANAGE_STATUS, $query);
		
		return $response;
	}
	
	/**
	 * Issues a refund to the PayPal account holder 
	 * associated with a transaction.
	 *
	 * @return string
	 */
	public function refundTransaction()
	{
    	//populate fields
		$query = array(
			self::TRANSACTION_ID	=> $this->transactionId,	//The transaction ID of the payment transaction.
			self::REFUND_TYPE		=> $this->refundType,		//Valid values are Full,Partial,ExternalDispute or Other 
			self::AMOUNT			=> $this->amount,			//Refund amount. 
			self::CURRENCY			=> $this->currency,		//Currency code
			self::NOTE				=> $this->note,			//Custom memo about refund
			self::STORE_ID			=> $this->storeId);		//ID of merchant store
		//call request method
		$response = $this->request(self::REFUND_TRANSACTION, $query);
		
		return $response;
	}
	
	/**
	 * Searches transaction history for transactions 
	 * that meet the specified criteria.
	 *
	 * @return string
	 * @note The maximum number of transactions that 
	 * can be returned from a TransactionSearch API call is 100.
	 */
	public function search()
	{
    	//populate fields
		$query = array(
			self::START				=> $this->start,			//The earliest transaction date at which to start the search 
			self::END				=> $this->end,				//The latest transaction date to be included in the search. 
			self::EMAIL				=> $this->email,			//Search by the buyer�s email address.
			self::RECEIVER			=> $this->receiver,		//Search by the receiver�s email address.
			self::RECEIPT_ID		=> $this->receiptId,		//Search by the PayPal Account Optional receipt ID.
			self::TRANSACTION_ID	=> $this->transactionId,	//The transaction ID of the payment transaction.
			self::CARD_NUMBER		=> $this->cardNumber,		//Search by credit card number
			self::AMOUNT			=> $this->amount,			//Search by transaction amount
			self::CURRENCY			=> $this->currency,		//Search by currency code.
			self::STATUS			=> $this->status);			//Search by transaction status.
		
		//call request method
		$response = $this->request(self::SEARCH, $query);
		
		return $response;
	}
	
	/**
	 * Valid values are Accept or Deny
	 *
	 * @param string
	 * @return this
	 */
	public function setAction($action)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->action = $action;
		return $this;
	}
	
	/**
	 * Set item amount  
	 *
	 * @param string		Item amount
	 * @return this
	 */
	public function setAmount($amount)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->amount = $amount;
		return $this;
	}
	
	/**
	 * Search by credit card number  
	 *
	 * @param string		Credit card number
	 * @return this
	 */
	public function setCardNumber($cardNumber)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->cardNumber = $cardNumber;
		return $this;
	}
	
	/**
	 * Set currency code 
	 *
	 * @param string		Currency code
	 * @return this
	 */
	public function setCurrency($currency)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->currency = $currency;
		return $this;
	}
	
	/**
	 * Search by the buyer�s email address.
	 *
	 * @param string
	 * @return this
	 */
	public function setEmail($email)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->email = $email;
		return $this;
	}
	
	/**
	 * The latest transaction date to be 
	 * included in the search.
	 *
	 * @param string
	 * @return this
	 */
	public function setEndDate($end)
	{
		$date = strtotime($end);
		$this->end = gmdate('Y-m-d\TH:i:s\Z', $date);
		return $this;
	}
	
	/**
	 * Custom memo about the refund.
	 *
	 * @param string
	 * @return this
	 */
	public function setNote($note)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->note = $note;
		return $this;
	}
	
	/**
	 * Search by the PayPal Account Optional 
	 * receipt ID.
	 *
	 * @param string
	 * @return this
	 */
	public function setReceiptId($receiptId)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->receiptId = $receiptId;
		return $this;
	}
	
	/**
	 * Search by the receiver�s email address. 
	 * If the merchant account has only one email 
	 * address, this is the primary email. It can 
	 * also be a non-primary email address.
	 *
	 * @param string
	 * @return this
	 */
	public function setReceiver($receiver)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->receiver = $receiver;
		return $this;
	}
	
	/**
	 * Valid values are 
	 * Full - Full refund (default).
	 * Partial � Partial refund.
	 * ExternalDispute � External dispute.
	 * Other � Other type of refund.
	 *
	 * @param string
	 * @return this
	 */
	public function setRefundType($refundType)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->refundType = $refundType;
		return $this;
	}
	
	/**
	 * The earliest transaction date at 
	 * which to start the search.
	 *
	 * @param string
	 * @return this
	 */
	public function setStartDate($start)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$date = strtotime($start);
		$this->start = gmdate('Y-m-d\TH:i:s\Z', $date);
		return $this;
	}
	
	/**
	 * Search by transaction status. 
	 *
	 * @param string		Currency code
	 * @return this
	 */
	public function setStatus($status)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->status = $status;
		return $this;
	}
	
	/**
	 * ID of the merchant store. This field is 
	 * required for point-of-sale transactions.
	 *
	 * @param string
	 * @return this
	 */
	public function setStoreId($storeId)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->storeId = $storeId;
		return $this;
	}
	
	/**
	 * Search by the transaction ID. The 
	 * returned results are from the merchant�s
	 * transaction records.
	 *
	 * @param string
	 * @return this
	 */
	public function setTransactionId($transactionId)
	{
		//Argument 1 must be a string
		Argument::i()->test(1, 'string');	
		
		$this->transactionId = $transactionId;
		return $this;
	}
}