<?php
/*
Plugin Name: Callback Widget
Description: Adds a callback request widget using the callback-service form.
Version: 1.0
Author: Milosian
*/

function callback_widget_enqueue_assets() {
    $style_path = plugin_dir_path(__FILE__) . 'style.css';
    $script_path = plugin_dir_path(__FILE__) . 'script.js';
    
    $style_version = file_exists($style_path) ? filemtime($style_path) : '1.0';
    $script_version = file_exists($script_path) ? filemtime($script_path) : '1.0';
    
    wp_enqueue_style(
        'callback-widget-style',
        plugin_dir_url(__FILE__) . 'style.css',
        array(),
        $style_version
    );

    wp_enqueue_script(
        'callback-widget-script',
        plugin_dir_url(__FILE__) . 'script.js',
        array(),
        $script_version,
        true
    );

    wp_localize_script('callback-widget-script', 'callbackWidgetData', array(
        'apiUrl' => 'https://188.33.34.8:3000/api/callback'
    ));
}
add_action('wp_enqueue_scripts', 'callback_widget_enqueue_assets');

function callback_widget_shortcode() {
    ob_start();
    ?>
    <div class="callback-widget">
      <main class="hero" id="callbackPanel">
        <header class="hero-header">
          <button id="closeFormButton" class="close-button" type="button" aria-label="Zamknij formularz">×</button>
          <div class="eyebrow">CallBack</div>
          <h1 class="hero-title">Potrzebujesz porozmawiać z naszym konsultantem? Pozwól nam szybko się z tobą skontaktować.</h1>
          <p class="hero-copy">Wyślij nam swoje dane, a skontaktujemny się z Tobą w ciągu następnej godziny roboczej. Im lepiej przytoczysz nam kontekst sprawy, tym lepiej się przygotujemy.</p>
        </header>

        <form id="callbackForm">
          <div class="field">
            <label for="name">Imię i Nazwisko</label>
            <input id="name" type="text" name="name" required placeholder="Twoje imię i nazwisko">
          </div>

          <div class="field">
            <label for="phone">Telefon</label>
            <input id="phone" type="tel" name="phone" required placeholder="+48 123 456 789">
            <div class="hint">Podaj kod kraju, aby uzyskać najszybszą odpowiedź.</div>
          </div>

          <div class="field">
            <label for="message">Wiadomość (opcjonalnie)</label>
            <textarea id="message" name="message" placeholder="Powiedz nam, jak możemy Ci pomóc."></textarea>
          </div>

          <div class="actions">
            <button type="submit">Poproś o Połączenie</button>
          </div>
        </form>

        <div id="result" aria-live="polite"></div>
      </main>

      <button id="toggleFormButton" aria-expanded="false" aria-controls="callbackPanel">
        <img height="32" width="32" src="https://img.icons8.com/ios/50/phone--v1.png" id="cell_icon" alt="phone--v1"/>
      </button>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('callback_widget', 'callback_widget_shortcode');