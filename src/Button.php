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
class Button extends Base
{
    /**
     * @const string SEARCH
     */
    const SEARCH = 'BMButtonSearch';

    /**
     * @const string SET_BUTTON
     */
    const SET_BUTTON = 'BMCreateButton';

    /**
     * @const string GET_BUTTON
     */
    const GET_BUTTON = 'BMGetButtonDetails';

    /**
     * @const string GET_INVENTORY
     */
    const GET_INVENTORY = 'BMGetInventory';

    /**
     * @const string REMOVE_BUTTON
     */
    const REMOVE_BUTTON = 'BMManageButtonStatus';

    /**
     * @const string UPDATE_BUTTON
     */
    const UPDATE_BUTTON = 'BMUpdateButton';

    /**
     * @const string BUTTON_ID
     */
    const BUTTON_ID  = 'HOSTEDBUTTONID';

    /**
     * @const string REMOVE
     */
    const REMOVE = 'DELETE';

    /**
     * @const string OPTION_NAME
     */
    const OPTION_NAME = 'OPTIONnNAME';

    /**
     * @const string OPTION_SELECT
     */
    const OPTION_SELECT = 'L_OPTIONnSELECTx';

    /**
     * @const string OPTION_PRICE
     */
    const OPTION_PRICE = 'L_OPTION0PRICEx';

    /**
     * @const string OPTION_TYPE
     */
    const OPTION_TYPE = 'OPTIONnTYPE';

    /**
     * @const string BILLING_PERIOD
     */
    const BILLING_PERIOD = 'L_OPTIONnBILLINGPERIODx';

    /**
     * @const string BILLING_FREQUENCY
     */
    const BILLING_FREQUENCY = 'L_OPTIONnBILLINGPFREQUENCYx';

    /**
     * @const string BILING_TOTAL
     */
    const BILING_TOTAL = 'L_OPTIONnTOTALBILLINGCYCLESx';

    /**
     * @const string OPTION_AMOUNT
     */
    const OPTION_AMOUNT = 'L_OPTIONnAMOUNTx';

    /**
     * @const string SHIPPING_AMOUNT
     */
    const SHIPPING_AMOUNT = 'L_OPTIONnSHIPPINGAMOUNTx';

    /**
     * @const string TAX_AMOUNT
     */
    const TAX_AMOUNT = 'L_OPTIONnTAXAMOUNTx';

    /**
     * @const string START
     */
    const START = 'STARTDATE';

    /**
     * @const string END
     */
    const END = 'ENDDATE';

    /**
     * @const string BUY_NOW
     */
    const BUY_NOW = 'BUYNOW';

    /**
     * @const string CART
     */
    const CART = 'CART';

    /**
     * @const string GIFT_CERTIFICATE
     */
    const GIFT_CERTIFICATE = 'GIFTCERTIFICATE';

    /**
     * @const string SUBSCRIBE
     */
    const SUBSCRIBE = 'SUBSCRIBE';

    /**
     * @const string DONATE
     */
    const DONATE = 'DONATE';

    /**
     * @const string UNSUBSCRIBE
     */
    const UNSUBSCRIBE = 'UNSUBSCRIBE';

    /**
     * @const string VIEW_CART
     */
    const VIEW_CART = 'VIEWCART';

    /**
     * @const string PAYMENT_PLAN
     */
    const PAYMENT_PLAN = 'PAYMENTPLAN';

    /**
     * @const string AUTOBILLING
     */
    const AUTOBILLING = 'AUTOBILLING';

    /**
     * @const string PAYMENT
     */
    const PAYMENT = 'PAYMENT';

    /**
     * @var string|null $buttonId
     */
    protected $buttonId = null;

    /**
     * @var string|null $start
     */
    protected $start = null;

    /**
     * @var string|null $end
     */
    protected $end = null;

    /**
     * @var string|null $buttonType
     */
    protected $buttonType = null;

    /**
     * @var string|null $optionName
     */
    protected $optionName = null;

    /**
     * @var string|null $optionSelect
     */
    protected $optionSelect = null;

    /**
     * @var string|null $optionPrice
     */
    protected $optionPrice = null;

    /**
     * @var string|null $optionType
     */
    protected $optionType = null;

    /**
     * @var string|null $billingPeriod
     */
    protected $billingPeriod = null;

    /**
     * @var string|null $billingFrequency
     */
    protected $billingFrequency = null;

    /**
     * @var string|null $billingTotal
     */
    protected $billingTotal = null;

    /**
     * @var string|null $optionAmount
     */
    protected $optionAmount = null;

    /**
     * @var string|null $shippingAmount
     */
    protected $shippingAmount = null;

    /**
     * @var string|null $taxAmount
     */
    protected $taxAmount = null;

