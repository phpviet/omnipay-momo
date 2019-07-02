<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Support\Arr;
use Omnipay\MoMo\Support\Signature;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestSignature
{
    /**
     * Trả về chữ ký điện tử gửi đến MoMo dựa theo [[getSignatureParameters()]].
     *
     * @return string
     */
    protected function generateSignature(): string
    {
        $data = [];
        $signature = new Signature(
            $this->getSecretKey()
        );
        $parameters = $this->getParameters();

        foreach ($this->getSignatureParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }

            $data[$pos] = Arr::getValue($parameter, $parameters);
        }

        return $signature->generate($data);
    }

    /**
     * Trả về danh sách parameters dùng để tạo chữ ký số.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
