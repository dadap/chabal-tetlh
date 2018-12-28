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
    $Dez = motlh_muz_zaqroS_yIper();
    $Seghmey_zaqroSmey_je = vInDaz_Segh_zaqroSmey_tIper();

    if (function_exists('pmpro_hasMembershipLevel')) {
        foreach ($Seghmey_zaqroSmey_je as $Segh => $zaqroS) {
            if (pmpro_hasMembershipLevel($Segh)) {
                $Dez = max($zaqroS, $Dez);
            }
        }
    }

    return $Dez;
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

function Dez_peSluzbogh_yInawz($Dez)
{
    return array_key_exists($Dez, $_POST) ? $_POST[$Dez] : "";
}

function chabal_tISuq() {
    global $wpdb;
    $pfx = qawHaq_moHaq();
    $Dez = "";

    if (SaH_zIv() == 0) {
        $Dez .=  "<p>You must <a href='" . wp_login_url(get_permalink()) .
                 "'>log in</a> to submit words or vote.</p>\n";
    } else {
        $muz = Dez_peSluzbogh_yInawz("muz");
        if ($muz) {
            $match = get_posts(array(
                'post_type' => 'chabal',
                'title' => $muz
            ));
            if ($match) {
                $Dez .= "<p class='error'>An entry already exists for the word "
                        . "$muz. Please choose a different word.</p>\n";
            } else {
                wp_insert_post(array(
                    'post_title' => $muz,
                    'post_content' => Dez_peSluzbogh_yInawz("QIjmeH_per"),
                    'post_status' => 'publish',
                    'post_type' => 'chabal',
                ));
            }
        }

        $Dez .= "<p>Your membership level allows you to submit " .
                 chabal_zar_chawzluz() . " entries. You may submit " .
                 (chabal_zar_chawzluz() - chabal_zar_peSluz()) .
                " more entries.</p>\n";

        if (chabal_zar_peSluz() < chabal_zar_chawzluz()) {
            $Dez .= "    <form method='POST'>\n";
            $Dez .= "        <input type='text' name='muz' ";
            $Dez .= "onInput='rurbogh_muz_tInguz(this.value);' />\n";
            $Dez .= "        <input type='text' name='QIjmeH_per' />\n";
            $Dez .= "        <input type='submit' />\n";
            $Dez .= "    </form>\n";
            $Dez .= "    <div id='rurbogh_muz_QIn'></div>\n";
        }
    }

    $Dez .= "<script>chabal_tetlh_wpdata.user = " . SaH_zIv() . "</script>\n";
    $Dez .= "<noscript><p>You must have JavaScript enabled in order to vote." .
          "</p></noscript>\n";
    if (SaH_zIv()) {
        $Dez .= "<ul id='chabal_tetlh_chIjmeH_tetlh'></ul>\n";
    }

    $Dez .= "<select id='patlh_meq' ";
    $Dez .= "onChange='chabal_tetlh_patlh_meq_yIwIv(this.value);'>\n";
    $Dez .= "    <option value='Total Score' />Total Score</option>\n";
    $Dez .= "    <option value='Number of Votes' />Number of Votes</option>\n";
    $Dez .= "    <option value='Alphabetical' />Alphabetical</option>\n";
    $Dez .= "</select>\n";

    $Dez .= "<select id='patlh_lurgh' ";
    $Dez .= "onChange='chabal_tetlh_patlh_lurgh_yIwIv(this.value);'>\n";
    $Dez .= "    <option value='1' />Ascending</option>\n";
    $Dez .= "    <option value='-1' />Descending</option>\n";
    $Dez .= "</select>\n";

    $Dez .= "<ul id='chabal_tetlh'>\n";

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
        $Dez .= "    <li>\n";
        $Dez .= "        <div class='wIv' id='chabal_tetlh_$muz->ID'>\n";
        $Dez .= "            $mIvwaz\n";
        $Dez .= "        </div>\n";
        $Dez .= "        <a href='" . get_post_permalink($muz) . "'>\n";
        $Dez .= "            <div class='muz'>$muz->post_title</div>\n";
        $Dez .= "            <div class='QIjmeH_per'>$muz->post_content</div>\n";
        $Dez .= "        </a>\n";
        $Dez .= "    </li>\n";
    }
    $Dez .= "</ul>\n";
    $Dez .= "<script>chabal_tetlh_Hoch_yIchaz();</script>\n";

    return $Dez;
}
add_shortcode('chabal_tetlh', 'chabal_tISuq');

