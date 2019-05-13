# Silverstripe reCAPTCHA FormField Module
[![license - bsd 3 clause](https://img.shields.io/:license-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Build Status](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kMediaGbR/silverstripe-recaptcha/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## Introduction
Provides a FormField which allows form to validate for non-bot submissions
using Google's [reCAPTCHA v2](https://developers.google.com/recaptcha/docs/display) service.

## Requirements
 * SilverStripe Framework 4.0 or newer

## Installation
Best installed via composer. You may clone the repo or download the zip, however you should find a directory called `recaptcha` with all files in your silverstripe root folder.

### Using Composer
```bash
composer require kmedia/silverstripe-recaptcha
```

After installing the module via composer or manual install you must set the spam protector to ReCaptchaProtector, this needs to be set in your site's config file normally this is `app/_config/mysite.yml`.
```yml
SilverStripe\SpamProtection\Extension\FormSpamProtectionExtension:
  default_spam_protector: Kmedia\ReCaptcha\ReCaptchaProtector
```

Finally, add the "spam protection" field to your form fields.

## Configuration
You have to create your `sitekey` and `secretkey` in the environments (`.env`) file, which you can get from the [reCAPTCHA page](https://www.google.com/recaptcha). These configuration options must be added to your site's yaml config typically this is `app/_config/mysite.yml`.
```yml
Kmedia\ReCaptcha\ReCaptchaField:
  theme: "light" #Default theme color (optional, light or dark, defaults to light)
  size: "normal" #Default size (optional, normal, compact or invisible, defaults to normal)
  badge: "bottomright" #Default badge position (bottomright, bottomleft or inline, defaults to bottomright)
```

## Adding field labels
If you want to add a field label or help text to the Captcha field you can do so like this:
```php
$form->enableSpamProtection()
    ->fields()->fieldByName('Captcha')
    ->setTitle("Spam protection")
    ->setDescription("Please tick the box to prove you're a human and help us stop spam.");
```
