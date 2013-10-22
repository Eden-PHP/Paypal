<?php // -->
/*
 * This file is part of the Paypal package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Paypal;

/**
 * Paypal Website Payments Pro - Direct Payment
 *
 * @package Eden
 * @category Paypal
 * @author Airon Paul Dumael airon.dumael@gmail.com
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com
 */
class Direct extends Base
{
    const DIRECT_PAYMENT = 'DoDirectPayment';
    const NON_REFERENCED_CREDIT = 'DoNonReferencedCredit';

    const TRANSACTION_ID = 'TRANSACTIONID';
    const SALE = 'sale';
    const ACK = 'ACK';
    const SUCCESS = 'Success';
    const REMOTE_ADDRESS = 'REMOTE_ADDR';
    const IP_ADDRESS = 'IPADDRESS';
    const PAYMENT_ACTION = 'PAYMENTACTION';

    const CARD_TYPE = 'CREDITCARDTYPE';
    const CARD_NUMBER = 'ACCT';
    const EXPIRATION_DATE = 'EXPDATE'   ;
    const CVV = 'CVV2';
    const FIRST_NAME = 'FIRSTNAME';
    const LAST_NAME = 'LASTNAME';
    const EMAIL = 'EMAIL';
    const COUNTRY_CODE = 'COUNTRYCODE';
    const STATE = 'STATE';
    const CITY = 'CITY';
    const STREET = 'STREET';
    const ZIP = 'ZIP';
    const AMOUNT = 'AMT';
    const CURRENCY = 'CURRENCYCODE';

    protected $nonReferencedCredit = false;

    protected $profileId = null;
    protected $cardType = null;
    protected $cardNumber = null;
    protected $expirationDate = null;
    protected $cvv2 = null;
    protected $firstName = null;
    protected $lastName = null;
    protected $email = null;
    protected $countryCode = null;
    protected $state = null;
    protected $city = null;
    protected $street = null;
    protected $zip = null;
    protected $amout = null;
    protected $currency = null;

    /**
     * Process a credit card direct payment
     *
     * @return string
     * @note Contact PayPal to use DoNonReferencedCredit
     * API operation, in most cases, you should use the
     * RefundTransaction API operation instead.
     */
    public function getResponse()
    {
        // populate fields
        $query = array(
            // IP address of the consumer
            self::IP_ADDRESS => $_SERVER[self::REMOTE_ADDRESS],
            // payment action(sale or authorize)
            self::PAYMENT_ACTION => self::SALE,
            // creidit card type
            self::CARD_TYPE => $this->cardType,
            // credit card account number
            self::CARD_NUMBER => $this->cardNumber,
            // credit card expiration date
            self::EXPIRATION_DATE => $this->expirationDate,
            // 3 - digits card verification number
            self::CVV => $this->cvv2,
            // cardholder firstname
            self::FIRST_NAME => $this->firstName,
            // cardholder lastname
            self::LAST_NAME => $this->lastName,
            // cardholder email
            self::EMAIL => $this->email,
            // cardholder country code
            self::COUNTRY_CODE => $this->countryCode,
            // cardholder state
            self::STATE => $this->state,
            // cardholder city
            self::CITY => $this->city,
            // cardholder street
            self::STREET => $this->street,
            // cardholder ZIP
            self::ZIP => $this->zip,
            // amount of the payment
            self::AMOUNT => $this->amount,
            // currency code, default is USD
            self::CURRENCY => $this->currency);

        // if Set Non Referenced Credit is true
        if ($this->isNonReferencedCredit) {
            // call non referenced credit method
            return $this->setNonReferencedCredit($query);
        }

        // call direct payment method
        return $this->setDirectPayment($query);
    }

    /**
     * Set item amount
     *
     * @param integer or float      Item amount
     * @return Eden\Paypal\Direct
     */
    public function setAmount($amount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'int', 'float');

        $this->amount = $amount;
        return $this;
    }

    /**
     * Set credit card number
     *
     * @param string        Credit card number
     * @return Eden\Paypal\Direct
     */
    public function setCardNumber($cardNumber)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * Set credit card type
     *
     * @param string        Credit card type
     * @return Eden\Paypal\Direct
     */
    public function setCardType($cardType)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->cardType = $cardType;
        return $this;
    }

    /**
     * Set cardholder city
     *
     * @param string        City
     * @return Eden\Paypal\Direct
     */
    public function setCity($city)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->city = $city;
        return $this;
    }

    /**
     * Set cardholder country code
     *
     * @param string        Country Code
     * @return Eden\Paypal\Direct
     */
    public function setCountryCode($countryCode)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Set currency code
     *
     * @param string        Currency code
     * @return Eden\Paypal\Direct
     */
    public function setCurrency($currency)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->currency = $currency;
        return $this;
    }

    /**
     * Set Card Verification Value
     *
     * @param string        3 - digit cvv number
     * @return Eden\Paypal\Direct
     */
    public function setCvv2($cvv2)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->cvv2 = $cvv2;
        return $this;
    }

    /**
     * Set cardholder email address
     *
     * @param string        Email address
     * @return Eden\Paypal\Direct
     */
    public function setEmail($email)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->email = $email;
        return $this;
    }

    /**
     * Set credit card expiration date
     *
     * @param string        Credit card expiration date
     * @return Eden\Paypal\Direct
     */
    public function setExpirationDate($expirationDate)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * Set cardholder first name
     *
     * @param string        First name
     * @return Eden\Paypal\Direct
     */
    public function setFirstName($firstName)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Set cardholder last name
     *
     * @param string        Last name
     * @return Eden\Paypal\Direct
     */
    public function setLastName($lastName)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Issue a credit to a card not referenced
     * by the original transaction.
     *
     * @return Eden\Paypal\Direct
     */
    public function isNonReferencedCredit()
    {
        $this->isNonReferencedCredit = 'true';
        return $this;
    }

    /**
     * Set cardholder state
     *
     * @param string        State
     * @return Eden\Paypal\Direct
     */
    public function setState($state)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->state = $state;
        return $this;
    }

    /**
     * Set cardholder street
     *
     * @param string        Street
     * @return Eden\Paypal\Direct
     */
    public function setStreet($street)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->street = $street;
        return $this;
    }

    /**
     * Set cardholder zip code
     *
     * @param string        Zip code
     * @return Eden\Paypal\Direct
     */
    public function setZip($zip)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->zip = $zip;
        return $this;
    }

    /**
     * Set direct payment
     *
     * @param array
     * @return number
     */
    protected function setDirectPayment($query)
    {
        // Argument 1 must be an array
        Argument::i()->test(1, 'array');

        // do direct payment
        $response = $this->request(self::DIRECT_PAYMENT, $query);
        // if parameters are success
        if (isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) {
            //  Get the transaction ID
            return $response[self::TRANSACTION_ID];
        }

        return $response;
    }

    /**
     * Set non-referenced Credit
     *
     * @param array|string
     * @return number
     */
    protected function setNonReferencedCredit($query)
    {
        // Argument 1 must be an array
        Argument::i()->test(1, 'array');

        // call request method
        $response = $this->request(self::NON_REFERENCED_CREDIT, $query);
        // if parameters are success
        if (isset($response[self::ACK]) && $response[self::ACK] == self::SUCCESS) {
            //  Get the transaction ID
            return $response[self::TRANSACTION_ID];
        }

        return $response;
    }
}
