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
 * Paypal Website Payments Pro - Common transaction
 *
 * @package Eden
 * @category Paypal
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com
 */
class Transaction extends Base
{
    const GET_DETAIL = 'GetTransactionDetails';
    const MANAGE_STATUS = 'ManagePendingTransactionStatus';
    const REFUND_TRANSACTION = 'RefundTransaction';
    const SEARCH = 'TransactionSearch';
    
    const ACTION = 'ACTION';
    const REFUND_TYPE = 'REFUNDTYPE';
    const STORE_ID = 'STOREID';
    const START = 'STARTDATE';
    const END = 'ENDDATE';
    const EMAIL = 'EMAIL';
    const RECEIVER = 'RECEIVER';
    const RECEIPT_ID = 'RECEIPTID';
    const TRANSACTION_ID = 'TRANSACTIONID';
    const CARD_NUMBER = 'ACCT';
    const AMOUNT = 'AMT';                
    const CURRENCY = 'CURRENCYCODE';
    const STATUS = 'STATUS';
    const NOTE = 'NOTE';
    
        
    protected $action = null;
    protected $refundType = null;
    protected $amount = null;
    protected $currency = null;
    protected $note = null;
    protected $storeId = null;
    protected $start = null;    
    protected $end = null;
    protected $email = null;
    protected $receiver = null;
    protected $receiptId = null;
    protected $transactionId = null;
    protected $cardNumber = null;
    protected $status = null;
    
    /**
     * Obtains information about a specific transaction. 
     *
     * @return string
     */
    public function getDetail()
    {
        // populate fields
        $query = array(self::TRANSACTION_ID => $this->transactionId);
        // call request method
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
        // populate fields
        $query = array(
            self::TRANSACTION_ID => $this->transactionId,    // The transaction ID of the payment transaction.
            self::ACTION => $this->action);                  // Valid values are Accept or Deny
        // call request method
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
        // populate fields
        $query = array(
            self::TRANSACTION_ID => $this->transactionId,   // The transaction ID of the payment transaction.
            self::REFUND_TYPE => $this->refundType,         // Valid values are Full,Partial,ExternalDispute or Other 
            self::AMOUNT => $this->amount,                  // Refund amount. 
            self::CURRENCY => $this->currency,              // Currency code
            self::NOTE => $this->note,                      // Custom memo about refund
            self::STORE_ID => $this->storeId);              // ID of merchant store
        // call request method
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
        // populate fields
        $query = array(
            self::START => $this->start,                    // The earliest transaction date at which to start the search 
            self::END => $this->end,                        // The latest transaction date to be included in the search. 
            self::EMAIL => $this->email,                    // Search by the buyer’s email address.
            self::RECEIVER => $this->receiver,              // Search by the receiver’s email address.
            self::RECEIPT_ID => $this->receiptId,           // Search by the PayPal Account Optional receipt ID.
            self::TRANSACTION_ID => $this->transactionId,   // The transaction ID of the payment transaction.
            self::CARD_NUMBER => $this->cardNumber,         // Search by credit card number
            self::AMOUNT => $this->amount,                  // Search by transaction amount
            self::CURRENCY => $this->currency,              // Search by currency code.
            self::STATUS => $this->status);                 // Search by transaction status.
        
        // call request method
        $response = $this->request(self::SEARCH, $query);
        
        return $response;
    }
    
    /**
     * Valid values are Accept or Deny
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setAction($action)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->action = $action;
        return $this;
    }
    
    /**
     * Set item amount  
     *
     * @param string        Item amount
     * @return Eden\Paypal\Transaction
     */
    public function setAmount($amount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->amount = $amount;
        return $this;
    }
    
    /**
     * Search by credit card number  
     *
     * @param string        Credit card number
     * @return Eden\Paypal\Transaction
     */
    public function setCardNumber($cardNumber)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->cardNumber = $cardNumber;
        return $this;
    }
    
    /**
     * Set currency code 
     *
     * @param string        Currency code
     * @return Eden\Paypal\Transaction
     */
    public function setCurrency($currency)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->currency = $currency;
        return $this;
    }
    
    /**
     * Search by the buyer’s email address.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setEmail($email)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->email = $email;
        return $this;
    }
    
    /**
     * The latest transaction date to be 
     * included in the search.
     *
     * @param string
     * @return Eden\Paypal\Transaction
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
     * @return Eden\Paypal\Transaction
     */
    public function setNote($note)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->note = $note;
        return $this;
    }
    
    /**
     * Search by the PayPal Account Optional 
     * receipt ID.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setReceiptId($receiptId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->receiptId = $receiptId;
        return $this;
    }
    
    /**
     * Search by the receiver’s email address. 
     * If the merchant account has only one email 
     * address, this is the primary email. It can 
     * also be a non-primary email address.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setReceiver($receiver)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->receiver = $receiver;
        return $this;
    }
    
    /**
     * Valid values are 
     * Full - Full refund (default).
     * Partial – Partial refund.
     * ExternalDispute – External dispute.
     * Other – Other type of refund.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setRefundType($refundType)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->refundType = $refundType;
        return $this;
    }
    
    /**
     * The earliest transaction date at 
     * which to start the search.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setStartDate($start)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');
        
        $date = strtotime($start);
        $this->start = gmdate('Y-m-d\TH:i:s\Z', $date);
        return $this;
    }
    
    /**
     * Search by transaction status. 
     *
     * @param string        Currency code
     * @return Eden\Paypal\Transaction
     */
    public function setStatus($status)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->status = $status;
        return $this;
    }
    
    /**
     * ID of the merchant store. This field is 
     * required for point-of-sale transactions.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setStoreId($storeId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->storeId = $storeId;
        return $this;
    }
    
    /**
     * Search by the transaction ID. The 
     * returned results are from the merchant’s
     * transaction records.
     *
     * @param string
     * @return Eden\Paypal\Transaction
     */
    public function setTransactionId($transactionId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');    
        
        $this->transactionId = $transactionId;
        return $this;
    }
}