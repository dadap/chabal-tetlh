<?php
/*
 * Plugin name: chabal tetlh
 * Description: mu' chu' tIchup. mu' chu' tIwIv.
 * Version: 0.0
 * Author: De'nIl maqel puqloD DapDap tuq
 * Author URI: https://github.com/dadap
 *
 *                               batlh nIqHom mab
 *
 * nIqHomvam lulo' Hoch net chaw'. meq wIvlaH lo'wI'. nIqHom choHlu' net chaw'
 * je. nIqHomvam velqa' chenmoHlu' net chaw' je 'ej velqa' lInlu' net chaw'.
 * lInlu'chugh, tu'qom wIvlaH lInwI'. Hoch chaw'lu', 'ach chutvam pabnISlu':
 *
 *     reH nIqHomvam tlhejnIS mabvam. mabvam teqlu' net tuch.
 *
 * nIqHomvam lupeS neH nIqHom peSwI'pu': lo'wI' ngoQvaD mIt 'oH 'e' lay'be'lu'.
 * nIqHomvam lo'lu'taHvIS qaSchugh vay', ngoy' nIqHom lo'wI' neH.
 *
 *                        The software contract of honor
 *
 * It is permitted for all to use this software. A user may choose the reason.
 * It is also permitted that the software be altered. It is also permitted that
 * replicas of this software be created, and it is permitted that replicas be
 * shared. If it is shared, the one who shares may choose the form. All is
 * permitted, but this law must be followed:
 *
 *     This contract must always accompany this software. It is forbidden to
 *     remove this contract.
 *
 * The suppliers of the software only supply it: It is not promised that it be
 * suitable for the user's purpose. If something occurs while this software is
 * being used, only the user of the software is responsible.
 *
 */

function qawHaq_moHaq() {
    global $wpdb;
    return $wpdb->prefix . "chabal_tetlh_";
}

function yIjom() {
    global $wpdb;
    $collate = $wpdb->get_charset_collate();
    $pfx = qawHaq_moHaq();

    $muzsql = "CREATE TABLE IF NOT EXISTS ${pfx}muz (
                   mIz int NOT NULL AUTO_INCREMENT,
                   chabal text NOT NULL,
                   tulwIz int NOT NULL,
                   PRIMARY KEY (mIz)
               ) $collate;";

    $wIvsql = "CREATE TABLE IF NOT EXISTS ${pfx}wIv (
                   chabal int NOT NULL,
                   wIvwIz int NOT NULL
               ) $collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($muzsql);
    dbDelta($wIvsql);
}
register_activation_hook(__FILE__, 'yIjom');

function SaH_zIv() {
    require_once( ABSPATH . 'wp-includes/user.php');
    return get_current_user_id();
}

function chabal_zar_chawluz() {
    // TODO: allow a different number of words depending on user type.
    return 4;  // chosen by fair dice roll. guaranteed to be random.
}

function chabal_zar_peSluz() {
    global $wpdb;
    $pfx = qawHaq_moHaq();

    return $wpdb->get_var("SELECT COUNT(*) FROM ${pfx}muz WHERE tulwIz = " .
                          SaH_zIv());
}

function chabal_tISuq() {
    global $wpdb;
    $pfx = qawHaq_moHaq();

    if (SaH_zIv() == 0) {
        print("<p>You must <a href='" . wp_login_url(get_permalink()) .
              "'>log in</a> to submit words or vote.</p>\n");
    } else {
        if ($_POST["chabal"] == "tIlaj") {
            for ($i = chabal_zar_peSluz(); $i < chabal_zar_chawluz(); $i++) {
                if ($_POST["chabal$i"]) {
                    $wpdb->insert(
                        "${pfx}muz",
                        array(
                            "chabal" => $_POST["chabal$i"],
                            "tulwIz" => SaH_zIv()
                        ),
                        array('%s', '%d')
                    );
                }
            }
        }
?>
    <form method='POST'>
        <input type='hidden' name='chabal' value='tIlaj' />
<?php
        $submit = false;
        for ($i = chabal_zar_peSluz(); $i < chabal_zar_chawluz(); $i++) {
            print("        <input type='text' name='chabal$i' />\n");
            $submit = true;
        }
        if ($submit) {
            print("       <input type='submit' />\n");
        }
?>
    </form>
<?php
    }

    print "<ul>\n";
    foreach ($wpdb->get_results("SELECT chabal FROM ${pfx}muz") as $muz) {
        // TODO: add voting mechanism; way for users to withdraw their own
        // submissions
        print("    <li>$muz->chabal</li>\n");
    }
    print "</ul>\n";
}
add_shortcode('chabal_tetlh', 'chabal_tISuq');
?>
