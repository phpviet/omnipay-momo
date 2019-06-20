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
    public function isSuccessful(): bool
    {
        return 0 === (int) $this->data['errorCode'];
    }

    public function isRedirect(): bool
    {
        return $this->isSuccessful();
    }

    public function getMessage(): string
    {
        return $this->data['message'];
    }

    public function getRedirectUrl()
    {
        return $this->data['payUrl'];
    }
}
