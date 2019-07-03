<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait Parameters
{
    /**
     * Trả về access key do MoMo cấp.
     *
     * @return null|string
     */
    public function getAccessKey(): ?string
    {
        return $this->getParameter('accessKey');
    }

    /**
     * Thiết lập access key do MoMo cấp.
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setAccessKey(?string $key)
    {
        return $this->setParameter('accessKey', $key);
    }

    /**
     * Trả về secret key do MoMo cấp.
     *
     * @return null|string
     */
    public function getSecretKey(): ?string
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Thiết lập secret key do MoMo cấp.
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setSecretKey(?string $key)
    {
        return $this->setParameter('secretKey', $key);
    }

    /**
     * Trả về partner code do MoMo cấp.
     *
     * @return null|string
     */
    public function getPartnerCode(): ?string
    {
        return $this->getParameter('partnerCode');
    }

    /**
     * Thiết lập partner code do MoMo cấp.
     *
     * @param  null|string  $code
     * @return $this
     */
    public function setPartnerCode(?string $code)
    {
        return $this->setParameter('partnerCode', $code);
    }

    /**
     * Trả về public key do MoMo cấp.
     *
     * @return null|string
     */
    public function getPublicKey(): ?string
    {
        return $this->getParameter('publicKey');
    }

    /**
     * Thiết lập public key do MoMo cấp.
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setPublicKey(?string $key)
    {
        return $this->setParameter('publicKey', $key);
    }
}
