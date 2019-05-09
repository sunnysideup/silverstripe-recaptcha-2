<?php
namespace Kmedia\ReCaptcha;

use SilverStripe\Forms\FormField;


class ReCaptchaField extends FormField
{
    /**
     * Recaptcha Site Key - Configurable via Injector config
     */
    protected $siteKey;

    /**
     * Recaptcha Secret Key - Configurable via Injector config
     */
    protected $secretKey;

    /**
     * Getter for siteKey
     * @return string
     */
    public function getSiteKey()
    {
        return $this->siteKey;
    }

    /**
     * Setter for siteKey to allow injector config to override the value
     */
    public function setSiteKey($siteKey)
    {
        $this->siteKey = $siteKey;
    }

    /**
     * Getter for secretKey
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Setter for secretKey to allow injector config to override the value
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function Field($properties = array())
    {
        var_dump($this->siteKey);
        var_dump($this->secretKey);

        return parent::Field($properties);
    }
}
