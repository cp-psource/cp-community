=== CP Community ===
Contributors: Robertd62
Tags: wp community, social network, social networking, social media, cpcymposium pro, cp-community, wp community, community
Donate link: https://www.cpcymposiumpro.com/
Requires at least: 5.0
Tested up to: 6.0
Stable tag: 1.0.0
License URI: https://www.gnu.org/licenses/gpl-2.0.html
== Description ==

**This is the ultimate social network plugin for ClassicPress.** You can create your own social network, on your ClassicPress website.

With profiles, activity (wall), unlimited forums, friends, email alerts and so much more, it's perfect for clubs, schools, interest groups, engaging with customers, support sites, gaming sites, dating sites, limited only by your imagination! 

ust add the plugin, click a button and you have your own social network, simple as that. :)

**Incredibly compatible**

Incredibly compatible with themes and plugins. Find out more, including additional plugins for CP Community, at https://n3rds.work.

**Massively customizable**

Want to change something, the layout, text, button labels? CP Community’s real power lies behind shortcodes with options galore, that allow you to change just about everything, and design your social network pages the way you want them!

**Multi-lingual site?**

No problem! Easily change all the text your users will see through options. Using WPML? Works happily with that plugin too!

**And there's even more...!**

Extra extensions are available that add features galore! Private messages, groups, forum subscriptions, choose who to share activity with, image and YouTube attachments, galleries,  profile security and many (many) more! Please note that these are available as optional extensions via https://n3rds.work.

And you can get the Extensions plugin, right now, for a CRAZY low Price!

**Find out more**

Find out all about it, and more, at https://n3rds.work.

Oh, and drink tea, tea is good...

== Installation ==

Go to plugins in your admin dashboard and click Add New, and search for CP Community.

Once activated, to get started quickly, go to CP Community->Setup (a new menu item), and click on the "Add Profile Pages" button (once).

Erm... that's it!

This will install a default profile page (with activity, etc), an edit profile page, a change avatar page and a friendships.

Then click on the "Add Forum" button for as many forums as you want!

You may then want to add your new ClassicPress pages to your site menu via Appearance->Menus.

An online admin guide (Codex) is available at www.cpcymposiumpro.info.

To manually install, download the ZIP file, extract contents and place in wp_content/cp-community folder.

== Frequently Asked Questions ==

The best source of news and information is the CP Community blog at the online Admin Guide (Codex) at https://www.cpcymposiumpro.com/frequently-asked-questions/, it's constantly kept up-to-date with news, updates, articles and tips. Or you can try out the plugin at https://n3rds.work.

== Screenshots ==

The best way to see it in action, and try it out for free, is visit https://n3rds.work !

== Changelog ==
2022.5        Fixed soe files to run with WP 6
2022.01        Corredtd some php for the upcoming WP release. 
2021.10       Cleaning files
2021.08        Fixed for WP 5.8
2021.07       Fixed php in extensions shortcodes
2021.05       testing in wp 5.7.2
2021.03      Testes up to WP 5.7
2021.02		Testing in PHP 5.8
2021.01    Minor php fixes
2020.10     Monor tweak in php
2020.09.1  Fixed the 91 links in the Set-up to the help files for each feature.
2020.09  Fixed Php calls in Dorectory php
020.06  Some changes for wp 5.4
2019.11  Minor code fixed for WP 5.3
2019.10  Minor updates for WP 5.2.3
2019.05 fixed wording 
20.03   Minor Fixes for ClassicPress 5.1
19.10.1 Minor fixes  
19.10   Minor Fixes for ClassicPress 5
18.10   More Minor Fixes for ClassicPress 5
18.07   More fixes for ClassicPress 5
18.05   Fixed to run with WOrdPress 5  
18.04   Smalled fixes for stabilization for WP 5
18.01  Preparing for Wordpress 5.0 release
17.10  Fixed Mandatory required om Register page
         Fixed Link for Report Users    
		 
17.09   Fixed mandatory setings in  edit Profile

17.08    Changed link to website to promote low price. 

17.07.01 Fixed activity attachment delete bug

17.06    Fixed bug in Edit Profile page that caused sidebar to move to bottom of profile info.

