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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```

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
}```




