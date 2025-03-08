<?php 

// E-MAIL ADRESSE ALS USERNAME
function custom_login_label($translated_text, $text, $domain) {
    if ("default" == $domain && "Username or Email Address" == $text) {
        return "E-Mail Adresse";
    }
    return $translated_text;
}
add_filter("gettext", "custom_login_label", 20, 3);

// ZEIGT SEITENTITEL ALS LOGO AN
function custom_login_logo_text() {
    $site_title = get_bloginfo("name");
    echo '<p class="custom-login-logo-text">';
    echo $site_title;
    echo "</p>";
}
add_action("login_message", "custom_login_logo_text");

// TEXT FEHLERMELDUNGEN ANPASSEN
function gw_custom_login_errors() {
    return "Da passt etwas nicht. Versuche es noch einmal oder setze dein Passwort zurück.";
}
add_filter("login_errors", "gw_custom_login_errors");

// deaktiviert die Shake Animation bei falschen Angaben
add_action("login_footer", function () {
    remove_action("login_footer", "wp_shake_js", 12);
});
