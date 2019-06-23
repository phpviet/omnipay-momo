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
class CompletePurchaseNotifyRequest extends AbstractHttpRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getHttpRequestParameterBag(): ParameterBag
    {
        return $this->httpRequest->request;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): CompletePurchaseNotifyResponse
    {
        return new CompletePurchaseNotifyResponse($this, $data);
    }
}