function nIqHomHom_tIQapbeHmoH()
{
    wp_enqueue_script('chabal_tetlh', plugins_url('chabal-tetlh.js', __FILE__),
        array('jquery'));
    wp_enqueue_style('chabal_tetlh', plugins_url('chabal-tetlh.css', __FILE__));
    wp_localize_script('chabal_tetlh', 'chabal_tetlh_wpdata',
        array(
            'ajax' => get_option('siteurl') . '/wp-admin/admin-ajax.php'
        )
    );
}

add_action('wp_enqueue_scripts', 'nIqHomHom_tIQapbeHmoH');

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
        $chabal = get_post(Dez_peSluzbogh_yInawz("chabal"));
        $wIv = Dez_peSluzbogh_yInawz("wIv");
        $yIlel = Dez_peSluzbogh_yInawz("yIlel");

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

function SeHlawz_yIchenmoH()
{
    add_options_page('chabal tetlh', 'chabal tetlh', 'manage_options',
        'chabal_tetlh', 'SeHlawz_yIchaz');
}
add_action('admin_menu', 'SeHlawz_yIchenmoH');

function SeHlawz_yIcher()
{
    register_setting('chabal_tetlh_SeHlawz', 'motlh_muz_zaqroS');
    register_setting('chabal_tetlh_SeHlawz', 'vInDaz_Segh');
    register_setting('chabal_tetlh_SeHlawz', 'vInDaz_Segh_zaqroS');
    add_settings_section('zaqroSmey', 'Word Limits', 'zaqroS_SeHlawz_yIchaz',
        'chabal_tetlh');
    add_settings_field('motlh_muz_zaqroS', 'Default Word Limit',
        'motlh_muz_zaqroS_yIchaz', 'chabal_tetlh', 'zaqroSmey');

    if (function_exists('pmpro_hasMembershipLevel')) {
        $zaqroSmey = vInDaz_Segh_zaqroSmey_tIper();
        $zaqroSmey[''] = '';
        $i = 0;

        foreach ($zaqroSmey as $Segh => $zaqroS) {
            add_settings_field("vInDaz_Segh[$i]", 'Membership Type ' . ($i + 1),
                'vInDaz_Segh_yIchaz', 'chabal_tetlh', 'zaqroSmey',
                array($i, $Segh));
            add_settings_field("vInDaz_Segh_zaqroS[$i]",
                'Limit for Membership Type ' . ($i + 1),
                'vInDaz_Segh_zaqroS_yIchaz', 'chabal_tetlh', 'zaqroSmey',
                array($i, $zaqroS));
            $i++;
        }
    }
}
add_action('admin_init', 'SeHlawz_yIcher');

function zaqroS_SeHlawz_yIchaz()
{
    echo 'Set word contribution limits by member type';
}

function motlh_muz_zaqroS_yIper()
{
    // Default value chosen by fair dice roll. Guaranteed to be random.
    return intval(get_option('motlh_muz_zaqroS', 4));
}

function motlh_muz_zaqroS_yIchaz()
{
    $zaqroS = motlh_muz_zaqroS_yIper();
    echo "<input type='text' name='motlh_muz_zaqroS' value='$zaqroS' />";
}

function vInDaz_Segh_zaqroSmey_tIper()
{
    $Dez = array();
    $Seghmey = (array) get_option('vInDaz_Segh', array());
    $zaqroSmey = (array) get_option('vInDaz_Segh_zaqroS', array());
    $rav = min(count($Seghmey), count($zaqroSmey));
    for ($i = 0; $i < $rav; $i++) {
        if (empty($Seghmey[$i]) || empty($zaqroSmey[$i])) {
            continue;
        }
        $Dez[$Seghmey[$i]] = $zaqroSmey[$i];
    }
    return $Dez;
}

function vInDaz_Segh_yIchaz($Dez)
{
    echo "<input type='text' name='vInDaz_Segh[$Dez[0]]' value='$Dez[1]' />";
}

function vInDaz_Segh_zaqroS_yIchaz($Dez)
{
    echo "<input type='text' name='vInDaz_Segh_zaqroS[$Dez[0]]' value='$Dez[1]' />";
}

function SeHlawz_yIchaz()
{
    ?>
    <div class="wrap">
        <h2>Word Limits</h2>
	<form action="options.php" method="POST">
    <?php
        settings_fields('chabal_tetlh_SeHlawz');
        do_settings_sections('chabal_tetlh');
        submit_button();
    ?>
    </form>
    </div>
    <?php
}

function SeHlawz_Daq_yIchaz($Daqmey) {
    $Daq = '<a href="options-general.php?page=chabal_tetlh">' .
        __('Settings') . '</a>';
    array_push( $Daqmey, $Daq );
    return $Daqmey;
}
$chabal_tetlh_Daq = plugin_basename(__FILE__);
add_filter("plugin_action_links_$chabal_tetlh_Daq", 'SeHlawz_Daq_yIchaz');
?>
