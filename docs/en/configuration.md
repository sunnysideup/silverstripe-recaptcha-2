## Configuration
You have to create your `sitekey` and `secretkey` in the environments (`.env`) file, which you can get from the [reCAPTCHA page](https://www.google.com/recaptcha). These configuration options must be added to your site's yaml config typically this is `app/_config/mysite.yml`.
```
# For a complete list of core environment variables see
# https://docs.silverstripe.org/en/4/getting_started/environment_management/#core-environment-variables

# ReCaptcha
SS_RECAPTCHA_SITE_KEY="<your-sitekey>"
SS_RECAPTCHA_SECRET_KEY="<your-secretkey>"
```

```yml
Kmedia\ReCaptcha\ReCaptchaField:
  theme: "light" #Default theme color (optional, light or dark, defaults to light)
  size: "normal" #Default size (optional, normal, compact or invisible, defaults to normal)
  badge: "bottomright" #Default badge position (bottomright, bottomleft or inline, defaults to bottomright)
```
