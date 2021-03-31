<?php

namespace Omnipay\Arca\Message;

use Omnipay\Arca\Message\AbstractRequest;

/**
 * Class MakeBindingPaymentRequest
 * @package Omnipay\Arca\Message
 */
class MakeBindingPaymentRequest extends AbstractRequest
{
  

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * Set the request clientId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return mixed
     */
    public function getMdOrder()
    {
        return $this->getParameter('mdOrder');
    }

    /**
     * Set the request clientId.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMdOrder($value)
    {
        return $this->setParameter('mdOrder', $value);
    }
   
    /**
     * Prepare data to send
     *
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionId', 'amount', 'bindingId');

        $data = parent::getData();

        $data['orderNumber'] = $this->getTransactionId();
        $data['amount'] = $this->getAmount();
        //$data['cvc'] = 615;
        #$data['returnUrl'] = $this->getReturnUrl();
        $data['bindingId'] = $this->getBindingId();
        if ($this->getCurrency()) {
            $data['currency'] = $this->getCurrency();
        }
        if($this->getMdOrder()) {
            $data['mdOrder'] = $this->getMdOrder();
        }

        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        if ($this->getLanguage()) {
            $data['language'] = $this->getLanguage();
        }

        if ($this->getClientId()) {
            $data['clientId'] = $this->getClientId();
        }

        if ($this->getJsonParams()) {
            $data['jsonParams'] = $this->getJsonParams();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getUrl() . '/paymentOrderBinding.do';
    }
}