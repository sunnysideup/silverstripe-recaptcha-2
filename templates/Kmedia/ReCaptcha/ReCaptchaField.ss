<% if $Size.ATT == "invisible" %>
    <div class="g-recaptcha"
         data-sitekey="$SiteKey"
         data-size="$Size.ATT"
         data-badge="$Badge.ATT"></div>
<% else %>
    <div class="g-recaptcha"
         data-sitekey="$SiteKey"
         data-theme="$Theme.ATT"
         data-size="$Size.ATT"></div>
<% end_if %>
<noscript>
    <p><%t Kmedia\\ReCaptcha.NOSCRIPT "You must enable JavaScript to submit this form." %></p>
</noscript>
