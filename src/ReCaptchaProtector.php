<?php
namespace Kmedia\ReCaptcha;

use SilverStripe\SpamProtection\SpamProtector;

class ReCaptchaProtector implements SpamProtector
{
    /**
     * Return the Field that we will use in this protector
     * @param string $name
     * @param string $title
     * @param mixed $value
     * @return ReCaptchaField
     */
    public function getFormField($name = 'ReCaptchaField', $title = 'ReCaptcha', $value = null)
    {
        return ReCaptchaField::create($name, $title);
    }

    /**
     * Not used by ReCaptcha
     */
    public function setFieldMapping($fieldMapping)
    {
        // ...
    }
}
