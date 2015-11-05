<?php
namespace Eden\Paypal\Tests\Paypal;

class CheckoutTest extends BaseTest
{
    public function setUp()
    {
        $this->checkout = eden('paypal')
            ->checkout(
                $this->username,
                $this->password,
                $this->signature,
                $this->certificate
            );
    }

    public function testCheckout()
    {
        $checkout = $this->checkout
            ->addItem(array(
                'name' => 'item1',
                'description' => 'desc',
                'quantity' => 2,
                'amount' => 100,
                'tax_amount' => 20,
                'url' => 'http://fuck.com'
            ))
            ->addItem(array(
                'name' => 'item2',
                'description' => 'desc',
                'quantity' => 2,
                'amount' => 100
            ))
            ->setTaxAmount(40)
            ->setOrderAmount(400)
            ->setShippingAmount(20)
            ->setTotalAmount(460)
            ->setCurrency('PHP')
            ->checkout(
                'http://sample.com/sample/sample',
                'http://sample.com/sample/sample'
            );
    }

    public function testGetTransactionDetails()
    {
        $checkout = $this->checkout
            ->setToken($this->token)
            ->setCurrency('PHP')
            ->setTotalAmount(460)
            ->getTransactionId($this->payerId);
    }
}