    /**
     * Initiates the creation of a billing agreement.
     *
     * @return string
     */
    public function getButton()
    {
        // populate fields
        $query = array(
            // The kind of button you want to create.
            self::BUTTON_TYPE => $this->buttonType,
            // The menu name
            self::OPTION_NAME => $this->name,
            // The menu item’s name
            self::OPTION_SELECT => $this->select,
            // The price associated with the first menu item
            self::OPTION_PRICE => $this->price,
            // The installment option type for an OPTIONnNAME
            self::OPTION_TYPE => $this->type,
            // The installment cycle unit
            self::BILLING_PERIOD => $this->billingPeriod,
            // The installment cycle frequency in units
            self::BILLING_FREQUENCY => $this->billingFrequency,
            // The total number of billing cycles,
            self::BILLING_TOTAL => $this->billingTotal,
            // The base amount to bill for the cycle.
            self::OPTION_AMOUNT => $this->optionAmount,
            // The shipping amount to bill for the cycle
            self::SHIPPING_AMOUNT => $this->shippingAmount,
            // The tax amount to bill for the cycle
            self::TAX_AMOUNT => $this->taxAmount);

        // call request method
        $response = $this->request(self::SET_BUTTON, $query);
        // if parameters are success
        if (isset($response[self::BUTTON_ID])) {
            //  Get the button ID
            $this->buttonId = $response[self::BUTTON_ID];
            // call get button detail method
            return $this->request(self::GET_BUTTON, $query);
        }

        return $response;
    }

    /**
     * Determine the inventory levels and other
     * inventory-related information for a button
     * and menu items associated with the button.
     * Typically, you call BMGetInventory to obtain
     * field values before calling BMSetInventory
     * to change the inventory levels.
     *
     * @return string
     */
    public function getInventory()
    {
        // populate fields
        $query = array(self::BUTTON_ID => $this->buttonId);
        // call request method
        $resposne =  $this->request(self::GET_INVENTORY, $query);

        return $response;
    }

    /**
     * Change the status of a hosted button.
     * Currently, you can only delete a button.
     *
     * @return string
     */
    public function remove()
    {
        // populate fields
        $query = array(
            // The Hosted Button Id
            self::BUTTON_ID => $this->buttonId,
            // Delete the button
            self::STATUS => self::REMOVE);
        // call request method
        $resposne =  $this->request(self::REMOVE_BUTTON, $query);

        return $response;
    }

    /**
     * Obtain a list of your hosted Website
     * Payments Standard buttons.
     *
     * @return string
     */
    public function search()
    {
        // populate fields
        $query = array(
            // Starting date for the search.
            self::START => $this->start,
            // Ending date for the search.
            self::END => $this->end);
        // call request method
        return $this->request(self::SEARCH, $query);
    }

    /**
     * The base amount to bill for the cycle.
     *
     * @param string* $amount
     *
     * @return Eden\Paypal\Button
     */
    public function setAmount($amount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->amount = $amount;
        return $this;
    }

