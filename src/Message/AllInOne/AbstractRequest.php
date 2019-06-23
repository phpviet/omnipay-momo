<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Omnipay\MoMo\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Concerns\RequestSignature;
    use Concerns\RequestParameters;

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $parameters = $this->getParameters();
        $this->validate('partnerCode', 'accessKey', 'requestId', 'orderId', 'secretKey', 'requestType');
        $parameters['signature'] = $this->generateSignature($parameters['requestType']);
        unset($parameters['secretKey']);

        return $parameters;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/gw_payment/transactionProcessor', [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));
        $responseClass = $this->responseClass();
        $responseData = json_decode($response->getBody()->getContents(), true);

        return $this->response = new $responseClass($this, $responseData);
    }

    /**
     * Trả về lớp đối tượng phản hồi tương ứng của Request.
     *
     * @return string
     */
    abstract protected function responseClass(): string;
}
