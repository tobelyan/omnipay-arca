<?php

namespace Omnipay\Arca;

use Omnipay\Common\AbstractGateway;


/**
 * Arca Gateway
 *
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'Arca';
    }


    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => '',
        ];
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getParameter('username');
    }

    /**
     * Set account login.
     *
     * @param $value
     * @return $this
     */
    public function setUserName($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set account password.
     *
     * @param $value
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Create Purchase Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\RegisterRequest', $parameters);
    }

    /**
     * Create RegisterPreAuth Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function registerPreAuth(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\RegisterPreAuthRequest', $parameters);
    }

    /**
     * Create GetOrderStatus Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getOrderStatus(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\GetOrderStatusRequest', $parameters);
    }

    /**
     * Create getOrderStatusExtended Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getOrderStatusExtended(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\GetOrderStatusExtendedRequest', $parameters);
    }

    /**
     * Create verifyEnrollment Request.
     *
     * @param  array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function verifyEnrollment(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\VerifyEnrollmentRequest', $parameters);
    }

    /**
     * Create Deposit Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function deposit(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\DepositRequest', $parameters);
    }

    /**
     * Create Reverse Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function reverse(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\ReverseRequest', $parameters);
    }

    /**
     * Create Refund Request.
     *
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Arca\Message\RefundRequest', $parameters);
    }
}
