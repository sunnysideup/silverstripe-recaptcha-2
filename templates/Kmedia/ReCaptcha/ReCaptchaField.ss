<div id="$ID"
     class="g-recaptcha"
     data-sitekey="$SiteKey"
    <% if $Size.ATT == "invisible" %>
     data-callback="reCaptchaOnSubmit"
     data-badge="$Badge.ATT"
    <% else %>
     data-theme="$Theme.ATT"
    <% end_if %>
     data-size="$Size.ATT"></div>
<noscript>
    <p><%t Kmedia\\ReCaptcha.NOSCRIPT "You must enable JavaScript to submit this form." %></p>
</noscript>
