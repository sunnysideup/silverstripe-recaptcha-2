## Adding field labels
If you want to add a field label or help text to the Captcha field you can do so like this:
```php
$form->enableSpamProtection()
    ->fields()->fieldByName('Captcha')
    ->setTitle("Spam protection")
    ->setDescription("Please tick the box to prove you're a human and help us stop spam.");
```