17.05    Removed select2 from admin
		 Removed global CPC button style, to put back, add the following CSS to your site:
		 
			.cpc_button {
				background-color: #E6E6E6;
				background-image: linear-gradient(to bottom, #FFFFFF 0px, #E0E0E0 100%);
				background-repeat: repeat-x;
				border: 1px solid #D2D2D2;
				border-radius: 3px;
				box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075);
				color: #7C7C7C;
				font-size: 13px;
				font-weight: normal;
				line-height: 19.5px;
				padding: 3px 10px 3px 10px;
			}

			.cpc_button:active {
				background-image: linear-gradient(to top, #FFFFFF 0px, #E0E0E0 100%);
			}

			.cpc_button:hover {
				color: #000;
			}
		 

17.02.b  Change Avatar: Fixed problem with avatar_style parameter and set default height/width of thumbnail to 250 pixels (from 100).

17.01.01 Fixed problem with saving shortcode options with global styles switched on

17.01    Change Avatar: new options for [cpc-avatar] to offer popup version to change avatar. Also available for [cpc-avatar-change-link], but shares other values from [cpc-avatar].
         Profile: Added 'firstlast' as an option to [cpc-display-name] to show first and last name, instead of display name.
         Edit Profile: Added default tab on CP Community->Setup->Edit Profile page (when using tabs for profile information)
         Updated back-end version of SimpleImage crop command (from cut)

16.12    Styles! This will be work in progress, but we have added a new admin section to easily setup global styles for your site.
         Profiles/Friends: Can now make a profile a favourite with [cpc-favourite-friend], also via Friends page. Favourite friends will appear at the top of the list of friends, before non-favourites. Needs to be a friend to appear on the friends page.
         Forums: Added forum_count_include_replies to set if to base poster & freshness on latest reply (not count which is always posts only)? [cpc-forums].
         Forums: With [cpc-forum-children] you can already list child forums. Now you can also show recent posts/replies. See CP Community->Shortcodes->Forum->[cpc-forum-children]. 

16.11    Edit Profile: Set default/mandatory for town/city and country (Shortcodes->Profile->[cpc-usermeta-change])
         Avatar: Can now translate flip/rotate/etc for avatar upload (Shortcodes->Avatar->[cpc-avatar-change])
         Profile: Profile page shows correctly for users who have space in the user login

16.09    Marked as compatible with ClassicPress 4.6.1

16.08    Change Avatar: Flip, rotate and add effects to your uploaded avatar image! Activate in CP Community->Shortcodes->Change Avatar. Select effects to show in CP Community->Setup->Edit Profile.
         Change Avatar: Added step1 and step2 as options for [cpc-avatar-change].
         Friends: New shortcode [cpc-friends-count] to show accepted/pending friends. See CP Community->Shortcodes->Friends.
         Forums: New "no_posts" option for [cpc-forum-show-posts] to set text if no posts/replies/comments to show. See CP Community->Shortcodes->Forums->[cpc-forum-show-posts].
         Friends: Can now style %f if used in menus, with class "cpc_pending_friends_count".
         Alerts: Timestamp changed to local "blog" time.
         Favourites: Fixed as stopped working with activity loaded via AJAX.
         Usermeta: New shortcode [cpc-user-id] that outputs the current user's ID, or if on a user's profile page, the ID of that user.

16.07    Forums: New replies and comments are now taken into account for forum "NEW" highlights
         Forums: Content considered new if added in a time limit (seconds) set in CP Community->Shortcodes->Forums->[cpc-forums]->"How long content stays "new" for". Note this is not related to when a user last logged in (which can lead to an overload of "new" content). For info, 259200 seconds equates to 3 days. It is recommended to check the option below "Mark read items as no longer new".
         Forums: New option for [cpc-forum] "topic_action". Can direct viewers of a topic to first or last page (see CP Community->Shortcodes->Forums->[cpc-forum]->"For both styles...").
         Forums: [cpc-forum-comment] renamed as [cpc-forum-reply] so more accurate, both still work.
         Forums: New setup option (CP Community->Setup->Forum) to limit the length of URLs for links to individual forum posts.
         Forums: Set "read" text of link to forum post for [cpc-forum-show-posts].
         Forums: Can disable timeouts, so forum replies can always be edited.
         Friends: Can put %f in a menu item to show pending friendship count.
         Edit Profile: Password strength meter added, can be disabled/customised via CP Community->Setup->Edit Profile.
         Alerts: New setup option to retry failed sent alerts (keep an eye on the Alerts), should not be necessary to set this.
         Alerts: Improved failed messages and shows if re-trying
         Admin: On CP Community->Setup page, click on icons beside links to show on the main admin bar 
         Admin: CP Community submenu items now ordered alphabetically.
         Admin: New option on CP Community->Setup->Edit Profile page to hide "Receive email notifications for activity".
         Admin: Use http://www.example.com/wp-admin/admin.php?page=cpc_com_setup&cpc_deactivate_all=1 to de-activate all core and extension features (for admin use only)
         Marked as compatible with ClassicPress v4.5.3.

16.06    Activity: Massive improvement with use of AJAX for posts and comments, and paging with "more..." button
         Activity: Added get_max_friends to [cpc-activity] shortcode to fine-tune performace. See CP Community->Shortcodes->Activity.
         Usermeta: Now logs when user logins in, and records previous login.
         Usermeta: New shortcodes [cpc-last-active] and [cpc-last-logged-in].
         Forums: New forum posts since previous login are now optionally highlighted, see CP Community->Shortcodes->[cpc-forum]->"For both styles...".
         Forums: Can now set individual auto-close period on forums via Manage All Forums->Edit.
         Forums: Automatic redirect in admin skips taxonomy edit for all forums, redirects to Manage All Forums instead (cleaner, avoids adding forum via taxonomy).
         Forums: New option pagination_above for [cpc-forum] to enable pagination above forum topic post. 
         Forums: When reply to a forum post, last page is now shown (if pagination on and applicable).
         CP Community->Shortcodes->[cpc-forum]->"For single topic view...".         
         SEO: Updated to support latest ClassicPress and Yoast SEO filters.

16.05.03 Forums: Can now set No replies, 1 reply (etc.) text via CP Community->Shortcodes->Forums->[cpc-forum].

16.05.02 Setup: Can now select which core features to enabled
         Avatar: Can now set maximum file upload size (CP Community->Shortcodes->Avatar->[cpc-avatar-change])
		 Marked as compatible with ClassicPress v4.5.2
		 
16.05.01 Forums: Fix to support Arabic characters, etc.
         Forums: Fix to editing posts when content sometimes didn't show.
         Forums: Improved speed of [cpc-forums] and [cpc-forum] shortcodes.
         Forums: Added pagination to [cpc-forum] shortcode, see options under CP Community->Shortcodes->Forum->cpc_forum (For both styles...). Note that pagination and the option to show/hide closed topics cannot operate together. If pagination is enabled, the closed topics checkbox is automatically hidden. Removed max_forum_posts. New pagination options.
         Tags: If you @tag someone that doesn't exist, no link is created. You can type @user_login into forums with WYSIWYG toolbar, but no pop-up to select, but they will be get converted into links.
         Activity: Added parsing to remove tags for security reasons.

16.05    Alerts: Improved notice when user chosen not to receive alerts by email (CP Community->Setup->Manage Alerts)
         Forum: New option for [cpc-forum]. Set header_freshness to change title of freshness column (table style)
         Forums: Via "Manage All Forums" (CP Community->Setup), you can now delete forums
         Avatar: New option for [cpc-avatar]. Set user_id="user" to always show current user, or the ID of a Avatar: User meta cpc_com_avatar updated with path when uploading custom avatar.
         Profile: Missing shortcode added CP Community->Shortcodes->Profile page for [cpc-display-name], which includes option of user="user" to always show current user, or set to show dependent on context of page.
         ClassicPress user. Default will show avatar based on context of page in the site.
         Miscellaneous: Fix for compatibility with BBpress (https://codex.bbpress.org/bbp_setup_current_user/was-called-incorrectly/).
         Marked as compatible with ClassicPress v4.5.1

16.04.02 Forum: New option for [cpc-forum-post]. Set slug="choose" to give users choice of forum to post to.
         Forum: Fix to show report option when post/reply/comment not owned by user.
         Forum: Set additional forum admin(s) via CP Community->Shortcode->cpc_forum (single post view).
         Forum: Can choose if original topic author is shown for table style of cpc-forum via CP Community->Shortcode->cpc_forum (For table style...).
         Forum: Fix to cpc-forum (table style) that caused reply count to show in wrong place.
         Forum: New option to [cpc-forums]. Set include="all" or "private" or "public" to filter forums shown.
         Forum Activity: Fixed bug for email alerts for activity comments in some circumstances.
         Forum: New shortcode! Added [cpc-is-forum-single-post]XXX[/cpc-is-forum-single-post]. Find under CP Community->Shortcodes->Conditional.
         Forum: New shortcode! Added [cpc-is-forum-posts-list]XXX[/cpc-is-forum-posts-list]. Find under CP Community->Shortcodes->Conditional.
         Avatar: Can now also set [cpc-avatar] size as a % (or enter a number for pixels).
         Shortcodes admin page: Renamed "General" to "Conditional".         
         Marked as compatible with ClassicPress v4.5

16.04.01 Activity: Report option (via email) added, modify via CP Community->Shortcodes->Activity->cpc-activity
         Forums: Report option (via email) added, modify via CP Community->Shortcodes->Forums->cpc-forum (single post view)
         Forums: Select to show oldest or newest replies first via CP Community->Shortcodes->Activity->cpc-forum

16.04    Shortcode: Added [cpc-is-logged-in]CONTENT[/cpc-is-logged-in]
         Shortcode: Added [cpc-not-logged-in]CONTENT[/cpc-not-logged-in]
         Forums: New option to only allow one reply per user. See CP Community->Shortcodes->Forum->[cpc-forum-comment]
         Usermeta: Added option for [cpc-usermeta meta="ID"] so can insert "current user" value to page/widget/etc
         Removed cpc_config.php, only value set moved to CP Community->Shortcodes->cpc-forum->"Topics to query from database"
         Shortcodes admin page: New section added "General", with applicable shortcodes moved there.

16.03.01 Shortcode: Added [cpc-user-exists-content]CONTENT[/cpc-user-exists-content]
         Shortcode: Added [cpc-is-friend-content]CONTENT[/cpc-is-friend-content]
         Find options for shortcode under CP Community->Shortcodes->Profile.
         Both shortcodes will also hide CONTENT if the visitor is not logged in.
         Default activity page changed to include above shortcodes (CP Community->Setup).
         
16.03    Forums: New option "allow_close" for [cpc-forum-comment] to set if users can close their own posts.
         Forums: Empty forum comments no longer cause bug.
         Forums: New show_as_dropdown shortcode option for [cpc-forums] to show quick jump dropdown list, can be modified via CP Community->Shortcodes->Forums.
         Profile: New shortcode [cpc-no-user-check] to show user not found message from above if user not valid
         Profile: Added Friend Requests Label as option to [cpc-activity-page]
         Usermeta: New shortcode [cpc-user-exists-content]CONTENT[/cpc-user-exists-content] where CONTENT will only be shown if a valid user can be found
         Friends: Remove all friends now optional and text can be changed via CP Community->Shortcodes->Friends. If you want to show this on Friends page, but have [cpc-friends] on a widget and you don't want the link to show there, remember that you can hide link in widget shortcode with remove_all_friends="0".
         CSS: cpc_submit class removed, all CPC buttons use cpc_button class, can be changed via CP Community->Setup->Custom CSS

16.02.03 Added option in CP Community->Settings->System Options "Feed" to exclude comments from feeds (RSS, etc).

16.02.02 Version change to match Extensions plugin

16.02.01 Translations: User can be offered languages to view the website in (see CP Community->Translations)
         Friends: new option to remove all friends on user's friends page
         Fix to improve ClassicPress content feeds for comments

16.02    Forums: New shortcode [cpc-forum-children] to display child forums as setup via CP Community->Setup->Manage All Forums->Edit ("Parent"). Can set shortcode options as with all shortcodes, via CP Community->Shortcodes.
         Identified vulnerability patch
         Minor bug fixes
         Marked as compatible with ClassicPress v4.4.2
         
16.01.01 Identified vulnerability patch
         Marked as compatible with ClassicPress v4.4.1

16.01    Security patch to address two issues, including a critial vulnerability that would permit accounts to be attacked.
         Forums: Limit sticky post option to admins only (via Dashboard->Setup->Forums)
         Activity: Limit sticky post option to admins only (via Dashboard->Setup->Profile Page)
         Alerts: Option to permenantly remove successfully sent alerts (also removes from use on site!)
        
15.12    Styles: can now globally switch off shortcode CSS wrapper styles (via CP Community->Shortcodes and then on any shortcode set of options). For slight increase in performance and less markup, and to make manually applying CSS easier.
         Activity "Only friends can post here" changed to "You do not have permission to post here" as may be a friend, but not allowed to post to activity.
         Activity: Added "Group Activity" on Setup->Groups to exclude group activity from other users in profile activity feed.
         Multiple minor bug fixes.

15.11    Edit Profile: If there is a problem when saving, the Tab with the problem in it also highlights as error, so if not on current tab, is clearer.
         Activity: Added active_friends as option to [cpc-activity] to assist in performance increase
         Forum: Improved CSS of mobile forum post view, including removal of initial post author avatar
         Core: Added constraint as second parameter to cpc_get_friends()

15.10    Forums: Added hide_initial to [cpc-forum] to set if to show post title on page 2+ if using pagination
         Forums: Fixed bug to show comments when a topic is closed (were previously not showing)
         Various minor bug fixes.

15.8     Avatars now link to profile pages on activity, directory and forums
         Edit Profile: Added required_msg to [cpc-usermeta-change] (message for mandatory fields)
         New CP Community->Setup->Profile Page option to set if an alert is sent when an activity post is sent to all friends 
         New CP Community->Setup->Profile Page option to set if focus is set to new activity post textarea on page load
         New Setup->System Options option ("HTTPS detection") which forces true to be returned when checking for presence of HTTPS server (known to overcome some situations when detection fails)

15.7     Choose where admin links appear (Setup page or Admin dashboard menu) 
         Option to hide Welcome header on setup page

15.5     Admin: New Shortcodes section to easily view and change all the settings for CP Community shortcodes!
         Admin: Add styles to all shortcodes (can avoid with styles="0" on a shortcode)
         Edit Profile: Organise into Tabs via new CP Community->Setup section for Edit Profile
         Activity: Added background_icon as option to [cpc-activity-post]
         Forum: Removed limit of 10 comments shown on forum replies
         Forum: Fixed bug with show_closed on [cpc-forum] shortcode
         Forums: Added show_closed as new option to [cpc-forums]         
         Profile: Added link as option to [cpc-usermeta] (if meta value is user_email)
         Profile: Added the following as valid for meta option for [cpc-usermeta]: 'display_name', 'user_login', 'user_nicename', 'user_email', 'user_url', 'user_registered', 'user_status'
         System: Resets alert cron job after plugin activation (eg. after updates)

15.4     Alerts: Added option to delete all from drop-down alerts list (change with [cpc-alerts-activity delete_all_text="example"]
         Alerts: Added option to remove alert from list, when clicked on, ie. [cpc-alerts-activity delete_on_click="1"]
         Forums: Renamed cpc_forum_comment_add_hook hook to cpc_forum_reply_add_hook.
         Dashboard: CPC icon only shown on All Users page to administrators (to counter some plugins)

15.2     Forums: Added multiline as option to [cpc-forum-post] to control lines in forum post title
         Groups: Fix to order_by option for [cpc-groups]
         Activity: Added logged_out_msg and login_url (for message shown on activity when not logged in)
         Activity: When deleting an activity post or comment, corresponding alerts are deleted (emails may already have been sent!)
         Edit Profile: Added name as option to [cpc-usermeta-change], set to "" to hide
         Edit Profile: Added logged_out_msg and login_url to [cpc-usermeta-change]
         Change Avatar: Added logged_out_msg and login_url to [cpc-avatar-change]
         Friends: Added logged_out_msg and login_url to [cpc-friends]
         Filter: Changed apply_filters( 'cpc_forum_item_content_filter', $post_content, $post, $atts )
         Filter: Changed apply_filters( 'cpc_forum_item_sub_comment_content_filter', $sub_comment_content, $subcomment, $atts )
         Started to introduce helpful admin tips on front end (can be dismissed and only shown to site administrators)
         
15.1.2   Fixed bug stopping images being inserted into posts/pages via media library
15.1.1   Fixed bug with forum pagination

15.1     New style option for forums to offer alternative layouts, with following new options for [cpc-forum]:
            'style' => 'table' (look and feel, table|classic, set to classic for alternative layout)
            'started' => 'Started by %s %s'
            'replied' => 'Last replied to by %s %s'
            'commented' => 'Last commented on by %s %s'
            'size_posts' => 96
            'size_replies' => 48
            'post_preview' => 250
            'reply_preview' => 120
            'view_count_label' => 'VIEW' (singular)
            'views_count_label' => VIEWS' (plural)
            'reply_count_label' => 'REPLY' (singular)
            'replies_count_label' => 'REPLIES' (plural)
         Note that views starting counting from installation, and exclude post owner views of the post
         Add a featured image to forums (CP Community->Forum Setup->Edit) to include with [cpc-forums]. Also added featured_image_width as an option (px).
         To hide town and country from edit profile set shortcode option town="" and country="" (or just one of them as applicable)
         Added cpc_activity_post_post_form_filter filter to [cpc-activity-post]
         Users are not subscribed to activity alerts by default, to support local laws about opting in

14.12.2  Activity: Added additional parameter to cpc_activity_item_filter (see Hooks and Filters index in book)
         Activity: Added stick_others as option to [cpc-activity] to choose whether other's sticky posts stick on own activity stream
         Activity: Site admin's can now stick/delete/hide all activity posts
         Activity: Fixed ability to delete comments (to activity posts) by comment owner, parent post owner or site admin
         Messages: Renamed duplicate private_msg to private_reply_check_msg ("Only share reply with %s")
         Avatar: cropping step is skipped if using a mobile device (due to dependency on software library used)
         API: Added core API file for functions that developers will find useful
         API: core API function cpc_insert_activity_post to insert an activity post (see Core Functions chapter in book)

14.12.1  Fixed layout issue with activity posts for gallery items

14.12    Core: New shortcode: [cpc-close-account]. Displays a button allowing a user to close their account.
         Core: Added test alert via CP Community->Setup->Alerts.
         Activity: Changed avatar_size option to user_avatar_size for [cpc-activity-page]
         Activity: Added account_closed_msg to [cpc-activity-post]         
         Avatar: Added crop to [cpc-avatar-change] to skip cropping step when uploading avatar (suggest uploading square avatar images on site)
         Avatar: Replaced ClassicPress crop function with SimpleImage for avatar, for better quality and support for non-JPF format
         Alerts: Added flag_src to [cpc-alerts-activity] and [cpc-alerts-friends] to replace icon, use relative or absolute URL
         Forums: Admin and post owner can move to another forum when replying
         Forums: Admin does not have to reply to move or close a post
         Forums: Added count_include_replies to [cpc-forums], whether to include replies/comments to forum posts, default 1
         Forums: Changed default of show_posts_header for [cpc-forums] to 0
         Forums: Can now make private replies on the forum, only visible by forum post author and site administrators. Set allow_private=1 and optionally private_msg to [cpc-forum-comment]; also optionally set private_reply_msg to [cpc-forum].

14.11    Core: Moved icon color (dark or light) from Profile Page to Core Options (CP Community->Setup->Core Options)
         Core: Added option for external links to open in new window, with optional suffix after external links (CP Community->Setup->Core Options)
         Alerts: can now show alerts as a flag with count [cpc-alerts-activity]
         Alerts: added ability to mark all as read, delete individual alerts and delete all alerts
         Alerts: added make_all_read_text and delete_all_text (shown with [cpc-alerts-activity]
         Forums: added title_length to [cpc-forum], [cpc-forums] and [cpc_forum_show_posts] to limit characters of forum titles (default, 50)
         Forums: added show_count, show_last_activity and show_freshess to [cpc-forums] and [cpc-forum]
         Forums: removed show_replies from [cpc-forum] (replaced with show_count for consistency)
         Forums: added level_0_links to [cpc-forums] set to 0, to disable links for top level forums
         Forums [cpc-forum-show-posts]: changed include_replies option, now used for forum post replies (default 1)
         Forums [cpc-forum-show-posts]: added include_comments option used for forum post reply comments (default 0)
         Forums [cpc-forum-show-posts]: Added options to show summary of forum activity (good for a widget!):
             summary (whether to show as summary information, default 0)
             summary_format (if summary=1, format of text, default '%s %s %s %s ago %s')
                example of output: [simon] [replied to] [This topic] [5 mins] ago [the snippet]
             summary_started (text for 'started')
             summary_replied (text for 'replied to')
             summary_commented (text for 'commented on')
             summary_title_length (maximum length of title, default 50)
             summary_snippet_length (maximum length of snippet, default 50, set to 0 to hide)
             summary_avatar_size (size of avatar, default 32, set to 0 to hide)
             summary_show_unread (whether to bold topics with unread content, default 1)
         Friendships: New option (under CP Community->Setup->Friendships) to set all site members as friends with each other, always.
         Friendships: Can add pending friendship requests as a flag with count with [cpc-alerts-friends]

14.10.3  Change in version number to match CP Community (Extensions) update

14.10.2  Fix to activity when adding images to a gallery (was causing indent on following posts)

14.10.1  Change in version number to match CP Community (Extensions) update

14.10    Activity: Members can now hide posts on their activity posted by others
         Activity: Avatar now shown when adding a comment to activity posts
         Activity: Can now set number of comments shown with [cpc-activity comment_size=x]
                   Set text with comment_size_text_plural/comment_size_text_singular
         Forums:   Comments on forum post replies are now available (can be disabled/configured)
         Forums:   New option in Setup->Forum to set when a forum post automatically closes due to inactivity
         Misc:     Added cpc_is_forum_page($id) core function to check if ClassicPress page with ID of $id is a forum page
         Misc:     Added .cpc_button class to all <input type="submit" /> in CPC for quick and easy styling of buttons, eg:
                         .cpc_button { border: 3px solid red !important; }         

14.9     Forums:   New Forum Administration, a handy single screen to manage all forums (including security if in use)
         Forums:   Added no_permission_msg to cpc-forum-comment shortcode (relevant to forum security)
         Alerts:   Link in Friendship request alert now goes to user's page to accept/reject

14.8     Forums:   Updated forum-show-posts shortcode with bug fix for multi-site installations
         Forums:   After adding new post, new post is shown (instead of forum posts list)
                   -> https://n3rds.work/development-to-do-list/after-adding-forum-topic-show-the-topic/
         Alerts:   Added option in setup to disable alerts from being sent out globally
         Setup:    Added warning if profile pages not setup in CP Community->Setup->Profile Pages

14.7.18  Avatar:   Added not_permitted (text) to [cpc-avatar-change]
         Friends:  Fixed missing / in URL in the alert sent out
         Activity: When viewing a post (single view), a message is shown if it doesn't exist.
                   Change with [cpc-activity not_found="Nothing to see!"]
         Forum:    When deleting comments, back to forum link is now shown
         Misc:     Increased security of custom post types

14.7.5   Forums:   Added include_closed option to [cpc-forum-show-posts] (default 1)
         Setup:    Quick Start friends page now includes pending friendship requests

14.7.4   Maintenance Release

14.7.3   Core: simplified usort for activity for older versions of PHP
         Core: removed deprecated use of jQuery.browser

14.7.1   Maintenance Release
         Forums: Only published posts/replies now included in [cpc-forum-show-posts]

14.7     Alerts
         New shortcode: [cpc-alert-activity] to show alerts on site

         Forums
         New option: page_x_of_y to [cpc-forum] for pagination subtitle, set to "" to hide

14.6.20  Forums
         Added pagination to [cpc-forum]
         Added style to highlight unread posts, or posts with new replies since last viewed
         Added style to highlight posts that user has replied to. Add reply_icon=0 to [cpc-forum] shortcode to hide
              https://n3rds.work/development-to-do-list/icon-to-show-a-user-they-have-already-posted-on-a-topic/
         Deleted posts through front-end now put in trash
         Single Forum posts now set document <title> to the post title for SEO purposes

         Usermeta
         Added [cpc-usermeta-button] shortcode to create button for URL with user ID

         Admin (Setup)
         After saving under CP Community->Setup, expanded section stays expanded


14.6.11  Removed rogue output when saving edited forum post

14.6.8   GMT should now be used as the 'base' for calculating freshness of content

14.05.25 Added show_replies to show/hide replies count column to [cpc-forum], default 1
         Added show_comments_count to show/hide the count of replies after forum topic title, default 1

14.05.22 Added show_closed to [cpc_forums], default 1, set to 0 to hide closed posts
         Improved error checking for avatar upload when creating avatar folder in wp-content/cpc-pro-content

14.05.21 Added filters to support new Forum Extensions plugin

14.05.20 Added filters to support WYSIWYG option for Forum Toolbar

14.05.19 Fix for setting "wrench" not appearing on activity

14.05.18 Added [center] as a BB Code

14.05.17 Fixed problem with Friendships JS

14.05.16 Added layout option to [cpc-friends], can be list or fluid, default list
         Added closed_switch and closed_switch_msg to toggle inclusion of closed forum posts
         Improved [cpc-forum-show-posts] to ensure forum replies are found
         Forum post owners can now move posts to other forums (as well as site admins)
         Fixed CSS for forum textarea on some browsers, overlaying with Forum Toolbar
         Fixed to date format time difference on activity
         Removed friendships/js and friendships/css subfolders to reduce file/dir count
         Removed avatar/css subfolders to reduce file/dir count

14.05.13 Automatic fall back to older browsers added for activity attachments, and avatar upload, eg. MS IE <= 9
         Added choose, try_again_msg, and file_types_msg as options for [cpc-avatar-change]
         Added missing date_format to [cpc-forum]

14.05.12 Fix when "sticked" activity is older than the most recent "count" number of posts
         Added date_format across all plugins, where applicable
         Added status to [cpc-forum], set to '' (all), 'open' or 'closed'
         Improve default CSS for [cpc-friends]

14.05.11 Allow users to "stick" activity on their home page (not news feed)
         Use sticky_label and unsticky_label, set to '' to not offer option
         Added delete_label as option to [cpc-activity] to change Settings delete text (set to '' to hide)

14.05.10 Small change to filter name typo
14.05.09 New version numbering introduced
         When editing a forum post (not reply) can move post to another forum
         Set [cpc_forum moved_to="%s successfully moved to %s"] to change success message
         Set [cpc_forum_post can_move_forum="0"] to disable
         Fixed space in profile link for email alerts
         Added [cpc-activity hide_until_loaded, a flag to delay activity showing until after CSS loaded, default false] (can improve user experience)
         Added [cpc_friends_status user_id='x'] where x is a user ID, or defaults to currently viewed user

0.59   Change Posts to Topics as default forum "post" header title
       View Forum Post (either link or button) now goes to post on front end
       View Activity (either link or button) now goes to post on front end

0.58.5 Added last_active_format option to [cpc-friends]
0.58.4 Fix for [cpc-forums] shortcode
0.58.3 New shortcode [cpc-friends-status] to show status of friendship

0.58.2 Fixed potential security risk when viewing individual posts
       Added secure_post_msg to [cpc-forum]
0.58.1 Minor changes
0.58   Can change sticky status when editing a post (admin only)
       Forum can now be locked (via forum setup) to stop new posts/replies
       Added options to [cpc-forums]:
       -> show_summary, show_posts and show_posts_header
       Added translation options for [cpc-forums], [cpc-forum] and [cpc-forum-page]:
       -> forum_title, forum_count, forum_last_activity and forum_freshness
       -> header_title, header_count, header_last_activity

0.57   Can now delete forum posts/replies if you are the owner or admin
       Various options added to [cpc-forum] and [cpc-usermeta] to support translations and delete feature

0.56.4 Update to cpc_display_name() to support WPML plugin
0.56.3 Fixed bug when editing a forum post/comment when is the author
0.56.2 Minor fix to link from forum post on sub-folder installation
0.56.1 Minor code change for repository
0.56   First release to ClassicPress repository

0.55.2 Parameter to include user_id for [cpc-usermeta]
0.55.1 Added IDs to some DIVs to help with styling
0.55   Prepared for release on ClassicPress repository
       Added option to edit profile page to switch off alerts for activity

0.54.1 Minor change
0.54   Added [cpc-forum-page] shortcode

0.53.3 Improved Forum help on setup
0.53.2 Fix to shortcodes inserts when added a new quick-start forum
0.53.1 Update to setup to make new page clear
0.53   Bug fix (removed rogue </div> in forum setup)

0.52.1 Quickly setup unlimited forums via CP Community->Setup (quick start)
0.52   Forums plugin now included in core plugin. Forums plugin no longer required.

0.51   Alerts plugin now included in core plugin. Alerts plugin no longer required.

0.50.1 Changed default map type to dynamic
0.50   Made the getting started page more attractive and useful

0.49   Activity now included in core plugin. Activity plugin no longer required.

0.48   Added hooks to allow other plugins to hook into core setup

0.47.1 select2 only loaded when necessary

0.47   Removed external AJAX files (now handled through WP ajax)
       Added select2 to core
       
0.46   Added [map]address[/map] and [map zoom=n]address[/map] to BB Codes

0.45   Removed dependency on Taxonomy Metadata plugin

0.44.2 Added support for BB Codes: list and [*]
0.44.1 Added missing translations
0.44   Small changes to allow .mo translation file to be placed in plugins folder

0.43.3 Fix to Friendship cancellation
0.43.2 Moved BB Code CSS into core
0.43.1 Fix to [cpc-friends]
0.43   Move cpc_bbcode_replace() to core

0.41.2 Fixed count="n" for [cpc-friends]
0.41.1 Fix to load CSS for friendship shortcodes
0.41   Only loads JS/CSS when required

0.40.2 Localised admin labels
0.40.1 Bug fix to hide when friend was last active if they haven't been active
0.40   If a user has not uploaded an avatar, the Wordpress default is shown instead

0.39   Removed use of jQuery UI from front-end, only used in admin

0.38   Added options to skip loading jQuery UI/CSS (CP Community->Setup->Core Options)

0.37.2 cpc_are_friends() function improved
0.37.1 Added show_last_active option to [cpc-friends]
0.37   Added generic wait jQuery modal, just use jQuery("body").addClass("cpc_wait_loading");

0.36   Added cpc_admin_setup_form_get_hook to admin Getting Started

0.35.1 Fixed cpc_display_name to handle no permalinks
0.35   Added Quick Start to setup, including button to quickly create profile pages

0.34.1 Added cpc_error CSS style
0.34   Added cpc_query_mark() function

0.33   Added cpc_get_words() function

0.32   Improved Getting Started/Setup hooks for easy extension

0.31   Added hook for Getting Started info (under CP Community->Setup)

0.30   Added map_style option to [cpc-usermeta], static or dynamic

0.29.1 Changed cpc_curPageURL() function to use HTTP_POST instead of SERVER_NAME

0.29   Added support for language translation

0.28.2 Added [cpc-usermeta-change] to editor toolbar button
0.28.1 Bug fix
0.28   Added ClassicPress TinyMCE editor toolbar button that can be extended by other plugins
       Requires ClassicPress v3.9+
	     Added [cpc-display-name] and [cpc-avatar] to CPC editor toolbar button

0.27   Custom CSS fixed to support quotes

0.26   Removed dependency on profile page being setup in cpc_display_name() function

0.25   Added cpc_curPageURL() function to core

0.24   Added Custom CSS admin screen (persistent across updates)

0.23.1 Fix to JS path
0.23   Included font icon logo in menu
       Added button to WYSIWYG editor (in preparation)
     
0.22   Various code changes

0.21   Added cpccom_last_active meta for user, updated on every page load via wp_footer hook

0.20   Added password change to [cpc-usermeta-change]

0.19   Added display_name and user_email to [cpc-usermeta-change]

0.18   Added hook and filter to cpc-usermeta-change shortcode (edit profile)

0.17   Added hooks to integrate with CP Community setup page
       Fixed missing file upload function

0.16   Added cpc_get_friends function

0.15   Removed fileinput to attachments plugin

0.14   Removed bootstrap to ensure theme/plugin compatibility

0.13   Standardise private and none options

0.12   Added support for before and after options on shortcodes

0.11   Implemented friendship requests

0.10   Added link to edit profile page [cpc-usermeta-change-link]

0.9    Added front end edit profile [cpc-usermeta-change]

0.8    Added change avatar to front end and link [cpc-avatar-change-link] and [cpc-avatar-change]

0.7    Added admin choice for icons color scheme

0.6    Added profile page selection to setup page

0.5    Initial external release

0.1-4  Internal development

== Upgrade Notice ==

Latest news and information at https://n3rds.work/blog.
