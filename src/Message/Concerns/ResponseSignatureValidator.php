<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @mixin \Omnipay\MoMo\Message\AbstractResponse
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidator
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Kiểm tra tính hợp lệ của dữ liệu do MoMo phản hồi.
     *
     * @param string $secretKey
     * @throws InvalidResponseException
     */
    protected function validateSignature(string $secretKey): void
    {
        $data = [];

        foreach ($this->getDataSigned($this->data['requestType']) as $param) {
            $data[$param] = $this->data[$param];
        }

        $dataSign = urldecode(http_build_query($data));
        $signature = hash_hmac('sha256', $dataSign, $secretKey);

        if (0 !== strcasecmp($signature, $this->data['signature'])) {

            throw new InvalidResponseException(sprintf('Data signature response from MoMo is invalid!'));
        }
    }

    /**
     * Trả về danh sách các param data đã dùng để tạo chữ ký dữ liệu theo requestType truyền vào.
     *
     * @param string $requestType
     * @return array
     */
    protected function getDataSigned(string $requestType): array
    {
        switch ($requestType) {
            case 'captureMoMoWallet':
                return [
                    'requestId',
                    'orderId',
                    'message',
                    'localMessage',
                    'payUrl',
                    'errorCode',
                    'requestType',
                ];
            case 'transactionStatus':
                return [
                    'partnerCode',
                    'accessKey',
                    'requestId',
                    'orderId',
                    'errorCode',
                    'transId',
                    'amount',
                    'message',
                    'localMessage',
                    'requestType',
                    'payType',
                    'extraData',
                ];
            case 'refundMoMoWallet':
                return [
                    'partnerCode',
                    'accessKey',
                    'requestId',
                    'orderId',
                    'errorCode',
                    'transId',
                    'message',
                    'localMessage',
                    'requestType',
                ];
            case 'refundStatus':
                return [
                    'partnerCode',
                    'accessKey',
                    'requestId',
                    'orderId',
                    'errorCode',
                    'transId',
                    'amount',
                    'message',
                    'localMessage',
                    'requestType',
                ];
            default:
                return [];
        }
    }
}
