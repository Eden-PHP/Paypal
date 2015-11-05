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
class Checkout extends Base
{
    /**
     * @const string SANDBOX_URL
     */
    const SANDBOX_URL = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=%s';

    /**
     * @const string LIVE_URL
     */
    const LIVE_URL = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=%s';

    /**
     * @const string SET_METHOD
     */
    const SET_METHOD = 'SetExpressCheckout';

    /**
     * @const string GET_METHOD
     */
    const GET_METHOD = 'GetExpressCheckoutDetails';

    /**
     * @const string DO_METHOD
     */
    const DO_METHOD  = 'DoExpressCheckoutPayment';

    /**
     * @const string DO_ADDRESS_VERIFY
     */
    const DO_ADDRESS_VERIFY = 'AddressVerify';

    /**
     * @const string CALL_BACK
     */
    const CALL_BACK = 'Callback';

    /**
     * @const string GET_BALANCE
     */
    const GET_BALANCE = 'GetBalance';

    /**
     * @const string MASS_PAYMENT
     */
    const MASS_PAYMENT = 'MassPay';

    /**
     * @const string GET_DETAIL
     */
    const GET_DETAIL = 'GetPalDetails';

    /**
     * @const string SUCCESS
     */
    const SUCCESS = 'Success';

    /**
     * @const string ACK
     */
    const ACK = 'ACK';

    /**
     * @const string TOKEN
     */
    const TOKEN = 'TOKEN';

    /**
     * @const string SALE
     */
    const SALE = 'Sale';

    /**
     * @const string ERROR
     */
    const ERROR = 'L_LONGMESSAGE0';

    /**
     * @const string RETURN_URL
     */
    const RETURN_URL = 'RETURNURL';

    /**
     * @const string CANCEL_URL
     */
    const CANCEL_URL = 'CANCELURL';

    /**
     * @const string TOTAL_AMOUNT
     */
    const TOTAL_AMOUNT = 'PAYMENTREQUEST_n_AMT';

    /**
     * @const string SHIPPING_AMOUNT
     */
    const SHIPPING_AMOUNT = 'PAYMENTREQUEST_n_SHIPPINGAMT';

    /**
     * @const string SHIPPING_DISCOUNT_AMOUNT
     */
    const SHIPPING_DISCOUNT_AMOUNT = 'PAYMENTREQUEST_n_SHIPDISCAMT';

    /**
     * @const string INSURANCE_AMOUNT
     */
    const INSURANCE_AMOUNT = 'PAYMENTREQUEST_n_INSURANCEAMT';

    /**
     * @const string HANDLING_TOTAL
     */
    const HANDLING_TOTAL = 'PAYMENTREQUEST_n_HANDLINGAMT';

    /**
     * @const string CURRENCY
     */
    const CURRENCY = 'PAYMENTREQUEST_n_CURRENCYCODE';

    /**
     * @const string TAX_AMOUNT
     */
    const TAX_AMOUNT = 'PAYMENTREQUEST_n_TAXAMT';

    /**
     * @const string DESCRIPTION
     */
    const DESCRIPTION = 'PAYMENTREQUEST_n_DESC';

    /**
     * @const string CUSTOM
     */
    const CUSTOM = 'PAYMENTREQUEST_n_CUSTOM';

    /**
     * @const string INVOICE_NUMBER
     */
    const INVOICE_NUMBER = 'PAYMENTREQUEST_n_INVNUM';

    /**
     * @const string NOTIFY_URL
     */
    const NOTIFY_URL = 'PAYMENTREQUEST_n_NOTIFYURL';

    /**
     * @const string MULTI_SHIPPING
     */
    const MULTI_SHIPPING = 'PAYMENTREQUEST_n_MULTISHIPPING';

    /**
     * @const string NOTE
     */
    const NOTE = 'PAYMENTREQUEST_n_NOTETEXT';

    /**
     * @const string SOFT_DESCRIPTOR
     */
    const SOFT_DESCRIPTOR = 'PAYMENTREQUEST_n_SOFTDESCRIPTOR';

    /**
     * @const string TRANSACTIONID
     */
    const TRANSACTIONID = 'PAYMENTREQUEST_n_TRANSACTIONID';

