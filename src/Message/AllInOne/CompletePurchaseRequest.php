<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseRequest extends AbstractHttpRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getHttpRequestParameterBag(): ParameterBag
    {
        return $this->httpRequest->query;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): CompletePurchaseResponse
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
