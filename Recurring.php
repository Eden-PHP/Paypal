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
 * Paypal Website Payments Pro - Recurring Payment
 *
 * @package Eden
 * @category Paypal
 * @author Airon Paul Dumael airon.dumael@gmail.com
 */
class Recurring extends Base
{
    const RECURRING_PAYMENT = 'CreateRecurringPaymentsProfile';
    const GET_DETAIL = 'GetRecurringPaymentsProfileDetails';
    const MANAGE_STATUS = 'ManageRecurringPaymentsProfileStatus';
    const BILL_AMOUNT = 'BillOutstandingAmount';
    const PROFILE_ID = 'PROFILEID';

    const SALE = 'sale';
    const ACK = 'ACK';
    const SUCCESS = 'Success';
    const ERROR = 'L_LONGMESSAGE0';
    const REMOTE_ADDRESS = 'REMOTE_ADDR';
    const IP_ADDRESS = 'IPADDRESS';
    const PAYMENT_ACTION = 'PAYMENTACTION';

    const DAY = 'Day';
    const WEEK = 'Week';
    const SEMI_MONTH = 'SemiMonth';
    const MONTH = 'Month';
    const YEAR = 'Year';
    const CANCEL = 'Cancel';
    const SUSPEND = 'Suspend';
    const REACTIVATE = 'Reactivate';

    const CARD_TYPE = 'CREDITCARDTYPE';
    const CARD_NUMBER = 'ACCT';
    const EXPIRATION_DATE = 'EXPDATE';
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
    const DESCRIPTION = 'DESC';
    const START_DATE = 'PROFILESTARTDATE';
    const BILLING_PERIOD = 'BILLINGPERIOD';
    const BILLING_FREQUENCY = 'BILLINGFREQUENCY';


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
    protected $action = null;
    protected $note = null;

    /**
     * The action to be performed to the
     * recurring payments profile set
     * to Cancel
     *
     * @return Eden\Paypal\Recurring
     */
    public function cancel()
    {
        $this->action = self::CANCEL;
        return $this;
    }

    /**
     * Bills the buyer for the outstanding balance
     * associated with a recurring payments profile..
     *
     * @return string
     */
    public function getBilling()
    {
        //populate fields
        $query = array(
            // profile id of consumer
            self::PROFILE_ID    => $this->profileId,
            // outstading amount balance
            self::AMOUNT        => $this->amount,
            // the reason for the change in status
            self::NOTE            => $this->note);
        //call request method
        $response = $this->request(self::BILL_AMOUNT, $query);

        return $response;
    }