    /**
     * @const string ALLOWED_PAYMENT_METHOD
     */
    const ALLOWED_PAYMENT_METHOD = 'PAYMENTREQUEST_n_ALLOWEDPAYMENTMETHOD';

    /**
     * @const string PAYMENT_ACTION
     */
    const PAYMENT_ACTION = 'PAYMENTREQUEST_n_PAYMENTACTION';

    /**
     * @const string PAYMENT_REQUEST_ID
     */
    const PAYMENT_REQUEST_ID = 'PAYMENTREQUEST_n_PAYMENTREQUESTID';

    /**
     * @const string PAYMENT_TOTAL_AMOUNT
     */
    const PAYMENT_TOTAL_AMOUNT = 'PAYMENTREQUEST_n_ITEMAMT';

    /**
     * @const string SELLER_ID
     */
    const SELLER_ID = 'PAYMENTREQUEST_n_SELLERID';

    /**
     * @const string SELLER_USERNAME
     */
    const SELLER_USERNAME = 'PAYMENTREQUEST_n_SELLERUSERNAME';

    /**
     * @const string SELLER_REGISTRATION_DATE
     */
    const SELLER_REGISTRATION_DATE = 'PAYMENTREQUEST_n_SELLERREGISTRATIONDATE';

    /**
     * @const string ITEM_NAME
     */
    const ITEM_NAME = 'L_PAYMENTREQUEST_n_NAMEm';

    /**
     * @const string ITEM_DESCRIPTION
     */
    const ITEM_DESCRIPTION = 'L_PAYMENTREQUEST_n_DESCm';

    /**
     * @const string ITEM_AMOUNT
     */
    const ITEM_AMOUNT = 'L_PAYMENTREQUEST_n_AMTm';

    /**
     * @const string ITEM_NUMBER
     */
    const ITEM_NUMBER = 'L_PAYMENTREQUEST_n_NUMBERm';

    /**
     * @const string ITEM_QUANTITY
     */
    const ITEM_QUANTITY = 'L_PAYMENTREQUEST_n_QTYm';

    /**
     * @const string ITEM_TAX_AMOUNT
     */
    const ITEM_TAX_AMOUNT = 'L_PAYMENTREQUEST_n_TAXAMTm';

    /**
     * @const string ITEM_WEIGHT_VALUE
     */
    const ITEM_WEIGHT_VALUE = 'L_PAYMENTREQUEST_n_ITEMWEIGHTVALUEm';

    /**
     * @const string ITEM_WEIGHT_UNIT
     */
    const ITEM_WEIGHT_UNIT = 'L_PAYMENTREQUEST_n_ITEMWEIGHTUNITm';

    /**
     * @const string ITEM_LENGTH_VALUE
     */
    const ITEM_LENGTH_VALUE = 'L_PAYMENTREQUEST_n_ITEMLENGTHVALUEm';

    /**
     * @const string ITEM_LENGTH_UNIT
     */
    const ITEM_LENGTH_UNIT = 'L_PAYMENTREQUEST_n_ITEMLENGTHUNITm';

    /**
     * @const string ITEM_WIDTH_VALUE
     */
    const ITEM_WIDTH_VALUE = 'L_PAYMENTREQUEST_n_ITEMWIDTHVALUEm';

    /**
     * @const string ITEM_WIDTH_UNIT
     */
    const ITEM_WIDTH_UNIT = 'L_PAYMENTREQUEST_n_ITEMWIDTHVALUEm';

    /**
     * @const string ITEM_HEIGHT_VALUE
     */
    const ITEM_HEIGHT_VALUE = 'L_PAYMENTREQUEST_n_ITEMHEIGHTVALUEm';

    /**
     * @const string ITEM_HEIGHT_UNIT
     */
    const ITEM_HEIGHT_UNIT = 'L_PAYMENTREQUEST_n_ITEMHEIGHTUNITm';

    /**
     * @const string ITEM_URL
     */
    const ITEM_URL = 'L_PAYMENTREQUEST_n_ITEMURLm';

    /**
     * @const string ITEM_CATEGORY
     */
    const ITEM_CATEGORY = 'L_PAYMENTREQUEST_n_ITEMCATEGORYm';

