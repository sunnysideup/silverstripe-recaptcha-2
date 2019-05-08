<?php


namespace Kmedia\ReCaptcha;


use SilverStripe\Forms\FormField;

class ReCaptchaField extends FormField
{
    /**
     * Recaptcha Site Key
     * @config ReCaptchaField.siteKey
     */
    private static $siteKey;

    /**
     * Recaptcha Secret Key
     * @config ReCaptchaField.secretKey
     */
    private static $secretKey;

    /**
     * Creates a new ReCaptcha 2 field
     * @param string $name The internal field name, passed to forms.
     * @param null|string $title The human-readable field label.
     * @param mixed $value The value of the field.
     */
    public function __construct($name, $title = null, $value = null)
    {
        parent::__construct($name, $title, $value);
    }
}
