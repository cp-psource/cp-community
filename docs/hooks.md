# CP-Community Hooks Dokumentation

## core_api.php

### Hook: cpc_activity_post_add_hook

**Beschreibung**: Wird ausgelöst, nachdem ein neuer ClassicPress-Beitrag des Typs `cpc_activity` eingefügt wurde. Ermöglicht es, zusätzliche Aktionen oder Benachrichtigungen zu generieren.

**Seit**: 14.12.2

**Parameter**:
- `$the_post` (Typ: array) – Optional. Weitere zu verarbeitende Daten aus `$_POST`.
- `$the_files` (Typ: array) – Optional. Weitere zu verarbeitende Daten aus `$_FILES`.
- `$new_id` (Typ: int) – Die ID des neu erstellten ClassicPress-Beitrags.

**Beispiel**:

```php
add_action('cpc_activity_post_add_hook', 'my_custom_function');
function my_custom_function($the_post, $the_files, $new_id) {
    // Dein Code hier, zum Beispiel eine Benachrichtigung senden
}
```

## cpc_admin.php

### Hook: cpc_admin_quick_start_form_save_hook

**Beschreibung**: Wird ausgelöst, wenn das Schnellstart-Formular im Admin-Bereich gespeichert wird.

**Seit**: 0.0.1

**Parameter**:
- `$_POST` (Typ: array) – Die Daten, die aus dem Formular übermittelt wurden.

**Beispiel**:

```php
add_action('cpc_admin_quick_start_form_save_hook', 'my_custom_quick_start_save_function');
function my_custom_quick_start_save_function($post_data) {
    // Verarbeite die Daten aus dem Formular
    // Beispiel: Speichere eine benutzerdefinierte Option
    if (isset($post_data['my_custom_option'])) {
        update_option('my_custom_option', sanitize_text_field($post_data['my_custom_option']));
    }
}
```

### Hook: cpc_admin_quick_start_hook

**Beschreibung**: Wird verwendet, um zusätzlichen Inhalt oder Funktionen im Schnellstart-Bereich des Admin-Bereichs anzuzeigen.

**Seit**: 0.0.1

**Parameter**: Keine

**Beispiel**:

```php
add_action('cpc_admin_quick_start_hook', 'my_custom_quick_start_content');
function my_custom_quick_start_content() {
    echo '<div class="quick-start-section">';
    echo '<h2>Meine benutzerdefinierte Schnellstart-Anleitung</h2>';
    echo '<p>Hier sind einige Anweisungen, wie du mit meinem benutzerdefinierten Modul beginnen kannst...</p>';
    echo '</div>';
}
```

### Hook: cpc_admin_setup_form_save_hook

**Beschreibung**: Wird ausgelöst, wenn das Setup-Formular im Admin-Bereich gespeichert wird.

**Seit**: 0.0.1

**Parameter**:

- `$_POST` (Typ: array) – Die Daten, die aus dem Formular übermittelt wurden.

**Beispiel**:

```php
add_action('cpc_admin_setup_form_save_hook', 'my_custom_setup_save_function');
function my_custom_setup_save_function($post_data) {
    // Verarbeite die Daten aus dem Formular
    // Beispiel: Speichere eine benutzerdefinierte Option
    if (isset($post_data['my_setup_option'])) {
        update_option('my_setup_option', sanitize_text_field($post_data['my_setup_option']));
    }
}
```

### Hook: cpc_admin_setup_form_get_hook

**Beschreibung**: Wird ausgelöst, wenn Daten aus dem Setup-Formular im Admin-Bereich abgerufen werden.

**Seit**: 0.0.1

**Parameter**:

- `$_GET` (Typ: array) – Die Daten, die aus dem Formular abgerufen wurden.

**Beispiel**:

```php
add_action('cpc_admin_setup_form_get_hook', 'my_custom_setup_get_function');
function my_custom_setup_get_function($get_data) {
    // Verarbeite die abgerufenen Daten
    // Beispiel: Zeige eine Benachrichtigung basierend auf einer GET-Variable
    if (isset($get_data['my_custom_notice'])) {
        echo '<div class="notice notice-success"><p>' . esc_html($get_data['my_custom_notice']) . '</p></div>';
    }
}
```

### Hook: cpc_admin_getting_started_hook

