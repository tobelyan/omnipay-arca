<?php

namespace Omnipay\Arca\Message;

use \Omnipay\Common\Message\AbstractRequest AS CommonAbstractRequest;

/**
 * Class AbstractRequest
 * @package Omnipay\Arca\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * Live Endpoint URL.
     *
     * @var string URL
     */
    protected $endpoint = 'https://ipay.arca.am/payment/rest';

    /**
     * Test Endpoint URL.
     *
     * @var string
     */
    protected $testEndpoint = 'https://ipaytest.arca.am:8445/payment/rest';

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

    abstract public function getEndpoint();

    /**
     * Get url. Depends on  test mode.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->endpoint;
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = [];

        return $headers;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * Set the request language.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * Set the request bindingId.
     *
     * @param string $value
     *
     * @return $this
     */

    public function setBindingId($value) {
        return $this->setParameter('bindingId', $value);
    }

        /**
     * Get the request bindingId.
     *
     * @return $this
     */
    public function getBindingId(){
        return $this->getParameter('bindingId');
    }
    /**
     * @return mixed
     */
    public function getJsonParams()
    {
        return $this->getParameter('jsonParams');
    }

    /**
     * Set the request jsonParams.
     * Fields of additional information
     *
     * @param string $value
     *
     * @return $this
     */
    public function setJsonParams($value)
    {
        return $this->setParameter('jsonParams', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = $data ? http_build_query($data, '', '&') : null;

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    /**
     * @param $data
     * @param array $headers
     * @return Response
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }

    public function getData()
    {
        $this->validate('username', 'password');

        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
        ];
    }
}
