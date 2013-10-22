<?php //-->
/*
 * This file is part of the Paypal package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Paypal;

use Eden\Core\Base as CoreBase;

/**
 * Paypal API factory. This is a factory class with
 * methods that will load up different Paypal API methods.
 * Paypal classes are organized as described on their
 * developer site: Express Checkout, Transaction,
 * Authorization, Direct Payment, Recurring Payment,
 * Button Manager and Billing Agreement
 *
 * @package Eden
 * @category Paypal
 * @author Airon Paul Dumael airon.dumael@gmail.com
 * @author James Vincent Bion javinczki02@gmail.com
 * @author Joaquin Toral joaquintoral@gmail.com
 */
class Factory extends CoreBase
{
    const PEM = '/paypal/cacert.pem';
    const INSTANCE = 1;

    /**
     * Returns paypal authorization
     *
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string API certificate file
     * @return Authorization
     */
    public function authorization($user, $password, $signature, $certificate = null)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Authorization::i($user, $password, $signature, $certificate);
    }

    /**
     * Returns paypal billing
     *
     * @param string    API username
     * @param string    API password
     * @param string    API signature
     * @param string    API certificate file
     * @return Billing
     */
    public function billing($user, $password, $signature, $certificate = null)
    {
        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Billing::i($user, $password, $signature, $certificate);
    }

    /**
     * Returns paypal button
     *
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string API certificate file
     * @return Button
     */
    public function button($user, $password, $signature, $certificate = null)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Button::i($user, $password, $signature, $certificate);
    }

    /**
     * Returns paypal express checkout
     *
     * @param string
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string|null API certificate file
     * @return Checkout
     */
    public function checkout($user, $password, $signature, $certificate = null, $live = false)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Checkout::i($user, $password, $signature, $certificate, $live);
    }

    /**
     * Returns paypal directPayment
     *
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string API certificate file
     * @return Direct
     */
    public function direct($user, $password, $signature, $certificate = null)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Direct::i($user, $password, $signature, $certificate);
    }

    /**
     * Returns paypal recurringPayment
     *
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string API certificate file
     * @return Recurring
     */
    public function recurring($user, $password, $signature, $certificate = null)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Recurring::i($user, $password, $signature, $certificate);
    }

    /**
     * Returns paypal transaction
     *
     * @param string API username
     * @param string API password
     * @param string API signature
     * @param string API certificate file
     * @return Transaction
     */
    public function transaction($user, $password, $signature, $certificate = null)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Transaction::i($user, $password, $signature, $certificate);
    }
}
