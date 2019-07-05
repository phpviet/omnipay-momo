<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Support\Arr;
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
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['signature'])) {
            throw new InvalidResponseException(sprintf('Response from MoMo is invalid!'));
        }

        $dataSignature = [];
        $signature = new Signature(
            $this->getRequest()->getSecretKey()
        );

        foreach ($this->getSignatureParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }

            $dataSignature[$pos] = Arr::getValue($parameter, $data);
        }

        if (! $signature->validate($dataSignature, $data['signature'])) {
            throw new InvalidResponseException(sprintf('Data signature response from MoMo is invalid!'));
        }
    }

    /**
     * Trả về danh sách các param data đã dùng để tạo chữ ký dữ liệu.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