**Beschreibung**: Wird verwendet, um zusätzlichen Inhalt oder Anleitungen im "Erste Schritte"-Bereich des Admin-Bereichs anzuzeigen.

**Seit**: 0.0.1

**Parameter**: Keine

**Beispiel**:

```php
add_action('cpc_admin_getting_started_hook', 'my_custom_getting_started_content');
function my_custom_getting_started_content() {
    echo '<div class="getting-started-section">';
    echo '<h2>Willkommen bei meinem benutzerdefinierten Modul!</h2>';
    echo '<p>Hier sind einige Anweisungen, wie du mit meinem Modul beginnen kannst...</p>';
    echo '</div>';
}
```

### Hook: cpc_admin_getting_started_shortcodes_save_hook

**Beschreibung**: Wird ausgelöst, wenn das Formular für die Shortcodes-Einstellungen im Admin-Bereich gespeichert wird.

**Seit**: 0.0.1

**Parameter**:
- `$_POST` (Typ: array) – Die Daten, die aus dem Formular übermittelt wurden.

**Beispiel**:

```php
add_action('cpc_admin_getting_started_shortcodes_save_hook', 'my_custom_shortcodes_save_function');
function my_custom_shortcodes_save_function($post_data) {
    // Verarbeite die Daten aus dem Formular
    // Beispiel: Speichere eine benutzerdefinierte Option
    if (isset($post_data['my_custom_shortcodes_option'])) {
        update_option('my_custom_shortcodes_option', sanitize_text_field($post_data['my_custom_shortcodes_option']));
    }
}
```

### Hook: cpc_admin_getting_started_shortcodes_hook

**Beschreibung**: Wird verwendet, um zusätzlichen Inhalt oder Anleitungen im "Erste Schritte"-Bereich für Shortcodes im Admin-Bereich anzuzeigen.

**Seit**: 0.0.1

**Parameter**: Keine

**Beispiel**:

```php
add_action('cpc_admin_getting_started_shortcodes_hook', 'my_custom_shortcodes_content');
function my_custom_shortcodes_content() {
    echo '<div class="getting-started-section">';
    echo '<h2>Willkommen zu den Shortcodes!</h2>';
    echo '<p>Hier sind einige nützliche Shortcodes, die du in deinen Seiten und Beiträgen verwenden kannst...</p>';
    echo '</div>';
}
```

### Hook: cpc_admin_getting_started_styles_save_hook

**Beschreibung**: Wird ausgelöst, wenn das Formular für die Stileinstellungen im Admin-Bereich gespeichert wird.

**Seit**: 0.0.1

**Parameter**:
- `$_POST` (Typ: array) – Die Daten, die aus dem Formular übermittelt wurden.

**Beispiel**:

```php
add_action('cpc_admin_getting_started_styles_save_hook', 'my_custom_styles_save_function');
function my_custom_styles_save_function($post_data) {
    // Verarbeite die Daten aus dem Formular
    // Beispiel: Speichere eine benutzerdefinierte Option für Stile
    if (isset($post_data['my_custom_styles_option'])) {
        update_option('my_custom_styles_option', sanitize_text_field($post_data['my_custom_styles_option']));
    }
}
```

### Hook: cpc_admin_getting_started_styles_hook

**Beschreibung**: Wird verwendet, um zusätzlichen Inhalt oder Anleitungen im "Erste Schritte"-Bereich für Stile im Admin-Bereich anzuzeigen.

**Seit**: 0.0.1

**Parameter**: Keine

**Beispiel**:

```php
add_action('cpc_admin_getting_started_styles_hook', 'my_custom_styles_content');
function my_custom_styles_content() {
    echo '<div class="getting-started-section">';
    echo '<h2>Willkommen zu den Stilen!</h2>';
    echo '<p>Hier sind einige hilfreiche Tipps zur Anpassung der Stile auf Deiner Seite...</p>';
    echo '</div>';
}
```

### Hook: cpc_admin_custom_css_form_save_hook

**Beschreibung**: Wird ausgelöst, wenn das Formular für benutzerdefiniertes CSS im Admin-Bereich gespeichert wird.

**Seit**: 0.0.1

**Parameter**:
- `$_POST` (Typ: array) – Die Daten, die aus dem Formular übermittelt wurden, einschließlich des benutzerdefinierten CSS.

**Beispiel**:

