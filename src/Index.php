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
 * Factory Class
 *
 * @vendor   Eden
 * @package  Paypal
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @author   Airon Paul Dumael <airon.dumael@gmail.com>
 * @standard PSR-2
 */
class Index extends \Eden\Core\Base
{
    /**
     * @const int INSTANCE Flag that designates singleton when using ::i()
     */
    const INSTANCE = 1;
    
    /**
     * @const int PEM Location of the PEM file
     */
    const PEM = '/paypal/cacert.pem';
    
    /**
     * Returns paypal authorization
     *
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Authorization
     */
    public function authorization(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
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
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Billing
     */
    public function billing(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Billing::i($user, $password, $signature, $certificate);
    }
    
    /**
     * Returns paypal button
     *
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Button
     */
    public function button(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
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
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     * @param bool        $live        Flag ofor whether to use the live URL or not
     *
     * @return Eden\Paypal\Checkout
     */
    public function checkout(
        $user,
        $password,
        $signature,
        $certificate = null,
        $live = false
    ) {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string')
            ->test(3, 'string')
            ->test(4, 'string', 'null')
            ->test(5, 'bool', 'null');

        if (!is_string($certificate)) {
            $certificate = dirname(__FILE__).self::PEM;
        }
        return Checkout::i($user, $password, $signature, $certificate, $live);
    }

    /**
     * Returns paypal directPayment
     *
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Direct
     */
    public function direct(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
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
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Recurring
     */
    public function recurring(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
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
     * @param string*     $user        User ID
     * @param string*     $password    User password
     * @param string*     $signature   PayPal REST signature
     * @param string|null $certificate Location of the certificate file
     *
     * @return Eden\Paypal\Transaction
     */
    public function transaction(
        $user,
        $password,
        $signature,
        $certificate = null
    ) {
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
