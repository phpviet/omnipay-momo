<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Omnipay\MoMo\Support\Signature;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class Response extends AbstractResponse
{
    /**
     * Khởi tạo đối tượng Response.
     *
     * @param  \Omnipay\Common\Message\RequestInterface  $request
     * @param $data
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if ($this->isSuccessful()) {
            $parameters = $request->getParameters();

            $this->validateSignature($parameters['secretKey']);
        }
    }

    /**
     * Trả về trạng thái do MoMo phản hồi.
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return '0' === $this->getCode() ;
    }

    /**
     * Trả về thông báo từ MoMo.
     *
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->data['message'] ?? null;
    }

    /**
     * Trả về mã báo lỗi từ MoMo. Nếu là 0 thì tương đương với thành công.
     *
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->data['errorCode'] ?? null;
    }

    /**
     * Trả về mã đơn hàng, dùng để đối soát.
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['orderId'] ?? null;
    }

    /**
     * Trả về transaction reference theo Response.
     *
     * @return null|string
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['transId'] ?? null;
    }

    /**
     * Kiểm tra tính hợp lệ của dữ liệu do MoMo phản hồi.
     *
     * @param  string  $secretKey
     * @throws InvalidResponseException
     */
    protected function validateSignature(string $secretKey): void
    {
        $data = [];
        $signature = new Signature($secretKey);

        foreach ($this->getSignatureParameters($this->data['requestType']) as $param) {
            $data[$param] = $this->data[$param];
        }

        if (! $signature->validate($data, $this->data['signature'])) {

            throw new InvalidResponseException(sprintf('Data signature response from MoMo is invalid!'));
        }
    }

    /**
     * Trả về danh sách các param data đã dùng để tạo chữ ký dữ liệu theo requestType truyền vào.
     *
     * @param  string  $requestType
     * @return array
     */
    protected function getSignatureParameters(string $requestType): array
    {
        switch ($requestType) {
            case 'captureMoMoWallet':
                return [
                    'requestId', 'orderId', 'message', 'localMessage', 'payUrl', 'errorCode', 'requestType',
                ];
            case 'transactionStatus':
                return [
                    'partnerCode', 'accessKey', 'requestId', 'orderId', 'errorCode', 'transId', 'amount', 'message',
                    'localMessage', 'requestType', 'payType', 'extraData',
                ];
            case 'refundMoMoWallet':
                return [
                    'partnerCode', 'accessKey', 'requestId', 'orderId', 'errorCode', 'transId', 'message',
                    'localMessage', 'requestType',
                ];
            case 'refundStatus':
                return [
                    'partnerCode', 'accessKey', 'requestId', 'orderId', 'errorCode', 'transId', 'amount', 'message',
                    'localMessage', 'requestType',
                ];
            default:
                return [];
        }
    }
}
