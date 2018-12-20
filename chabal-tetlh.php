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

    $wIvsql = "CREATE TABLE IF NOT EXISTS ${pfx}wIv (
                   chabal INT NOT NULL,
                   wIvwIz INT NOT NULL,
                   wIv INT NOT NULL,
                   ghorgh TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                   PRIMARY KEY (chabal, wIvwIz)
               ) $collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($wIvsql);
}
register_activation_hook(__FILE__, 'yIjom');

function DezHom_Sar_yIcher() {
    register_post_type( 'chabal',
        array(
            'labels' => array(
                'name' => __( 'chabal' ),
                'singular_name' => __( 'chabal' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'chabal'),
        )
    );
    add_post_type_support('chabal', 'comments');
}
add_action( 'init', 'DezHom_Sar_yIcher' );

function SaH_zIv() {
    require_once( ABSPATH . 'wp-includes/user.php');
    return get_current_user_id();
}

function chabal_zar_chawzluz() {
    // TODO: allow a different number of words depending on user type.
    return 4;  // chosen by fair dice roll. guaranteed to be random.
}

function chabal_zar_peSluz() {
    global $wpdb;
    $pfx = qawHaq_moHaq();

    return count(get_posts(array(
        'author' => SaH_zIv(),
        'post_type' => 'chabal',
        'numberposts' => -1,
    )));
}

function chabal_tISuq() {
    global $wpdb;
    $pfx = qawHaq_moHaq();

    if (SaH_zIv() == 0) {
        print("<p>You must <a href='" . wp_login_url(get_permalink()) .
              "'>log in</a> to submit words or vote.</p>\n");
    } else {
        if ($_POST["muz"]) {
            $match = get_posts(array(
                'post_type' => 'chabal',
                'title' => $_POST["muz"]
            ));
            if ($match) {
                print("<p class='error'>An entry already exists for the word " .
                      $_POST["muz"] . ". Please choose a different word.</p>\n");
            } else {
                wp_insert_post(array(
                    'post_title' => $_POST["muz"],
                    'post_content' => $_POST["QIjmeH_per"],
                    'post_status' => 'publish',
                    'post_type' => 'chabal',
                ));
            }
        }

        print("<p>Your membership level allows you to submit " .
               chabal_zar_chawzluz() . " entries. You may submit " .
               (chabal_zar_chawzluz() - chabal_zar_peSluz()) .
               " more entries.</p>\n");

        if (chabal_zar_peSluz() < chabal_zar_chawzluz()) {
            print("    <form method='POST'>\n");
            print("        <input type='text' name='muz' />\n");
            print("        <input type='text' name='QIjmeH_per' />\n");
            print("        <input type='submit' />\n");
            print("    </form>\n");
        }
    }

    print "<script>chabal_tetlh_wpdata.user = " . SaH_zIv() . "</script>\n";
    print "<ul id='chabal_tetlh'>\n";
    print "<noscript><p>You must have JavaScript enabled in order to vote." .
          "</p></noscript>\n";

    foreach (get_posts(array(
                                'post_type' => 'chabal',
                                'numberposts' => -1,
                            )) as $muz) {
        $zarlogh_naDluz = wIv_tItogh($muz->ID, 1);
        $zarlogh_naDHazluz = wIv_tItogh($muz->ID, -1);
        $mIvwaz = "<div class='mIz_toghbogh'>" .
            ($zarlogh_naDluz + $zarlogh_naDHazluz) . "</div>" .
            "<div class='gherzId_naQ'>(+$zarlogh_naDluz/" .
            "-$zarlogh_naDHazluz)</div>";
        print("    <li>\n");
        print("        <div class='wIv' id='chabal_tetlh_$muz->ID'>\n");
        print("            $mIvwaz\n");
        print("        </div>\n");
        print("        <a href='" . get_post_permalink($muz) . "'>\n");
        print("            <div class='muz'>$muz->post_title</div>\n");
        print("            <div class='QIjmeH_per'>$muz->post_content</div>\n");
        print("        </a>\n");
        print("    </li>\n");
    }
    print "</ul>\n";
    print "<script>chabal_tetlh_tetlh_yIvurmoH();</script>\n";
}
add_shortcode('chabal_tetlh', 'chabal_tISuq');
wp_enqueue_script('chabal_tetlh', plugins_url('chabal-tetlh.js', __FILE__),
    array('jquery'));
wp_localize_script('chabal_tetlh', 'chabal_tetlh_wpdata',
    array(
        'ajax' => get_option('siteurl') . '/wp-admin/admin-ajax.php'
    ));
wp_enqueue_style('chabal_tetlh', plugins_url('chabal-tetlh.css', __FILE__));

function wIv_tItogh($chabal, $Dop)
{
    global $wpdb;
    $pfx = qawHaq_moHaq();
    $patlhmoHmeH = $Dop < 0 ? '<' : '>';

    $res = $wpdb->get_var("SELECT COUNT(wIv) FROM ${pfx}wIv " .
        "WHERE chabal = $chabal AND wIv $patlhmoHmeH 0");

    return $res ? $res : 0;
}

function chabal_tIjatlh()
{
    global $wpdb;
    $pfx = qawHaq_moHaq();

    if (SaH_zIv()) {
        $chabal = get_post($_POST["chabal"]);
        $wIv = $_POST["wIv"];
        $yIlel = $_POST["yIlel"];

        if ($chabal && $wIv != null) {

            if ($chabal && $chabal->post_type == 'chabal') {
                if ($wIv > 0) {
                    $wIv = 1;
                } else if ($wIv < 0) {
                    $wIv = -1;
                }

                $wpdb->replace(
                    $pfx . "wIv",
                    array(
                        'chabal' => $chabal->ID,
                        'wIvwIz' => SaH_zIv(),
                        'wIv' => $wIv
                    ),
                    '%d'
                );
            }
        }

            if ($yIlel) {
                $lelbogh = get_post($yIlel);

                if ($lelbogh && $lelbogh->post_author == SaH_zIv() &&
                    $lelbogh->post_type == 'chabal') {
                    wp_delete_post($lelbogh->ID);
                }
            }
    }

    $tetlh = get_posts(array('post_type' => 'chabal', 'numberposts' => -1));
    print('{');
    foreach ($tetlh as $i => $muz) {
        if ($i > 0) {
            print(',');
        }
        print('"' . $muz->ID . '":{"+":' . wIv_tItogh($muz->ID, 1) .
              ',"-":' . wIv_tItogh($muz->ID, -1) . ',"m":"' .
              $muz->post_title . '","D":"' . get_post_permalink($muz) .
              '","p":"' . $muz->post_content . '"');
        if (SaH_zIv()) {
            $mIvwaz = $wpdb->get_var("SELECT wIv FROM ${pfx}wIv WHERE chabal " .
                "= $muz->ID AND wIvwIz = " . SaH_zIv());
            if ($mIvwaz) {
                print(',"w":' . $mIvwaz);
            }
            if ($muz->post_author == SaH_zIv()) {
                print(',"v":1');
            }
        }
        print('}');
    }
    print('}');
    wp_die();
}
add_action('wp_ajax_chabal_tetlh', 'chabal_tIjatlh');
add_action('wp_ajax_nopriv_chabal_tetlh', 'chabal_tIjatlh');
?>
