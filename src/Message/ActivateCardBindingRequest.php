<?php

namespace Omnipay\Arca\Message;

use Omnipay\Arca\Message\AbstractRequest;

/**
 * Class MakeBindingPaymentRequest
 * @package Omnipay\Arca\Message
 */
class ActivateCardBindingRequest extends AbstractRequest
{
  
  /**
     * @return array|mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('bindingId');

        return array_merge(parent::getData(), [
            'bindingId' => $this->getBindingId(),
        ]);
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getUrl() . '/bindCard.do';
    }
}