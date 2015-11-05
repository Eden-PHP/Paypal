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
 * Paypal Website Payments Pro - Billing Agreement
 *
 * @vendor   Eden
 * @package  Paypal
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @author   Airon Paul Dumael <airon.dumael@gmail.com>
 * @standard PSR-2
 */
class Billing extends Base
{
    /**
     * @const string SET_AGREEMENT
     */
    const SET_AGREEMENT = 'SetCustomerBillingAgreement';

    /**
     * @const string GET_AGREEMENT
     */
    const GET_AGREEMENT = 'GetBillingAgreementCustomerDetails';

    /**
     * @const string TOKEN
     */
    const TOKEN = 'TOKEN';

    /**
     * @const string RETURN_URL
     */
    const RETURN_URL = 'RETURNURL';

    /**
     * @const string CANCEL_URL
     */
    const CANCEL_URL = 'CANCELURL';

    /**
     * @const string ANY
     */
    const ANY = 'Any';

    /**
     * @const string INSTANT_ONLY
     */
    const INSTANT_ONLY = 'InstantOnly';

    /**
     * @const string ACK
     */
    const ACK = 'ACK';

    /**
     * @const string SUCCESS
     */
    const SUCCESS = 'Success';

    /**
     * @const string BILLING_TYPE
     */
    const BILLING_TYPE = 'L_BILLINGTYPEn';

    /**
     * @const string BILLING_DESC
     */
    const BILLING_DESC = 'L_BILLINGAGREEMENTDESCRIPTIONn';

    /**
     * @const string PAYMENT_TYPE
     */
    const PAYMENT_TYPE = 'L_PAYMENTTYPEn';

    /**
     * @const string AGREEMENT_CUSTOM
     */
    const AGREEMENT_CUSTOM = 'L_BILLINGAGREEMENTCUSTOMn';

    /**
     * @const string AMOUNT
     */
    const AMOUNT = 'AMT';

    /**
     * @var string|null $token
     */
    protected $token = null;

    /**
     * @var string|null $amount
     */
    protected $amout = null;

    /**
     * @var string|null $currency
     */
    protected $currency = null;

    /**
     * @var string|null $completeType
     */
    protected $completeType = null;

    /**
     * @var string|null $billingType
     */
    protected $billingType = null;

    /**
     * @var string|null $billingDesc
     */
    protected $billingDesc = null;

    /**
     * @var string|null $paymentType
     */
    protected $paymentType = null;

    /**
     * @var string|null $agreementCustom
     */
    protected $agreementCustom  = null;

    /**
     * initiates the creation of a billing agreement.
     *
     * @param string* $return Returing URL
     * @param string* $cancel Cancel URL
     *
     * @return string
     */
    public function getResponse($return, $cancel)
    {
        // Argument Test
        Argument::i()
            // Argument 1 must be a string
            ->test(1, 'string')
            // Argument 2 must be a string
            ->test(2, 'string');

        // populate fields
        $query = array(
            self::RETURN_URL => $return,
            self::CANCEL_URL => $cancel,
            self::BILLING_TYPE => $this->billingType,
            // Description associated with the billing agreement.
            self::BILLING_DESC => $this->billingDesc,
            // Valid vaules are Any or InstantOnly
            self::PAYMENT_TYPE => $this->paymentType,
            // Custom annotation field for your own use.
            self::AGREEMENT_CUSTOM => $this->agreementCustom);

        // call request method
        $response = $this->request(self::SET_AGREEMENT, $query);

        // if parameters are success
        if (isset($response[self::ACK])
            && $response[self::ACK] == self::SUCCESS) {
            // fetch token
            $this->token = $response[self::TOKEN];
            // if token is exist and not empty
            if ($this->token) {
                return $this->getAgreement();
            }
        }

        return $response;
    }

    /**
     * Custom annotation field for your own use.
     * For recurring, this is ignored
     *
     * @param string* $agreementCustom
     *
     * @return Eden\Paypal\Billing
     */
    public function setAgreementCustom($agreementCustom)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->agreementCustom = $agreementCustom;
        return $this;
    }

    /**
     * Description of goods or services associated
     * with the billing agreement.
     *
     * @param string* $billingDesc
     *
     * @return Eden\Paypal\Billing
     */
    public function setBillingDesc($billingDesc)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->billingDesc = $billingDesc;
        return $this;
    }

    /**
     * Set billing type
     *
     * @param string* $billingType
     *
     * @return Eden\Paypal\Billing
     */
    public function setBillingType($billingType)
    {
        // Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->billingType = $billingType;
        return $this;
    }

    /**
     * Set payment type to Any
     * For recurring, this is ignored
     *
     * @return Eden\Paypal\Billing
     */
    public function setToAny()
    {
        $this->paymentType = self::ANY;
        return $this;
    }

    /**
     * Set payment type to Instant Only
     * For recurring, this is ignored
     *
     * @return Eden\Paypal\Billing
     */
    public function setToInstantOnly()
    {
        $this->paymentType = self::INSTANT_ONLY;
        return $this;
    }

    /**
     * Get Agreement
     *
     * @return String
     */
    protected function getAgreement()
    {
        // populate fields
        $query = array(self::TOKEN => $this->token);
        // call request method
        return $this->request(self::GET_AGREEMENT, $query);
    }
}
