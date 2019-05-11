## Installation
Best installed via composer. You may clone the repo or download the zip, however you should find a directory called `recaptcha` with all files in your silverstripe root folder.

### Using Composer
```
composer require kmedia/silverstripe-recaptcha
```

After installing the module via composer or manual install you must set the spam protector to NocaptchaProtector, this needs to be set in your site's config file normally this is `app/_config/mysite.yml`.
```yml
SilverStripe\SpamProtection\Extension\FormSpamProtectionExtension:
  default_spam_protector: Kmedia\ReCaptcha\ReCaptchaProtector
```

Finally, add the "spam protection" field to your form fields.