```php
add_action('cpc_admin_custom_css_form_save_hook', 'my_custom_css_save_function');
function my_custom_css_save_function($post_data) {
    // Verarbeite die Daten aus dem Formular
    // Beispiel: Benachrichtige einen Administrator oder führe zusätzliche Validierungen durch
    if (isset($post_data['cpccom_custom_css'])) {
        // Hier könnten zusätzliche Verarbeitungen oder Benachrichtigungen erfolgen
        // Zum Beispiel: Admin benachrichtigen
        wp_mail('admin@example.com', 'CSS wurde aktualisiert', 'Das benutzerdefinierte CSS wurde aktualisiert.');
    }
}
```

### Hook: cpc_admin_custom_css_form_hook

**Beschreibung**: Wird verwendet, um zusätzlichen Inhalt oder Optionen im Formular für benutzerdefiniertes CSS im Admin-Bereich anzuzeigen.

**Seit**: 0.0.1

**Parameter**: Keine

**Beispiel**:

```php
add_action('cpc_admin_custom_css_form_hook', 'my_custom_css_form_options');
function my_custom_css_form_options() {
    // Füge zusätzliche Optionen oder Erklärungen zum CSS-Formular hinzu
    echo '<tr><td colspan="2">';
    echo '<p>Hier kannst du zusätzliche Optionen oder Erklärungen zum benutzerdefinierten CSS hinzufügen.</p>';
    echo '</td></tr>';
}
```

## cpc_core.php

### Hook: cpc_forum_auto_close_hook

**Beschreibung**: Wird ausgelöst, wenn die Kommentare eines Forenbeitrags automatisch geschlossen werden.

**Seit**: unbekannt

**Parameter**:
- `int $post_id` – Die ID des Forenbeitrags, dessen Kommentare geschlossen wurden.

**Beispiel**:

```php
add_action('cpc_forum_auto_close_hook', 'my_custom_auto_close_action');
function my_custom_auto_close_action($post_id) {
    // Verarbeite den geschlossenen Beitrag weiter
    // Beispiel: Benachrichtige den Administrator oder führe eine andere Aktion durch
    wp_mail('admin@example.com', 'Forum-Kommentar geschlossen', 'Die Kommentare zu dem Beitrag mit der ID ' . $post_id . ' wurden automatisch geschlossen.');
}
```

### Hook: cpc_activity_comment_add_hook

**Beschreibung**: Wird ausgelöst, nachdem ein neuer Kommentar zu einer Aktivität hinzugefügt wurde.

**Seit**: unbekannt

**Parameter**:
- `array $post_data` – Die Daten, die beim Hinzufügen des Kommentars gesendet wurden (aus `$_POST`).
- `int $comment_id` – Die ID des neu hinzugefügten Kommentars.

**Beispiel**:

```php
add_action('cpc_activity_comment_add_hook', 'my_custom_comment_add_action', 10, 2);
function my_custom_comment_add_action($post_data, $comment_id) {
    // Verarbeite den neuen Kommentar weiter
    // Beispiel: Sende eine Benachrichtigung oder führe eine andere Aktion aus
    $comment_content = isset($post_data['comment_content']) ? $post_data['comment_content'] : '';
    $comment_author = isset($post_data['comment_author']) ? $post_data['comment_author'] : '';
    wp_mail('admin@example.com', 'Neuer Kommentar hinzugefügt', "Ein neuer Kommentar von $comment_author wurde hinzugefügt: $comment_content");
}
```

### Hook: cpc_activity_post_add_hook

**Beschreibung**: Wird ausgelöst, wenn ein neuer Beitrag zur Aktivität hinzugefügt wird. Dieser Hook wird verwendet, um Benachrichtigungen für neue Beiträge zu senden.

**Seit**: 0.0.1

**Parameter**:
- `array $the_post` – Die Daten des Beitrags (aus `$_POST` oder `get_post()`).
- `array $the_files` – Die Dateianhänge, die mit dem Beitrag verbunden sind.
- `int $new_id` – Die ID des neu hinzugefügten Beitrags.

**Beispiel**:

```php
add_action('cpc_activity_post_add_hook', 'my_custom_post_add_alerts', 10, 3);
function my_custom_post_add_alerts($the_post, $the_files, $new_id) {
    // Verarbeite die Benachrichtigung hier weiter
    $author_id = $the_post['cpc_activity_post_author'];
    $message = sprintf('Neuer Beitrag von %s: %s', get_user_by('id', $author_id)->display_name, $the_post['cpc_activity_post']);
    wp_mail('admin@example.com', 'Neuer Aktivitätsbeitrag', $message);
}
```

