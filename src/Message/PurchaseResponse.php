<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect(): bool
    {
        return 0 === (int) $this->data['errorCode'];
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->data['message'];
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->data['payUrl'];
    }
}
