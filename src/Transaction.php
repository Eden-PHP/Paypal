<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Paypal;

/**
 * Website Payments Standard - Button Manager
 *
 * @vendor   Eden
 * @package  Paypal
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @author   Airon Paul Dumael <airon.dumael@gmail.com>
 * @standard PSR-2
 */
class Transaction extends Base
{
    /**
     * @const string GET_DETAIL
     */
    const GET_DETAIL = 'GetTransactionDetails';

    /**
     * @const string MANAGE_STATUS
     */
    const MANAGE_STATUS = 'ManagePendingTransactionStatus';

    /**
     * @const string REFUND_TRANSACTION
     */
    const REFUND_TRANSACTION = 'RefundTransaction';

    /**
     * @const string SEARCH
     */
    const SEARCH = 'TransactionSearch';

    /**
     * @const string ACTION
     */
    const ACTION = 'ACTION';

    /**
     * @const string REFUND_TYPE
     */
    const REFUND_TYPE = 'REFUNDTYPE';

    /**
     * @const string STORE_ID
     */
    const STORE_ID = 'STOREID';

    /**
     * @const string START
     */
    const START = 'STARTDATE';

    /**
     * @const string END
     */
    const END = 'ENDDATE';

    /**
     * @const string EMAIL
     */
    const EMAIL = 'EMAIL';

    /**
     * @const string RECEIVER
     */
    const RECEIVER = 'RECEIVER';

    /**
     * @const string RECEIPT_ID
     */
    const RECEIPT_ID = 'RECEIPTID';

    /**
     * @const string TRANSACTION_ID
     */
    const TRANSACTION_ID = 'TRANSACTIONID';

    /**
     * @const string CARD_NUMBER
     */
    const CARD_NUMBER = 'ACCT';

    /**
     * @const string AMOUNT
     */
    const AMOUNT = 'AMT';

    /**
     * @const string CURRENCY
     */
    const CURRENCY = 'CURRENCYCODE';

    /**
     * @const string STATUS
     */
    const STATUS = 'STATUS';

    /**
     * @const string NOTE
     */
    const NOTE = 'NOTE';

    /**
     * @var string|null $action
     */
    protected $action= null;

    /**
     * @var string|null $refundType
     */
    protected $refundType= null;

    /**
     * @var string|null $amount
     */
    protected $amount= null;

    /**
     * @var string|null $currency
     */
    protected $currency= null;

    /**
     * @var string|null $note
     */
    protected $note= null;

    /**
     * @var string|null $storeId
     */
    protected $storeId= null;

    /**
     * @var string|null $start
     */
    protected $start= null;

    /**
     * @var string|null $end
     */
    protected $end= null;

    /**
     * @var string|null $email
     */
    protected $email= null;

    /**
     * @var string|null $receiver
     */
    protected $receiver= null;

    /**
     * @var string|null $receiptId
     */
    protected $receiptId= null;

    /**
     * @var string|null $transactionId
     */
    protected $transactionId= null;

    /**
     * @var string|null $cardNumber
     */
    protected $cardNumber= null;

    /**
     * @var string|null $status
     */
    protected $status= null;

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
            // The transaction ID of the payment transaction.
            self::TRANSACTION_ID => $this->transactionId,
            // Valid values are Accept or Deny
            self::ACTION => $this->action);
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
            // The transaction ID of the payment transaction.
            self::TRANSACTION_ID => $this->transactionId,
            // Valid values are Full,Partial,ExternalDispute or Other
            self::REFUND_TYPE => $this->refundType,
            // Refund amount.
            self::AMOUNT => $this->amount,
            // Currency code
            self::CURRENCY => $this->currency,
            // Custom memo about refund
            self::NOTE => $this->note,
            // ID of merchant store
            self::STORE_ID => $this->storeId);
        // call request method
        $response = $this->request(self::REFUND_TRANSACTION, $query);

        return $response;
    }

    /**
     * Searches transaction history for transactions
     * that meet the specified criteria.
     *
     * The maximum number of transactions that
     * can be returned from a TransactionSearch API call is 100.
     *
     * @return string
     */
    public function search()
    {
        // populate fields
        $query = array(
            // The earliest transaction date at which to start the search
            self::START => $this->start,
            // The latest transaction date to be included in the search.
            self::END => $this->end,
            // Search by the buyer’s email address.
            self::EMAIL => $this->email,
            // Search by the receiver’s email address.
            self::RECEIVER => $this->receiver,
            // Search by the PayPal Account Optional receipt ID.
            self::RECEIPT_ID => $this->receiptId,
            // The transaction ID of the payment transaction.
            self::TRANSACTION_ID => $this->transactionId,
            // Search by credit card number
            self::CARD_NUMBER => $this->cardNumber,
            // Search by transaction amount
            self::AMOUNT => $this->amount,
            // Search by currency code.
            self::CURRENCY => $this->currency,
            // Search by transaction status.
            self::STATUS => $this->status);

        // call request method
        $response = $this->request(self::SEARCH, $query);

        return $response;
    }

    /**
     * Valid values are Accept or Deny
     *
     * @param string* $action
     *
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
     * @param string* $amount Item amount
     *
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
     * @param string* $cardNumber Credit card number
     *
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
     * @param string* $currency Currency Code
     *
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
     * @param string* $email
     *
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
     * @param string* $end
     *
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
     * @param string* $note
     *
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
     * @param string* $receiptId
     *
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
     * @param string* $receiver
     *
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
     * @param string* $refundType
     *
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
     * @param string* $start
     *
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
     * @param string* $status
     *
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
     * @param string* $storeId
     *
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
     * @param string* $transactionId
     *
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