### Hook: cpc_alert_add_hook

**Beschreibung**: Dieser Hook wird ausgelöst, nachdem eine neue Benachrichtigung (Alert) erstellt und gespeichert wurde. Er ermöglicht es anderen Plugins oder Funktionen, zusätzliche Aktionen auszuführen, sobald die Benachrichtigung erstellt wurde.

**Seit**: Unbekannt

**Parameter**:
- `int $recipient_id` – Die ID des Benachrichtigungsempfängers. Dies ist der Benutzer, der die Benachrichtigung erhält.
- `int $alert_id` – Die ID des neu erstellten Benachrichtigungsbeitrags.
- `string $url` – Die URL, die auf die Seite verweist, auf der der Benutzer die vollständige Benachrichtigung sehen kann.
- `string $message` – Die Nachricht, die in der Benachrichtigung enthalten ist.

**Beispiel**:

```php
add_action('cpc_alert_add_hook', 'my_custom_alert_add_action', 10, 4);
function my_custom_alert_add_action($recipient_id, $alert_id, $url, $message) {
    // Führe zusätzliche Aktionen durch, z.B. Protokollierung oder zusätzliche Benachrichtigungen
    $recipient = get_user_by('id', $recipient_id);
    $log_message = sprintf('Benachrichtigung #%d für Benutzer %s erstellt. URL: %s, Nachricht: %s', $alert_id, $recipient->user_login, $url, $message);

    // Schreibe in ein Protokoll
    error_log($log_message);
}
```

### Hook: cpc_activity_init

**Beschreibung**: Dieser Hook wird verwendet, um JavaScript- und CSS-Ressourcen für die Aktivitäts-Komponente des Plugins zu registrieren und zu laden. Außerdem ermöglicht er es anderen Plugins oder Themes, zusätzliche Skripte und Stile einzufügen, indem der Hook cpc_activity_init_hook aufgerufen wird.

**Seit**: 0.0.1

**Parameter**: Keine

**Funktionsweise**:

- JavaScript einbinden: Lädt das Haupt-JavaScript für die Aktivitätsfunktionalität des Plugins und lokalisiert es, um PHP-Variablen für die clientseitige Nutzung bereitzustellen.
- CSS einbinden: Lädt das CSS für die Stilgestaltung der Aktivitätsfunktionalität des Plugins.
- Select2-Bibliothek: Lädt die Select2 JavaScript- und CSS-Dateien, die für Dropdown-Listen verwendet werden.
- Zusätzliche Hooks: Ermöglicht anderen Plugins oder Themes, zusätzliche Skripte oder Stile einzufügen.

**Beispiel**:

```php
add_action('wp_enqueue_scripts', 'cpc_activity_init');
function cpc_activity_init() {
    // JavaScript-Datei einbinden
    wp_enqueue_script('cpc-activity-js', plugins_url('cpc_activity.js', __FILE__), array('jquery'));
    
    // JavaScript lokalisieren, um PHP-Variablen verfügbar zu machen
    wp_localize_script('cpc-activity-js', 'cpc_activity_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'plugins_url' => plugins_url('', __FILE__),
        'activity_post_focus' => get_option('cpccom_activity_set_focus')
    ));
    
    // CSS-Datei einbinden
    wp_enqueue_style('cpc-activity-css', plugins_url('cpc_activity.css', __FILE__), array(), '1.0.0');
    
    // Select2-Bibliothek einbinden
    wp_enqueue_script('cpc-select2-js', plugins_url('../js/select2.js', __FILE__), array('jquery'), '4.0.13', true);
    wp_enqueue_style('cpc-select2-css', plugins_url('../js/select2.css', __FILE__), array(), '4.0.13');
    
    // Zusätzliche Hooks für andere Plugins oder Themes
    do_action('cpc_activity_init_hook');
}
```

**Hinweis**:

Dieser Hook stellt sicher, dass alle erforderlichen Ressourcen für die Aktivitätsfunktionalität geladen werden.
Der Hook cpc_activity_init_hook ermöglicht es anderen Entwicklern, zusätzliche Ressourcen hinzuzufügen, ohne die Kernfunktionalität zu überschreiben.








