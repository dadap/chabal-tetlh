<?php
/*
 * Plugin name: chabal tetlh
 * Description: mu' chu' tIchup. mu' chu' tIwIv.
 * Version: 0.0
 * Author: De'nIl maqel puqloD DapDap tuq
 * Author URI: https://github.com/dadap
 *
 *                                nIqHom mab quv
 *
 * nIqHomvam lulo' Hoch net chaw'. meq wIvlaH lo'wI'. nIqHom choHlu' net chaw'
 * je. nIqHomvam velqa' chenmoHlu' net chaw' je 'ej velqa' lInlu' net chaw'.
 * lInlu'chugh, tu'qom wIvlaH lInwI'. Hoch chawlu', 'ach cha' chut pabnISlu':
 *
 *     wa':  reH nIqHomvam tlhejnIS mabvam. mabvam teqlu' net tuch.
 *     cha': potlh mabvam mu'mey.  mabvam choHlu' net tuch.
 *
 * nIqHomvam lupeS neH nIqHom peSwI'pu': lo'wI' ngoQvaD mIt 'oH 'e' lay'be'lu'.
 * nIqHomvam lo'lu'taHvIS qaSchugh vay', ngoy' nIqHom lo'wI' neH.
 *
 *                       The honorable software contract
 *
 * It is permitted for all to use this software. A user may choose the reason.
 * It is also permitted that the software be altered. It is also permitted that
 * replicas of this software be created, and it is permitted that replicas be
 * shared. If it is shared, the one who shares may choose the form. All is
 * permitted, but two laws must be followed:
 *
 *     one:  This contract must always accompany this software. It is forbidden
 *           to remove this contract.
 *     two:  The words of this contract are important. It is forbidden to alter
 *           this contract.
 *
 * The suppliers of the software only supply it: It is not promised that it be
 * suitable for the user's purpose. If something occurs while this software is
 * being used, only the user of the software is responsible.
 *
 */

function yIjom() {
    global $wpdb;

    $collate = $wpdb->get_charset_collate();
    $pfx = $wpdb->prefix . "chabal_tetlh_";

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

function chabal_tISuq() {
    global $wpdb;
    $pfx = $wpdb->prefix . "chabal_tetlh_";
?>
    <form>
        <input type="text" />
    </form>
<?php
    print "<ul>\n";
    foreach ($wpdb->get_results("SELECT chabal FROM ${pfx}muz") as $muz) {
        print("    <li>$muz->chabal</li>\n");
    }
    print "</ul>\n";
}
add_shortcode('chabal_tetlh', 'chabal_tISuq');
?>