    /**
     * Create a recurring payments profile using direct payment
     * associated with a debit or credit card.
     *
     * @return string
     */
    public function getResponse()
    {
        //populate fields
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
            // amount of the recurring payment
            self::AMOUNT => $this->amount,
            // currency code, default is USD
            self::CURRENCY => $this->currency,
            // description of recurring payment
            self::DESCRIPTION => $this->description,
            // start date of the recurring billing agreement
            self::START_DATE => date('Y-m-d H:i:s'),
            // the unit to be used to calculate the billing cycle
            self::BILLING_PERIOD => $this->billingPeriod,
            // billing periods that make up the billing cycle.
            self::BILLING_FREQUENCY => $this->billingFrequency);
        // call request method
        $response = $this->request(self::RECURRING_PAYMENT, $query);
        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            // Get the profile Id
            $this->profileId = $response[self::PROFILE_ID];
            return $this->getDetails();
        }
        return $response;
    }

    /**
     * Cancels, suspends, or reactivates a recurring
     * payments profile.
     *
     * @return string
     */
    public function getStatus()
    {
        // populate fields
        $query = array(
            // profile id of consumer
            self::PROFILE_ID => $this->profileId,
            // valid value are Cancel, Suspend and Reactivate
            self::ACTION => $this->action,
            // the reason for the change in status
            self::NOTE => $this->note);
        // call request method
        $response = $this->request(self::MANAGE_STATUS, $query);

        return $response;
    }

    /**
     * The action to be performed to the
     * recurring payments profile set
     * to Reactivate
     *
     * @return Eden\Paypal\Recurring
     */
    public function reactivate()
    {
        $this->action = self::REACTIVATE;

        return $this;
    }

    /**
     * Set item amount
     *
     * @param integer or float        Item amount
     * @return Eden\Paypal\Recurring
     */
    public function setAmount($amount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'int', 'float');

        $this->amount = $amount;

        return $this;
    }

    /**
     * Set the billing frequency
     *
     * @param integer        Billing frequency
     * @return Eden\Paypal\Recurring
     */
    public function setBillingFrequency($billingFrequency)
    {
        // Argument 1 must be an integer
        Argument::i()->test(1, 'int');

        $this->billingFrequency = $billingFrequency;

        return $this;
    }
    /**
     * Set credit card number
     *
     * @param string        Credit card number
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
     */
    public function setCvv2($cvv2)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->cvv2 = $cvv2;

        return $this;
    }

    /**
     * Set unit to be used to calculate the billing cycle
     * to Day
     *
     * @return Eden\Paypal\Recurring
     */
    public function setDay()
    {
        $this->billingPeriod = self::DAY;

        return $this;
    }

    /**
     * Set item description
     *
     * @param string        Item description
     * @return Eden\Paypal\Recurring
     */
    public function setDescription($description)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->description = $description;

        return $this;
    }

    /**
     * Set cardholder email address
     *
     * @param string        Email address
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
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
     * @return Eden\Paypal\Recurring
     */
    public function setLastName($lastName)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Set unit to be used to calculate the billing cycle
     * to Month
     *
     * @return Eden\Paypal\Recurring
     */
    public function setMonth()
    {
        $this->billingPeriod = self::MONTH;

        return $this;
    }

    /**
     * Set reason for the change in status
     *
     * @param string    The reason for the change in status
     * @return Eden\Paypal\Recurring
     */
    public function setNote($note)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->note = $note;

        return $this;
    }

    /**
     * Set Profile Id
     *
     * @param string    a valid profile id
     * @return Eden\Paypal\Recurring
     */
    public function setProfileId($profileId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->profileId = $profileId;

        return $this;
    }

    /**
     * Set unit to be used to calculate the billing cycle
     * to SemiMonth
     *
     * @return Eden\Paypal\Recurring
     */
    public function setSemiMonth()
    {
        $this->billingPeriod = self::SEMI_MONTH;

        return $this;
    }

    /**
     * Set cardholder state
     *
     * @param string        State
     * @return Eden\Paypal\Recurring
     */
    public function setState($state)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->state = $state;

        return $this;
    }

    /**
     * Set to manage profile status
     *
     * @param boolean
     * @return Eden\Paypal\Recurring
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set cardholder street
     *
     * @param string        Street
     * @return Eden\Paypal\Recurring
     */
    public function setStreet($street)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->street = $street;

        return $this;
    }

    /**
     * Set unit to be used to calculate the billing cycle
     * to Week
     *
     * @return Eden\Paypal\Recurring
     */
    public function setWeek()
    {
        $this->billingPeriod = self::WEEK;

        return $this;
    }

    /**
     * Set unit to be used to calculate the billing cycle
     * to Year
     *
     * @return Eden\Paypal\Recurring
     */
    public function setYear()
    {
        $this->billingPeriod = self::YEAR;

        return $this;
    }

    /**
     * Set cardholder zip code
     *
     * @param string        Zip code
     * @return Eden\Paypal\Recurring
     */
    public function setZip($zip)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->zip = $zip;

        return $this;
    }

    /**
     * The action to be performed to the
     * recurring payments profile set
     * to Suspend
     *
     * @return Eden\Paypal\Recurring
     */
    public function suspend()
    {
        $this->action = self::SUSPEND;

        return $this;
    }

    /**
     * Get Details
     *
     * @return Eden\Paypal\Recurring
     */
    protected function getDetails()
    {
        // populate fields
        // profile id of consumer
        $query = array(self::PROFILE_ID => $this->profileId);
        // call request method
        $response = $this->request(self::GET_DETAIL, $query);

        return $response;
    }
}
