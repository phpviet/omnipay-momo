<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @method AbstractRequest getRequest()
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return '0' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return '49' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return $this->data['message'] ?? null;
    }
}
