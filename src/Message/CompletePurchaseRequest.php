<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseRequest extends AbstractHttpRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getHttpRequestData(): array
    {
        $data = [];
        $params = [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'orderType', 'transId',
            'message', 'localMessage', 'responseTime', 'errorCode', 'extraData', 'signature', 'payType',
        ];
        $query = $this->httpRequest->query;
        $request = $this->httpRequest->request;

        foreach ($params as $param) {
            $data[$param] = $query->get($param, $request->get($param));
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): CompletePurchaseResponse
    {
        return new CompletePurchaseResponse($this, $data);
    }

}