    /**
     * @const string INSURANCE_OPTION_SELECTED
     */
    const INSURANCE_OPTION_SELECTED = 'INSURANCEOPTIONSELECTED';

    /**
     * @const string SHIPPING_OPTION_IS_DEFAULT
     */
    const SHIPPING_OPTION_IS_DEFAULT = 'SHIPPINGOPTIONISDEFAULT';

    /**
     * @const string SHIPPING_OPTION_AMOUNT
     */
    const SHIPPING_OPTION_AMOUNT = 'SHIPPINGOPTIONAMOUNT';

    /**
     * @const string SHIPPING_OPTION_NAME
     */
    const SHIPPING_OPTION_NAME = 'SHIPPINGOPTIONNAME';

    /**
     * @const string EMAIL
     */
    const EMAIL = 'EMAIL';

    /**
     * @const string STREET
     */
    const STREET = 'STREET';

    /**
     * @const string ZIP
     */
    const ZIP = 'ZIP';

    /**
     * @const string RETURN_CURRENCIES
     */
    const RETURN_CURRENCIES = 'RETURNALLCURRENCIES';

    /**
     * @const string EMAIL_SUBJECT
     */
    const EMAIL_SUBJECT = 'EMAILSUBJECT';

    /**
     * @const string SOLUTION_TYPE
     */
    const SOLUTION_TYPE = 'SOLUTIONTYPE';

    /**
     * @const string PAYER_ID
     */
    const PAYER_ID = 'PAYERID';

    /**
     * @var bool $callBack
     */
    protected $callBack = false;

    /**
     * @var int $currencies
     */
    protected $currencies = 0;

    /**
     * @var array $amount
     */
    protected $amount = array();
    
    /**
     * @var array $shippingAmount
     */
    protected $shippingAmount = array();
    
    /**
     * @var array $shippingDiscountAmount
     */
    protected $shippingDiscountAmount = array();
    
    /**
     * @var array $insuranceAmount
     */
    protected $insuranceAmount = array();
    
    /**
     * @var array $handlingAmount
     */
    protected $handlingAmount = array();
    
    /**
     * @var array $currency
     */
    protected $currency = array();
    
    /**
     * @var array $taxAmount
     */
    protected $taxAmount = array();
    
    /**
     * @var array $description
     */
    protected $description = array();
    
    /**
     * @var array $custom
     */
    protected $custom = array();
    
    /**
     * @var array $invoiceNumber
     */
    protected $invoiceNumber = array();
    
    /**
     * @var array $notifyUrl
     */
    protected $notifyUrl = array();

    /**
     * @var string|null $multiShipping
     */
    protected $multiShipping= null;
    
    /**
     * @var array $noteText
     */
    protected $noteText = array();
    
    /**
     * @var array $softDescriptor
     */
    protected $softDescriptor = array();
    
    /**
     * @var array $transactionId
     */
    protected $transactionId = array();
    
    /**
     * @var array $allowedPaymentMethod
     */
    protected $allowedPaymentMethod = array();
    
    /**
     * @var array $paymentAction
     */
    protected $paymentAction = array();
    
    /**
     * @var array $requestId
     */
    protected $requestId = array();
    
    /**
     * @var array $totalAmount
     */
    protected $totalAmount = array();

    /**
     * @var array $sellerId
     */
    protected $sellerId = array();
    
    /**
     * @var array $sellerUsername
     */
    protected $sellerUsername = array();

    /**
     * @var array $sellerRegistrationdate
     */
    protected $sellerRegistrationdate = array();

    /**
     * @var string|null $insuranceOptionSelected
     */
    protected $insuranceOptionSelected= null;

    /**
     * @var string|null $shippingOptionIsDefault
     */
    protected $shippingOptionIsDefault= null;

    /**
     * @var string|null $shippingOptionAmount
     */
    protected $shippingOptionAmount= null;

    /**
     * @var string|null $shippingOptionName
     */
    protected $shippingOptionName= null;

    /**
     * @var array $items
     */
    protected $items = array();

    /**
     * @var array $itemName
     */
    protected $itemName = array();

    /**
     * @var array $itemDescription
     */
    protected $itemDescription = array();

    /**
     * @var array $itemAmount
     */
    protected $itemAmount = array();

