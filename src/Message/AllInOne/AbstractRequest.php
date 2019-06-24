<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use InvalidArgumentException;
use Omnipay\MoMo\Support\Signature;
use Omnipay\MoMo\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Concerns\RequestParameters;

    /**
     * Trả về lớp đối tượng phản hồi tương ứng của Request.
     *
     * @var string
     */
    protected $responseClass = Response::class;

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
        $responseClass = $this->responseClass;
        $responseData = json_decode($response->getBody()->getContents(), true);

        return $this->response = new $responseClass($this, $responseData);
    }

    /**
     * Trả về chữ ký điện tử gửi đến MoMo dựa theo `$requestType` truyền vào.
     *
     * @param  string  $requestType
     * @return string
     */
    protected function generateSignature(string $requestType): string
    {
        $data = [];
        $signature = new Signature($this->getParameter('secretKey'));

        foreach ($this->getSignatureParameters($requestType) as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        return $signature->generate($data);
    }

    /**
     * Trả về danh sách param dùng để tạo chữ ký số theo `$requestType`.
     *
     * @param  string  $requestType
     * @return array
     */
    protected function getSignatureParameters(string $requestType): array
    {
        switch ($requestType) {
            case 'captureMoMoWallet':
                return [
                    'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'returnUrl', 'notifyUrl',
                    'extraData',
                ];
            case 'transactionStatus':
            case 'refundMoMoWallet':
            case 'refundStatus':
                return [
                    'partnerCode', 'accessKey', 'requestId', 'orderId', 'requestType',
                ];
            default:
                throw new InvalidArgumentException(sprintf('Request type: (%s) is not valid!', $requestType));
        }
    }
}
