<?php // -->
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
class Direct extends Base
{
    /**
     * @const string DIRECT_PAYMENT
     */
    const DIRECT_PAYMENT = 'DoDirectPayment';

    /**
     * @const string NON_REFERENCED_CREDIT
     */
    const NON_REFERENCED_CREDIT = 'DoNonReferencedCredit';

    /**
     * @const string TRANSACTION_ID
     */
    const TRANSACTION_ID = 'TRANSACTIONID';

    /**
     * @const string SALE
     */
    const SALE = 'sale';

    /**
     * @const string ACK
     */
    const ACK = 'ACK';

    /**
     * @const string SUCCESS
     */
    const SUCCESS = 'Success';

    /**
     * @const string REMOTE_ADDRESS
     */
    const REMOTE_ADDRESS = 'REMOTE_ADDR';

    /**
     * @const string IP_ADDRESS
     */
    const IP_ADDRESS = 'IPADDRESS';

    /**
     * @const string PAYMENT_ACTION
     */
    const PAYMENT_ACTION = 'PAYMENTACTION';

    /**
     * @const string CARD_TYPE
     */
    const CARD_TYPE = 'CREDITCARDTYPE';

    /**
     * @const string CARD_NUMBER
     */
    const CARD_NUMBER = 'ACCT';

    /**
     * @const string EXPIRATION_DATE
     */
    const EXPIRATION_DATE = 'EXPDATE'   ;

    /**
     * @const string CVV
     */
    const CVV = 'CVV2';

    /**
     * @const string FIRST_NAME
     */
    const FIRST_NAME = 'FIRSTNAME';

    /**
     * @const string LAST_NAME
     */
    const LAST_NAME = 'LASTNAME';

    /**
     * @const string EMAIL
     */
    const EMAIL = 'EMAIL';

    /**
     * @const string COUNTRY_CODE
     */
    const COUNTRY_CODE = 'COUNTRYCODE';

    /**
     * @const string STATE
     */
    const STATE = 'STATE';

    /**
     * @const string CITY
     */
    const CITY = 'CITY';

    /**
     * @const string STREET
     */
    const STREET = 'STREET';

    /**
     * @const string ZIP
     */
    const ZIP = 'ZIP';

    /**
     * @const string AMOUNT
     */
    const AMOUNT = 'AMT';

    /**
     * @const string CURRENCY
     */
    const CURRENCY = 'CURRENCYCODE';

    /**
     * @var bool $nonReferencedCredit
     */
    protected $nonReferencedCredit = false;

    /**
     * @var string|null $profileId
     */
    protected $profileId= null;

    /**
     * @var string|null $cardType
     */
    protected $cardType= null;

    /**
     * @var string|null $cardNumber
     */
    protected $cardNumber= null;

    /**
     * @var string|null $expirationDate
     */
    protected $expirationDate= null;

    /**
     * @var string|null $cvv2
     */
    protected $cvv2= null;

    /**
     * @var string|null $firstName
     */
    protected $firstName= null;

    /**
     * @var string|null $lastName
     */
    protected $lastName= null;

    /**
     * @var string|null $email
     */
    protected $email= null;

    /**
     * @var string|null $countryCode
     */
    protected $countryCode= null;

    /**
     * @var string|null $state
     */
    protected $state= null;

    /**
     * @var string|null $city
     */
    protected $city= null;

    /**
     * @var string|null $street
     */
    protected $street= null;

    /**
     * @var string|null $zip
     */
    protected $zip= null;

    /**
     * @var string|null $amout
     */
    protected $amout= null;

    /**
     * @var string|null $currency
     */
    protected $currency= null;

    /**
     * Process a credit card direct payment.
     * Contact PayPal to use DoNonReferencedCredit
     * API operation, in most cases, you should use the
     * RefundTransaction API operation instead.
     *
     * @return string
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
     * @param int|float* $amount Item amount
     *
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
     * @param string* $cardNumber Credit card number
     *
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
     * @param string* $cardType Credit card type
     *
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
     * @param string* $city City
     *
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
     * @param string* $countryCode Country Code
     *
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
     * @param string* $currency Currency code
     *
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
     * @param string* $cvv2 3 - digit cvv number
     *
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
     * @param string* $email Email address
     *
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
     * @param string* $expirationDate Credit card expiration date
     *
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
     * @param string* $firstName First name
     *
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
     * @param string* $lastName Last name
     *
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
     * @param string* $state State
     *
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
     * @param string* $street Street
     *
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
     * @param string* $zip Zip code
     *
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
     * @param array* $query
     *
     * @return number
     */
    protected function setDirectPayment($query)
    {
        // Argument 1 must be an array
        Argument::i()->test(1, 'array');

        // do direct payment
        $response = $this->request(self::DIRECT_PAYMENT, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            //  Get the transaction ID
            return $response[self::TRANSACTION_ID];
        }

        return $response;
    }

    /**
     * Set non-referenced Credit
     *
     * @param array|string* $query
     *
     * @return number
     */
    protected function setNonReferencedCredit($query)
    {
        // Argument 1 must be an array
        Argument::i()->test(1, 'array');

        // call request method
        $response = $this->request(self::NON_REFERENCED_CREDIT, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            //  Get the transaction ID
            return $response[self::TRANSACTION_ID];
        }

        return $response;
    }
}
