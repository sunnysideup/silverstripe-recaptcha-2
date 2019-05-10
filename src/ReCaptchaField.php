<?php

namespace Kmedia\ReCaptcha;

use Locale;
use SilverStripe\Control\Controller;
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

    /**
     * Adds the requirements and returns the form field.
     * @param array $properties
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function Field($properties = array())
    {
        if (empty($this->siteKey) || empty($this->secretKey)) {
            user_error('You must set SS_RECAPTCHA_SITE_KEY and SS_RECAPTCHA_SECRET_KEY environment.', E_USER_ERROR);
        }

        Requirements::customScript(
            "!function(){"
            . "var t=document.createElement('script'),e=document.querySelectorAll('script')[0],c='https:'==document.location.protocol?'https':'http';t.type='text/javascript',t.async=!0,t.defer=!0,"
            . "t.src=c+'://www.google.com/recaptcha/api.js?hl=" . Locale::getPrimaryLanguage(i18n::get_locale()) . "',"
            . "e.parentNode.insertBefore(t,e)"
            . "}();"
        );

        return parent::Field($properties);
    }

    public function validate($validator)
    {
        $recaptchaResponse = Controller::curr()->getRequest()->requestVar('g-recaptcha-response');

        if (empty($recaptchaResponse)) {
            $validator->validationError(
                $this->name,
                _t('Kmedia\\ReCaptcha.EMPTY', 'Please answer the captcha, if you do not see the captcha please enable JavaScript.'),
                'validation'
            );
            return false;
        }

        if (!function_exists('curl_init')) {
            user_error('You must enable php-curl to use this field', E_USER_ERROR);
            return false;
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
            . $this->secretKey . '&response=' . rawurlencode($recaptchaResponse)
            . '&remoteip=' . rawurlencode($_SERVER['REMOTE_ADDR']);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = json_decode(curl_exec($ch), true);
        if (is_array($response)) {
            if (array_key_exists('success', $response) && $response['success'] == false) {
                $validator->validationError(
                    $this->name,
                    _t('Kmedia\\ReCaptcha.EMPTY', 'Please answer the captcha, if you do not see the captcha please enable JavaScript.'),
                    'validation'
                );
                return false;
            }
        } else {
            $validator->validationError($this->name,
                _t('Kmedia\\ReCaptcha.VALIDATE_ERROR', 'Captcha could not be validated.'),
                'validation');
            return false;
        }
        return true;
    }
}
