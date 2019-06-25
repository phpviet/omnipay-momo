<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * Trả về trạng thái do MoMo phản hồi.
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return '0' === $this->getCode();
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
}