    /**
     * @var array $itemTotalAmount
     */
    protected $itemTotalAmount = array();

    /**
     * @var array $itemNumber
     */
    protected $itemNumber = array();

    /**
     * @var array $quantity
     */
    protected $quantity = array();

    /**
     * @var array $itemtTaxAmount
     */
    protected $itemtTaxAmount = array();

    /**
     * @var array $itemWeightValue
     */
    protected $itemWeightValue = array();

    /**
     * @var array $itemWeightUnit
     */
    protected $itemWeightUnit = array();

    /**
     * @var array $itemLengthValue
     */
    protected $itemLengthValue = array();

    /**
     * @var array $itemLengthUnit
     */
    protected $itemLengthUnit = array();

    /**
     * @var array $itemWidthValue
     */
    protected $itemWidthValue = array();

    /**
     * @var array $itemWidthUnit
     */
    protected $itemWidthUnit = array();

    /**
     * @var array $itemHeightValue
     */
    protected $itemHeightValue = array();

    /**
     * @var array $itemHeightUnit
     */
    protected $itemHeightUnit = array();

    /**
     * @var array $itemUrl
     */
    protected $itemUrl = array();

    /**
     * @var array $itemCategory
     */
    protected $itemCategory = array();

    /**
     * @var string|null $email
     */
    protected $email= null;

    /**
     * @var string|null $street
     */
    protected $street= null;

    /**
     * @var string|null $zip
     */
    protected $zip= null;

    /**
     * @var string|null $emailSubject
     */
    protected $emailSubject= null;

    /**
     * @var string $solutionType
     */
    protected $solutionType = 'Sole';

    /**
     * Construct Eden\Paypal\Checkout class
     *
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return void
     */
    public function __construct(
        $user,
        $password,
        $signature,
        $certificate,
        $live = false
    ) {
        parent::__construct($user, $password, $signature, $certificate, $live);

        $this->url  = self::SANDBOX_URL;
        if ($live) {
            $this->url = self::LIVE_URL;
        }
    }

    /**
     * Confirms whether a postal address and postal
     * code match those of the specified PayPal
     * account holder.
     *
     * @return array
     */
    public function checkAddress()
    {
        $query = array(
            self::EMAIL     => $this->email,
            self::STREET    => $this->street,
            self::ZIP       => $this->zip);

        return $this->request(self::DO_ADDRESS_VERIFY, $query);
    }

    /**
     * Makes a payment to one or more PayPal account holders.
     *
     * @return array
     */
    public function doMassPayment()
    {
        $query = array();
        $query = array_merge($query, $this->getQueries());

        return $this->request(self::MASS_PAYMENT, $query);
    }

    /**
     * Obtains the available balance for a PayPal account.
     *
     * @return array
     */
    public function getBalance()
    {
        //  Indicates whether to return all currencies.
        $query = array(self::RETURN_CURRENCIES  => $this->currencies);

        return $this->request(self::GET_BALANCE, $query);
    }

    /**
     * Obtains your Pal ID, which is the PayPal-assigned merchant
     * account number, and other information about your account.
     * You need the account number when working with dynamic
     * versions of PayPal buttons and logos.
     *
     * @return array
     */
    public function getDetail()
    {
        // call request method call back
        return $this->request(self::GET_DETAIL);
    }

    /**
     * Sends checkout information to paypal
     *
     * @param string* $return The Return URL
     * @param string* $cancel The Cancel URL
     *
     * @return array
     */
    public function checkout($return, $cancel)
    {
        // Argument Test
        Argument::i()
            // Argument 1 must be a string
            ->test(1, 'string')
            // Argument 2 must be a string
            ->test(2, 'string');

        $query = array(
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
            self::SOLUTION_TYPE => $this->solutionType,
            self::RETURN_URL => $return,
            self::CANCEL_URL => $cancel);

        $query = array_merge($query, $this->getQueries());
        $query = array_merge($query, $this->getItems());

        // call request method set express checkout
        $response = $this->request(self::SET_METHOD, $query, false);

        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            // fetch token
            // if callback is true
            if ($this->callBack) {
                $this->token = $response[self::TOKEN];
                return $this->getCallback();
            }
        }