    /**
     * The installment cycle frequency in units,
     * e.g. if the billing frequency is 2 and the
     * billing period is Month, the billing cycle
     * is every 2 months. The default billing
     * frequency is 1.
     *
     * @param string* $billingFrequency
     *
     * @return Eden\Paypal\Button
     */
    public function setBillingFrequency($billingFrequency)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'int');

        $this->billingFrequency = $billingFrequency;
        return $this;
    }

    /**
     * Valid values are
     * NoBillingPeriodType - None (default)
     * Day
     * Week
     * SemiMonth
     * Month
     * Year
     *
     * @param string* $billingPeriod
     *
     * @return Eden\Paypal\Button
     */
    public function setBillingPeriod($billingPeriod)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->billingPeriod = $billingPeriod;
        return $this;
    }

    /**
     * The total number of billing cycles, regardless of
     * the duration of a cycle; 1 is the default
     *
     * @param string* $billingTotal
     *
     * @return Eden\Paypal\Button
     */
    public function setBillingTotal($billingTotal)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'int');

        $this->billingTotal = $billingTotal;
        return $this;
    }

    /**
     * Set hosted button id
     *
     * @param string* $setbuttonId The hosted button id
     *
     * @return Eden\Paypal\Button
     */
    public function setButtonId($setbuttonId)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->setbuttonId = $setbuttonId;
        return $this;
    }

    /**
     * Ending date for the search.
     * The value must be in UTC/GMT format
     *
     * @param string* $end
     *
     * @return Eden\Paypal\Button
     */
    public function setEndDate($end)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $date = strtotime($end);
        $this->end = gmdate('Y-m-d\TH:i:s\Z', $date);
        return $this;
    }

    /**
     * It is one or more variables, in which n is a
     * digit between 0 and 4, inclusive, for hosted
     * buttons; otherwise, it is a digit between 0
     * and 9, inclusive
     *
     * @param string* $name
     *
     * @return Eden\Paypal\Button
     */
    public function setName($name)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->name = $name;
        return $this;
    }

    /**
     * It is a list of variables for each OPTIONnNAME,
     * in which x is a digit between 0 and 9, inclusive
     *
     * If you specify a price, you cannot set
     * a button variable to amount.
     *
     * @param string* $optionPrice
     *
     * @return Eden\Paypal\Button
     */
    public function setOptionPrice($optionPrice)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->optionPrice = $optionPrice;
        return $this;
    }

    /**
     * It is a list of variables for each OPTIONnNAME,
     * in which x is a digit between 0 and 9, inclusive
     *
     * @param string* $optionSelect
     *
     * @return Eden\Paypal\Button
     */
    public function setOptionSelect($optionSelect)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->optionSelect = $optionSelect;
        return $this;
    }

    /**
     * The shipping amount to bill for the cycle,
     * in addition to the base amount.
     *
     * @param string* $shippingAmount
     *
     * @return Eden\Paypal\Button
     */
    public function setShippingAmount($shippingAmount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->shippingAmount = $shippingAmount;
        return $this;
    }

    /**
     * Starting date for the search.
     * The value must be in UTC/GMT format
     *
     * @param string* $start
     *
     * @return Eden\Paypal\Button
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
     * The tax amount to bill for the cycle,
     * in addition to the base amount.
     *
     * @param string* $taxAmount
     *
     * @return Eden\Paypal\Button
     */
    public function setTaxAmount($taxAmount)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * Set button type to Autobilling
     *
     * @return Eden\Paypal\Button
     */
    public function setToAutobilling()
    {
        $this->buttonType = self::AUTOBILLING;
        return $this;
    }

    /**
     * Set button type to buy now
     *
     * @return Eden\Paypal\Button
     */
    public function setToBuyNow()
    {
        $this->buttonType = self::BUY_NOW;
        return $this;
    }

    /**
     * Set button type to CART
     *
     * @return Eden\Paypal\Button
     */
    public function setToCart()
    {
        $this->buttonType = self::CART;
        return $this;
    }

    /**
     * Set button type to Donate
     *
     * @return Eden\Paypal\Button
     */
    public function setToDonate()
    {
        $this->buttonType = self::DONATE;
        return $this;
    }

    /**
     * Set button type to Gift Certificate
     *
     * @return Eden\Paypal\Button
     */
    public function setToGiftCertificate()
    {
        $this->buttonType = self::GIFT_CERTIFICATE;
        return $this;
    }

    /**
     * Set button type to Payment
     *
     * @return Eden\Paypal\Button
     */
    public function setToPayment()
    {
        $this->buttonType = self::PAYMENT;
        return $this;
    }

    /**
     * Set button type to Payment Plan
     *
     * @return Eden\Paypal\Button
     */
    public function setToPaymentPlan()
    {
        $this->buttonType = self::PAYMENT_PLAN;
        return $this;
    }

    /**
     * Set button type to Subscribe
     *
     * @return Eden\Paypal\Button
     */
    public function setToSubscribe()
    {
        $this->buttonType = self::SUBSCRIBE;
        return $this;
    }

    /**
     * Set button type to UnSubscribe
     *
     * @return Eden\Paypal\Button
     */
    public function setToUnSubscribe()
    {
        $this->buttonType = self::UNSUBSCRIBE;
        return $this;
    }

    /**
     * Set button type to View Cart
     *
     * @return Eden\Paypal\Button
     */
    public function setToViewCart()
    {
        $this->buttonType = self::VIEW_CART;
        return $this;
    }

    /**
     * Valid values are
     * FULL        - Payment in full
     * VARIABLE - Variable installments
     * EMI        - Equal installments
     *
     * @param string
     * @return Eden\Paypal\Button
     */
    public function setType()
    {
        $this->type = $tType;
        return $this;
    }

    /**
     * Valid values are
     * FULL        - Payment in full
     * VARIABLE - Variable installments
     * EMI        - Equal installments
     *
     * @return Eden\Paypal\Button
     */
    public function setTypeFull()
    {
        $this->optionType = 'FULL';
        return $this;
    }

    /**
     * Updates the an agreeement
     *
     * @return string
     */
    public function update()
    {
        // populate fields
        $query = array(
            // The Hosted Button Id
            self::BUTTON_ID  => $this->buttonId,
            // The kind of button you want to create.
            self::BUTTON_TYPE => $this->buttonType,
            // The menu name
            self::OPTION_NAME => $this->optionName,
            // The menu item’s name
            self::OPTION_SELECT => $this->optionSelect,
            // The price associated with the first menu item
            self::OPTION_PRICE => $this->optionPrice,
            // he installment option type for an OPTIONnNAME
            self::OPTION_TYPE => $this->optionType,
            // The installment cycle unit
            self::BILLING_PERIOD => $this->billingPeriod,
            // The installment cycle frequency in units
            self::BILLING_FREQUENCY => $this->billingFrequency,
            // The total number of billing cycles,
            self::BILLING_TOTAL => $this->billingTotal,
            // The base amount to bill for the cycle.
            self::OPTION_AMOUNT => $this->amount,
            // The shipping amount to bill for the cycle
            self::SHIPPING_AMOUNT => $this->shippingAmount,
            // The tax amount to bill for the cycle
            self::TAX_AMOUNT => $this->taxAmount);

        // call request method
        $response = $this->request(self::UPDATE, $query);
        // if parameters are success
        if (isset($response[self::BUTTON_ID])) {
            // Get the button ID
            $this->buttonId =  $response[self::BUTTON_ID];
            // call get button detail method
            return $this->getButton;
        }

        return $response;
    }
}
