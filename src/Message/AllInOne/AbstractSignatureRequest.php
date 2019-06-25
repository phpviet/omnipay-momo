<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Omnipay\MoMo\Concerns\AllInOneParameters;
use Omnipay\MoMo\Message\AbstractSignatureRequest as BaseAbstractSignatureRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureRequest extends BaseAbstractSignatureRequest
{
    use AllInOneParameters;

    /**
     * Trả về lớp đối tượng phản hồi tương ứng của Request.
     *
     * @var string
     */
    protected $responseClass;

    /**
     * Thiết lập id đơn hàng.
     *
     * @param  string  $id
     */
    public function setOrderId(string $id): void
    {
        $this->setParameter('orderId', $id);
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
        $responseClass = $this->responseClass;
        $responseData = $response->getBody()->getContents();

        return $this->response = new $responseClass($this, json_decode($responseData, true) ?? []);
    }
}
