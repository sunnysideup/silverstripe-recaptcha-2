<?php

namespace Kmedia\ReCaptcha;

use Locale;
use SilverStripe\Forms\FormField;
use SilverStripe\i18n\i18n;
use SilverStripe\View\Requirements;


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
        if(empty($this->siteKey) || empty($this->secretKey)) {
            user_error('You must set SS_RECAPTCHA_SITE_KEY and SS_RECAPTCHA_SECRET_KEY environment.', E_USER_ERROR);
        }

        Requirements::javascript('kmedia/silverstripe-recaptcha:javascript/ReCaptchaField.js');
        Requirements::customScript(
            "!function(){" .
            "var t=document.createElement('script'),e=document.querySelectorAll('script')[0],c='https:'==document.location.protocol?'https':'http';t.type='text/javascript',t.async=!0,t.defer=!0," .
            "t.src=c+'://www.google.com/recaptcha/api.js?hl=". Locale::getPrimaryLanguage(i18n::get_locale()) ."'," .
            "e.parentNode.insertBefore(t,e)" .
            "}();"
        );

        return parent::Field($properties);
    }
}