        return $response;
    }

    /**
     * Set the amount of the item
     *
     * @param int|float* $payerId Amount of the item
     *
     * @return array
     */
    public function getTransactionId($payerId)
    {
        $this->payer = $payerId;
        if (!$this->token) {
            return null;
        }

        // Get checkout details, including buyer information,
        // call get express checkout method
        $checkoutDetails = $this->request(self::GET_METHOD, array(self::TOKEN => $this->token));

        $this->paymentAction[0] = self::SALE;

        $query = array(
           self::TOKEN => $this->token,
           self::PAYER_ID => $this->payer,
        );

        $query = array_merge($query, $this->getQueries());

        // call request method do express checckout
        $response = $this->request(self::DO_METHOD, $query);

        // If payment successful
        // Fetch the transaction ID
        return $response;
    }

    /**
     * Get Callback
     *
     * @return string
     */
    protected function getCallback()
    {
        // currency code
        $query = array(self::TOKEN => $this->token);
        $query = array_merge($query, $this->getQueries());

        // call request method call back
        return $this->request(self::CALL_BACK, $query);
    }

    /**
     * Set the amount of the item
     *
     * @param int|float* $amount Amount of the item
     * @param int        $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setTotalAmount($amount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->amount[$n] = $amount;

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
     * @param string $solutionType
     *
     * @return Eden\Paypal\Checkout
     */
    public function setSolutionType($solutionType = 'Sole')
    {
        // Argument 1 must be an string
        Argument::i()->test(1, 'string');

        $this->solutionType = $solutionType;

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
     * @param string* $currency Currency code
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setCurrency($currency, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->currency[$n] = $currency;

        return $this;
    }

    /**
     * Set sales tax.
     * Sum of tax for all items in this order.
     *
     * @param int|float* $amount tax amount
     * @param int        $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setTaxAmount($taxAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->taxAmount[$n] = $taxAmount;

        return $this;
    }

    /**
     * A free-form field for your own use.
     *
     * @param string* $custom
     * @param int     $n
     *
     * @return  Eden\Paypal\Checkout
     */
    public function setCustom($custom, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->custom[$n] = $custom;

        return $this;
    }

    /**
     * Your own invoice or tracking number
     *
     * @param string* $invoiceNumber
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setInvoice($invoiceNumber, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->invoiceNumber[$n] = $invoiceNumber;

        return $this;
    }

    /**
     * Your URL for receiving Instant Payment Notification (IPN)
     * about this transaction.
     *
     * @param string* $notifyUrl
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setNotifyUrl($notifyUrl, $n = 0)
    {
        Argument::i()
            ->test(1, 'url')
            ->test(2, 'int');

        $this->notifyUrl[$n] = $notifyUrl;

        return $this;
    }

    /**
     * The value 1 indicates that this payment is associated
     * with multiple shipping addresses.
     *
     * @param int* $multiShipping
     * @param int  $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setMultiShipping($multiShipping, $n = 0)
    {
        Argument::i()
            ->test(1, 'int')
            ->test(2, 'int');

        $this->multiShipping[$n] = $multiShipping;

        return $this;
    }

    /**
     * Note to the merchant.
     *
     * @param string* $noteText
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setNoteText($noteText, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->noteText[$n] = $noteText;

        return $this;
    }

    /**
     * A per transaction description of the payment that is passed
     * to the buyer's credit card statement.
     *
     * @param string* $softDescriptor
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setSoftDescriptor($softDescriptor, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->softDescriptor[$n] = $softDescriptor;

        return $this;
    }

    /**
     * Transaction identification number of the transaction that was created.
     *
     * @param string* $transactionId
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setTransactionId($transactionId, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->transactionId[$n] = $transactionId;

        return $this;
    }

    /**
     * Transaction identification number of the transaction that was created.
     *
     * @param string* $allowedPaymentMethod
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setAllowedPaymentMethod($allowedPaymentMethod, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->allowedPaymentMethod[$n] = $allowedPaymentMethod;

        return $this;
    }

    /**
     * How you want to obtain payment. When implementing parallel payments,
     * this field is required and must be set to Order. When implementing
     * digital goods, this field is required and must be set to Sale.
     *     Sale – This is a final sale for which you are requesting payment
     *         (default).
     *     Authorization – This payment is a basic authorization subject to
     *         settlement with PayPal Authorization and Capture.
     *     Order – This payment is an order authorization subject to settlement
     *         with PayPal Authorization and Capture.
     *
     * @param string* $paymentAction
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setPaymentAction($paymentAction, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->paymentAction[$n] = $paymentAction;

        return $this;
    }

    /**
     * Sum of cost of all items in this order.
     *
     * @param int|float* $totalAmount
     * @param int        $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setOrderAmount($totalAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->totalAmount[$n] = $totalAmount;

        return $this;
    }

    /**
     * A unique identifier of the specific payment request.
     *
     * @param string* $requestId
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setRequestId($requestId, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->requestId[$n] = $requestId;

        return $this;
    }

    /**
     * A unique identifier of the specific payment request.
     *
     * @param string* $sellerId
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setSellerId($sellerId, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->sellerId[$n] = $sellerId;

        return $this;
    }

    /**
     * Current name of the merchant or business at the marketplace site.
     *
     * @param string* $sellerUsername
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setSellerUsername($sellerUsername, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->sellerUsername[$n] = $sellerUsername;

        return $this;
    }

    /**
     * Date when the merchant registered with the marketplace.
     *
     * @param string* $sellerRegistrationdate
     * @param int     $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setSellerRegistrationdate($sellerRegistrationdate, $n = 0)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->sellerRegistrationdate[$n] = $sellerRegistrationdate;

        return $this;
    }

    /**
     * The option that the buyer chose for insurance.
     * Yes or No
     *
     * @param string* $insuranceOptionSelected
     *
     * @return Eden\Paypal\Checkout
     */
    public function setInsuranceOptionSelected($insuranceOptionSelected)
    {
        Argument::i()->test(1, 'string');

        $this->insuranceOptionSelected = $insuranceOptionSelected;

        return $this;
    }

    /**
     * Whether the buyer chose the default shipping option.
     * True or False
     *
     * @param bool* $shippingOptionIsDefault
     *
     * @return Eden\Paypal\Checkout
     */
    public function setShippingOptionIsDefault($shippingOptionIsDefault)
    {
        Argument::i()->test(1, 'bool');

        $this->shippingOptionIsDefault = $shippingOptionIsDefault;

        return $this;
    }

    /**
     * The shipping amount that the buyer chose.
     * Must have 2 decimal places.
     *
     * @param float* $shippingOptionAmount
     *
     * @return Eden\Paypal\Checkout
     */
    public function setShippingOptionAmount($shippingOptionAmount)
    {
        Argument::i()->test(1, 'float');

        $this->shippingOptionAmount = $shippingOptionAmount;

        return $this;
    }

    /**
     * The name of the shipping option, such as air or ground.
     *
     * @param string* $shippingOptionName
     *
     * @return Eden\Paypal\Checkout
     */
    public function setShippingOptionName($shippingOptionName)
    {
        Argument::i()->test(1, 'string');

        $this->shippingOptionName = $shippingOptionName;

        return $this;
    }

    /**
     * Set consumer email
     *
     * @param string* $email consumer email
     *
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
     * @param bool* $emailSubject
     *
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
     * Set shipping amount of the item
     *
     * @param int|float* $shippingAmount Shipping amount of the item
     * @param int        $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setShippingAmount($shippingAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->shippingAmount[$n] = $shippingAmount;

        return $this;
    }

    /**
     * Set shipping discount amount.
     *
     * @param int|float* $discountAmount
     * @param int        $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function setShippingDiscountAmount($discountAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->shippingDiscountAmount[$n] = $discountAmount;

        return $this;
    }

    /**
     * Set insurance amount
     *
     * @param int|float* $insuranceAmount
     * @param int        $n
     *
     * @return  Eden\Paypal\Checkout
     */
    public function setInsuranceAmount($insuranceAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->insuranceAmount[$n] = $insuranceAmount;

        return $this;
    }

    /**
     * Set handling total
     *
     * @param int|float* $handlingAmount
     * @param int        $n
     *
     * @return  Eden\Paypal\Checkout
     */
    public function setHandlingAmount($handlingAmount, $n = 0)
    {
        Argument::i()
            ->test(1, 'int', 'float')
            ->test(2, 'int');

        $this->handlingAmount[$n] = $handlingAmount;

        return $this;
    }

    /**
     * Set consumer street
     *
     * @param string* $street consumer street
     *
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
     * @param string* $token
     *
     * @return Eden\Paypal\Checkout
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get checkout Url
     *
     * @param string* $token
     *
     * @return string
     */
    public function getCheckoutUrl($token)
    {
        Argument::i()->test(1, 'string');

        return sprintf($this->url, urlencode($token));
    }

    /**
     * Set consumer zip code
     *
     * @param string* $zip consumer zip code
     *
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
     * Add item
     *
     * @param array* $item
     * @param int    $n
     *
     * @return Eden\Paypal\Checkout
     */
    public function addItem(array $item, $n = 0)
    {
        if (!isset($this->items[$n])) {
            $this->items[$n] = array();
        }

        Argument::i()
            ->test(1, 'array')
            ->test(2, 'int', 'null');

        array_push($this->items[$n], $item);

        return $this;
    }

    /**
     * get fields
     *
     * @param string* $fieldName
     * @param string* $data
     *
     * @return array
     */
    protected function getFields($fieldName, $data)
    {
        $fields = array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $field = $fieldName;
                $value = null;
                if (is_array($v)) {
                    foreach ($v as $kk => $vv) {
                        $field = $this->replaceNM($fieldName, $k, $kk);
                        $data = $vv;
                    }
                } else {
                    $field = $this->replaceNM($fieldName, $k);
                    $data = $v;
                }

                $fields[$field] = $data;
            }
        } else if (!is_null($data)) {
            $fields[$fieldName] = $data;
        }

        return $fields;
    }

    /**
     * get items
     *
     * @return array
     */
    protected function getItems()
    {
        $query = array();

        foreach ($this->items as $k => $payment) {
            foreach ($payment as $kk => $item) {
                if (isset($item['name'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_NAME, $k, $kk)
                                => $item['name']
                        )
                    );
                }

                if (isset($item['description'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_DESCRIPTION, $k, $kk)
                                => $item['description']
                        )
                    );
                }

                if (isset($item['amount'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_AMOUNT, $k, $kk)
                                => $item['amount']
                        )
                    );
                }

                if (isset($item['number'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_NUMBER, $k, $kk)
                                => $item['number']
                        )
                    );
                }

                if (isset($item['quantity'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_QUANTITY, $k, $kk)
                                => $item['quantity']
                        )
                    );
                }

                if (isset($item['tax_amount'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_TAX_AMOUNT, $k, $kk)
                                => $item['tax_amount']
                        )
                    );
                }

                if (isset($item['weight_value'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_WEIGHT_VALUE, $k, $kk)
                                => $item['weight_value']
                        )
                    );
                }

                if (isset($item['weight_unit'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_WEIGHT_UNIT, $k, $kk)
                                => $item['weight_unit']
                        )
                    );
                }

                if (isset($item['length_value'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_LENGTH_VALUE, $k, $kk)
                                => $item['length_value']
                        )
                    );
                }

                if (isset($item['length_unit'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_LENGTH_UNIT, $k, $kk)
                                => $item['length_unit']
                        )
                    );
                }

                if (isset($item['width_value'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_WIDTH_VALUE, $k, $kk)
                                => $item['width_value']
                        )
                    );
                }

                if (isset($item['width_unit'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_WEIGHT_UNIT, $k, $kk)
                                => $item['width_unit']
                        )
                    );
                }

                if (isset($item['height_value'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_HEIGHT_VALUE, $k, $kk)
                                => $item['height_value']
                        )
                    );
                }

                if (isset($item['height_unit'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_HEIGHT_UNIT, $k, $kk)
                                => $item['height_unit']
                        )
                    );
                }

                if (isset($item['url'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_URL, $k, $kk)
                                => $item['url']
                        )
                    );
                }

                if (isset($item['category'])) {
                    $query = array_merge(
                        $query,
                        array(
                            $this->replaceNM(self::ITEM_CATEGORY, $k, $kk)
                                => $item['category']
                        )
                    );
                }
            }
        }

        return $query;
    }

    /**
     * Change n and m to number
     *
     * @param string* $field
     * @param bool    $n
     * @param bool    $m
     *
     * @return string
     */
    protected function replaceNM($field, $n = false, $m = false)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int', 'null')
            ->test(3, 'int', 'null');

        if ($n !== false) {
            $field = str_replace('n', $n, $field);
        }

        if ($m !== false) {
            $field = str_replace('m', $m, $field);
        }

        return $field;
    }

    /**
     * build query
     *
     * @return array
     */
    protected function getQueries()
    {
        $query = array();

        $query = array_merge($query, $this->getFields(
            self::TOTAL_AMOUNT,
            $this->amount
        ));

        $query = array_merge($query, $this->getFields(
            self::SHIPPING_AMOUNT,
            $this->shippingAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::SHIPPING_DISCOUNT_AMOUNT,
            $this->shippingDiscountAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::INSURANCE_AMOUNT,
            $this->insuranceAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::HANDLING_TOTAL,
            $this->handlingAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::CURRENCY,
            $this->currency
        ));

        $query = array_merge($query, $this->getFields(
            self::TAX_AMOUNT,
            $this->taxAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::DESCRIPTION,
            $this->description
        ));

        $query = array_merge($query, $this->getFields(
            self::CUSTOM,
            $this->custom
        ));

        $query = array_merge($query, $this->getFields(
            self::INVOICE_NUMBER,
            $this->invoiceNumber
        ));

        $query = array_merge($query, $this->getFields(
            self::NOTIFY_URL,
            $this->notifyUrl
        ));

        $query = array_merge($query, $this->getFields(
            self::MULTI_SHIPPING,
            $this->multiShipping
        ));

        $query = array_merge($query, $this->getFields(
            self::NOTE,
            $this->noteText
        ));

        $query = array_merge($query, $this->getFields(
            self::SOFT_DESCRIPTOR,
            $this->softDescriptor
        ));

        $query = array_merge($query, $this->getFields(
            self::TRANSACTIONID,
            $this->transactionId
        ));

        $query = array_merge($query, $this->getFields(
            self::ALLOWED_PAYMENT_METHOD,
            $this->allowedPaymentMethod
        ));

        $query = array_merge($query, $this->getFields(
            self::PAYMENT_ACTION,
            $this->paymentAction
        ));

        $query = array_merge($query, $this->getFields(
            self::PAYMENT_REQUEST_ID,
            $this->requestId
        ));

        $query = array_merge($query, $this->getFields(
            self::PAYMENT_TOTAL_AMOUNT,
            $this->totalAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_ID,
            $this->sellerId
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_USERNAME,
            $this->sellerUsername
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_REGISTRATION_DATE,
            $this->sellerRegistrationdate
        ));

        $query = array_merge($query, $this->getFields(
            self::INSURANCE_OPTION_SELECTED,
            $this->insuranceOptionSelected
        ));

        $query = array_merge($query, $this->getFields(
            self::SHIPPING_OPTION_IS_DEFAULT,
            $this->shippingOptionIsDefault
        ));

        $query = array_merge($query, $this->getFields(
            self::SHIPPING_OPTION_AMOUNT,
            $this->shippingOptionAmount
        ));

        $query = array_merge($query, $this->getFields(
            self::SHIPPING_OPTION_NAME,
            $this->shippingOptionName
        ));

        $query = array_merge($query, $this->getFields(
            self::EMAIL,
            $this->email
        ));

        $query = array_merge($query, $this->getFields(
            self::STREET,
            $this->street
        ));

        $query = array_merge($query, $this->getFields(
            self::ZIP,
            $this->zip
        ));

        $query = array_merge($query, $this->getFields(
            self::EMAIL_SUBJECT,
            $this->emailSubject
        ));

        $query = array_merge($query, $this->getFields(
            self::SOLUTION_TYPE,
            $this->solutionType
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_ID,
            $this->sellerId
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_USERNAME,
            $this->sellerUsername
        ));

        $query = array_merge($query, $this->getFields(
            self::SELLER_REGISTRATION_DATE,
            $this->sellerRegistrationdate
        ));

        return $query;
    }
}
