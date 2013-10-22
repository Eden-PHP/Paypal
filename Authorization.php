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
 * Paypal Website Payments Pro - Authorization and Capture
 *
 * @package Eden
 * @category Paypal
 * @author Airon Paul Dumael airon.dumael@gmail.com
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com
 */
class Authorization extends Base
{
    const DO_AUTHORIZATION = 'DoAuthorization';
    const DO_CAPTURE = 'DoCapture';
    const DO_REAUTHORIZATION = 'DoReauthorization';
    const DO_VOID = 'DoVoid';

    const TRANSACTION_ID = 'TRANSACTIONID';
    const AUTHORIZATION_ID = 'AUTHORIZATIONID';

    const ENTITY = 'TRANSACTIONENTITY';
    const ORDER    = 'Order';
    const ACK = 'ACK';
    const SUCCESS = 'Success';
    const AMOUNT = 'AMT';
    const CURRENCY = 'CURRENCYCODE';
    const COMPLETE_TYPE = 'COMPLETETYPE';
    const COMPLETE = 'COMPLETE';
    const NO_COMPLETE = 'NoComplete';
    const NOTE = 'NOTE';

    protected $amount = null;
    protected $currency = null;
    protected $completeType = null;
    protected $note = null;
    protected $transactionId = null;

    /**
     * Authorize a payment.
     *
     * @return array
     */
    public function doAuthorization()
    {
        // populate fields
        $query = array(
            self::TRANSACTION_ID => $this->transactionId,
            // amount of the payment
            self::AMOUNT => $this->amount,
            // Type of transaction to authorize
            self::ENTITY => self::ORDER,
            // currency code, default is USD
            self::CURRENCY => $this->currency);

        // call request method
        $response = $this->request(self::DO_AUTHORIZATION, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            // Get the transaction Id
            return $response[self::TRANSACTION_ID];
        }

        return $response;
    }

    /**
     * Captures an authorized payment.
     *
     * @return string
     */
    public function doCapture()
    {
        // populate fields
        $query = array(
            // Transaction Id
            self::AUTHORIZATION_ID => $this->transactionId,
            // amount of the payment
            self::AMOUNT => $this->amount,
            // currency code, default is USD
            self::CURRENCY => $this->currency,
            // Valid values are Complete or    NotComplete
            self::COMPLETE_TYPE => $this->completeType,
            // An informational note about the settlement
            self::NOTE => $this->note);

        // call request method
        $response = $this->request(self::DO_CAPTURE, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            //  Get the authorization Id
            return $response[self::AUTHORIZATION_ID];
        }

        return $response;
    }

    /**
     * Re-authorize a payment.
     *
     * @return string
     */
    public function doReAuthorization()
    {
        // populate fields
        $query = array(
            self::AUTHORIZATION_ID => $this->transactionId,
            // amount of the payment
            self::AMOUNT => $this->amount,
            // currency code, default is USD
            self::CURRENCY => $this->currency);
        // call request method
        $response = $this->request(self::DO_REAUTHORIZATION, $query);
        // if parameters are success
        if (isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) {
            // Get the authorization ID
            return $response[self::AUTHORIZATION_ID];
        }

        return $response;
    }

    /**
     * Void an order or an authorization.
     *
     * @return string
     */
    public function doVoid()
    {
        // populate fields
        $query = array(
            self::AUTHORIZATION_ID => $this->transactionId,
            // An informational note about the settlement
            self::NOTE => $this->note);
        // call request method
        $response = $this->request(self::DO_VOID, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            // Get the authorization ID
            return $response[self::AUTHORIZATION_ID];
        }

        return $response;
    }

    /**
     * Set item amount
     *
     * @param integer|float Item amount
     * @return Eden\Paypal\Authorization
     */
    public function setAmount($amount)
    {
        // Argument 1 must be an integer or float
        Argument::i()->test(1, 'int', 'float');

        $this->amount = $amount;
        return $this;
    }

    /**
     * Set complete type to complete
     * Complete - This the last capture you intend to make
     *
     * @return Eden\Paypal\Authorization
     */
    public function setComplete()
    {
        $this->completeType = self::COMPLETE;
        return $this;
    }

    /**
     * Set currency code
     *
     * @param string Currency code
     * @return Eden\Paypal\Authorization
     */
    public function setCurrency($currency)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->currency = $currency;
        return $this;
    }

    /**
     * Set complete type to no complete
     * NoComplete - You intend to make additional captures.
     *
     * @return Eden\Paypal\Authorization
     */
    public function setNoComplete()
    {
        $this->completeType = self::NO_COMPLETE;
        return $this;
    }

    /**
     * An informational note about this settlement that
     * is displayed to the buyer in email and in their
     * transaction history.
     *
     * @param string
     * @return Eden\Paypal\Authorization
     */
    public function setNote($note)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->note = $note;
        return $this;
    }

    /**
     * Set Transaction Id
     *
     * @param string
     * @return Eden\Paypal\Authorization
     */
    public function setTransactionId($transactionId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->transactionId = $transactionId;
        return $this;
    }
}
