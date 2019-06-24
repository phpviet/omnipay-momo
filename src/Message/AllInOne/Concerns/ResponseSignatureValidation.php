<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne\Concerns;

use InvalidArgumentException;
use Omnipay\MoMo\Support\Signature;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Kiểm tra tính hợp lệ của dữ liệu do MoMo phản hồi.
     *
     * @throws InvalidResponseException
     * @throws InvalidArgumentException
     */
    protected function validateSignature(): void
    {
        $data = [];
        $requestParameters = $this->getRequest()->getParameters();
        $signature = new Signature($requestParameters['secretKey']);

        foreach ($this->getSignatureParameters() as $param) {
            $data[$param] = $this->data[$param];
        }

        if (! $signature->validate($data, $this->data['signature'])) {

            throw new InvalidResponseException(sprintf('Data signature response from MoMo is invalid!'));
        }
    }

    /**
     * Trả về danh sách các param data đã dùng để tạo chữ ký dữ liệu theo requestType truyền vào.
     *
     * @return array
     * @throws InvalidArgumentException
     */
    protected function getSignatureParameters(): array
    {
        switch ($requestType = $this->data['requestType']) {
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
                throw new InvalidArgumentException(sprintf('Request type: `%s` is not valid!', $requestType));
        }
    }
}
