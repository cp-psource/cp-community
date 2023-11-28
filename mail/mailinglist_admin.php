<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>

<?php
echo '<h2>'.sprintf(__('%s Einstellungen', CPC2_TEXT_DOMAIN), CPC_WL).'</h2><br />';

__cpc__show_tabs_header('replybyemail');

	
	if (isset($_POST['check_pop3']) && $_POST['check_pop3'] == 'get') {
		__cpc__check_pop3(true,true);
		$_SESSION['__cpc__mailinglist_lock'] = '';
	}
	if (isset($_POST['check_pop3']) && $_POST['check_pop3'] == 'check') {
		__cpc__check_pop3(true,false);
		$_SESSION['__cpc__mailinglist_lock'] = '';
	}
	
	if (isset($_POST['check_pop3']) && $_POST['check_pop3'] == 'delete') {
			
		if (!isset($_SESSION['__cpc__mailinglist_lock']) || $_SESSION['__cpc__mailinglist_lock'] != 'locked') {
			
			$_SESSION['__cpc__mailinglist_lock'] = 'locked';
						
			global $wpdb;
			
		
			$server = get_option(CPC_OPTIONS_PREFIX.'_mailinglist_server');
			$port = get_option(CPC_OPTIONS_PREFIX.'_mailinglist_port');
			$username = get_option(CPC_OPTIONS_PREFIX.'_mailinglist_username');
			$password = get_option(CPC_OPTIONS_PREFIX.'_mailinglist_password');

			echo '<h3>'.__('Löschen von POP3-Postfachinhalten', CPC2_TEXT_DOMAIN).'</h3>';
			
			if ($mbox = imap_open ("{".$server.":".$port."/pop3}INBOX", $username, $password) ) {
				
				echo __('Verbunden', CPC2_TEXT_DOMAIN).', ';
				
				$num_msg = imap_num_msg($mbox);
				echo __('Anzahl der zu löschenden Nachrichten', CPC2_TEXT_DOMAIN).': '.$num_msg.'<br />';
		
				if ($num_msg > 0) {

					for ($i = 1; $i <= $num_msg; ++$i) {

        				// Delete from mailbox
						imap_delete($mbox, $i);	
						
					}
				} else {
					
					echo __('Keine Nachrichten gefunden', CPC2_TEXT_DOMAIN).'.';
					
				}

				// purge deleted mail
				imap_expunge($mbox);
				// close the mailbox
				imap_close($mbox); 
				
			} else {
			
				echo __('Problem bei der Verbindung zum Mailserver', CPC2_TEXT_DOMAIN).': ' . imap_last_error().' '.__('(oder keine Internetverbindung)', CPC2_TEXT_DOMAIN).'.<br />';		
				echo __('Überprüfe die Adresse Ihres Mailservers und die Portnummer, den Benutzernamen und das Passwort', CPC2_TEXT_DOMAIN).'.';
				
			}
			
			$_SESSION['__cpc__mailinglist_lock'] = '';
			
		} else {
			if ($output) echo __('Wird gerade verarbeitet, bitte versuche es in ein paar Minuten erneut.', CPC2_TEXT_DOMAIN).'.<br />';		
		}
	}
	
	if( isset($_POST[ 'cpcommunitie_update' ]) && $_POST[ 'cpcommunitie_update' ] == 'cpcommunitie_plugin_mailinglist' ) {
	
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_server', isset($_POST[ 'cpcommunitie_mailinglist_server' ]) ? $_POST[ 'cpcommunitie_mailinglist_server' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_port', isset($_POST[ 'cpcommunitie_mailinglist_port' ]) ? $_POST[ 'cpcommunitie_mailinglist_port' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_username', isset($_POST[ 'cpcommunitie_mailinglist_username' ]) ? $_POST[ 'cpcommunitie_mailinglist_username' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_password', isset($_POST[ 'cpcommunitie_mailinglist_password' ]) ? $_POST[ 'cpcommunitie_mailinglist_password' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_prompt', isset($_POST[ 'cpcommunitie_mailinglist_prompt' ]) ? $_POST[ 'cpcommunitie_mailinglist_prompt' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_divider', isset($_POST[ 'cpcommunitie_mailinglist_divider' ]) ? $_POST[ 'cpcommunitie_mailinglist_divider' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_divider_bottom', isset($_POST[ 'cpcommunitie_mailinglist_divider_bottom' ]) ? $_POST[ 'cpcommunitie_mailinglist_divider_bottom' ] : '');
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_cron', isset($_POST[ 'cpcommunitie_mailinglist_cron' ]) ? $_POST[ 'cpcommunitie_mailinglist_cron' ] : 900);
		update_option(CPC_OPTIONS_PREFIX.'_mailinglist_from', isset($_POST[ 'cpcommunitie_mailinglist_from' ]) ? $_POST[ 'cpcommunitie_mailinglist_from' ] : '');

		__cpc__check_pop3(true,false);
		$_SESSION['__cpc__mailinglist_lock'] = '';
	
	    // Put an settings updated message on the screen
		echo "<div class='updated slideaway'><p>".__('Speichern', CPC2_TEXT_DOMAIN).".</p></div>";
		
	}
	
	?>
		
	<form action="" method="POST">
	
			<input type="hidden" name="cpcommunitie_update" value="cpcommunitie_plugin_mailinglist">
				
			<table class="form-table __cpc__admin_table"> 

			<tr><td colspan="2"><h2><?php echo __('Einstellungen', CPC2_TEXT_DOMAIN); ?></h2></td></tr>
		
			<tr><td colspan="2">
				<?php echo __('Ermöglicht es Mitgliedern, per E-Mail auf Forenthemen zu antworten (indem sie auf die erhaltene Benachrichtigung antworten).', CPC2_TEXT_DOMAIN); ?><br />
				<?php
				$cron = _get_cron_array();
				$schedules = wp_get_schedules();
				$date_format = _x( 'M j, Y @ G:i', 'Datumsformat der Veröffentlichungsbox', CPC2_TEXT_DOMAIN);
				foreach ( $cron as $timestamp => $cronhooks ) {
					foreach ( (array) $cronhooks as $hook => $events ) {
						foreach ( (array) $events as $key => $event ) {
							if ($hook == '__cpc__mailinglist_hook') {
								if ($timestamp-time() < 0) {
									echo __('Nächster geplanter Lauf', CPC2_TEXT_DOMAIN).': '.date_i18n( $date_format, $timestamp ).'<br />';
								} else {
									echo __('Nächster geplanter Lauf', CPC2_TEXT_DOMAIN).': '.date_i18n( $date_format, $timestamp ).' ';
									echo '('.sprintf(__('in %d Sekunden', CPC2_TEXT_DOMAIN), $timestamp-time()).').<br />';
								}
							}
						}
					}
				}
				
				?>
				<?php echo __('Klicke auf die Schaltfläche unten, um nach Antworten per E-Mail zu suchen und sie zum Forum hinzuzufügen (dies kann einige Minuten dauern).', CPC2_TEXT_DOMAIN); ?>
			</td></tr>
			
			<tr><td colspan="2">
			
			</td></tr>
			
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_server"><?php echo __('Server', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_server" type="text" id="cpcommunitie_mailinglist_server"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_server'); ?>" /> 
			<span class="description"><?php echo __('Server-URL oder IP-Adresse, z. B.: mail.example.com', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
															
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_port"><?php echo __('Port', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_port" type="text" id="cpcommunitie_mailinglist_port"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_port'); ?>" /> 
			<span class="description"><?php echo __('Vom Mailserver verwendeter Port, z. B.: 110', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_username"><?php echo __('Benutzername', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_username" type="text" id="cpcommunitie_mailinglist_username"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_username'); ?>" /> 
			<span class="description"><?php echo __('Benutzername des E-Mail-Kontos', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_password"><?php echo __('Passwort', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_password" type="password" id="cpcommunitie_mailinglist_password"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_password'); ?>" /> 
			<span class="description"><?php echo __('Passwort des Mailkontos', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_from"><?php echo __('E-Mail gesendet von', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_from" type="text" id="cpcommunitie_mailinglist_from"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_from'); ?>" /> 
			<span class="description"><?php echo __('E-Mail-Adresse, an die geantwortet werden soll, z. B.: forum@example.com', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_prompt"><?php echo __('Eingabeaufforderung', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input style="width: 400px" name="cpcommunitie_mailinglist_prompt" type="text" id="cpcommunitie_mailinglist_prompt"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_prompt'); ?>" /> 
			<span class="description"><?php echo __('Textzeile, die als Eingabeaufforderung für die Eingabe des Antworttexts angezeigt wird', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_divider"><?php echo __('Oberer Teiler', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input style="width: 400px" name="cpcommunitie_mailinglist_divider" type="text" id="cpcommunitie_mailinglist_divider"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_divider'); ?>" /> 
			<span class="description"><?php echo __('Die obere Grenze, wo Antworten eingegeben werden sollten', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_divider_bottom"><?php echo __('Unterer Teiler', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input style="width: 400px" name="cpcommunitie_mailinglist_divider_bottom" type="text" id="cpcommunitie_mailinglist_divider_bottom"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_divider_bottom'); ?>" /> 
			<span class="description"><?php echo __('Die untere Grenze, wo Antworten eingegeben werden sollten', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			<tr valign="top"> 
			<td scope="row"><label for="cpcommunitie_mailinglist_cron"><?php echo __('Frequenz prüfen', CPC2_TEXT_DOMAIN); ?></label></td> 
			<td><input name="cpcommunitie_mailinglist_cron" type="text" id="cpcommunitie_mailinglist_cron"  value="<?php echo get_option(CPC_OPTIONS_PREFIX.'_mailinglist_cron'); ?>" /> 
			<span class="description"><?php echo __('Häufigkeit (in Sekunden) zur Überprüfung, verwendet den Cron-Zeitplan von ClassicPress, erfordert also, dass Deine Webseite besucht wird. Nicht zu niedrig!', CPC2_TEXT_DOMAIN); ?></td> 
			</tr> 
	
			</table> 	
		 
			<div style='margin-top:25px; margin-left:6px; float:left;'> 
			<input type="submit" name="Submit" class="button-primary" value="<?php echo __('Änderungen speichern', CPC2_TEXT_DOMAIN); ?>" /> 
			</div> 
			
	</form>		
	<form action="" method="POST">
		<input type='hidden' name='check_pop3' value='get' />
		<input type="submit" name="submit" class="button-primary" style="float:left;margin-top:25px; margin-left:10px;" value="<?php echo __('Jetzt auf Antworten prüfen und bearbeiten', CPC2_TEXT_DOMAIN); ?>" /> 
	</form>
	<form action="" method="POST">
		<input type='hidden' name='check_pop3' value='check' />
		<input type="submit" name="submit" class="button-primary" style="float:left;margin-top:25px; margin-left:10px;" value="<?php echo __('Jetzt auf Antworten prüfen (aber keine bearbeiten)', CPC2_TEXT_DOMAIN); ?>" /> 
	</form>
	<form action="" method="POST">
		<input type='hidden' name='check_pop3' value='delete' />
		<input type="submit" name="submit" class="button-primary" style="margin-top:25px; margin-left:10px;" value="<?php echo __('Lösche den Inhalt des POP3-Postfachs', CPC2_TEXT_DOMAIN); ?>" /> 
	</form>
		
<?php __cpc__show_tabs_header_end(); ?>
	
</div>
