var chabal_tetlh = {};
var ghorgh_vurmoHluzpuz = 0;
var loHwIz_jIH = false;
var veH = 1;
var Dez_nejluzbogh = "";

var turwIz_Daq = null;

var chIjmeH_permey = {
    "Not voted on yet" : function (c) {
        "use strict";
        return  (c.w == null) && (c.ng == null) && (c.Q == null) &&
                (c.l == null);
    },
    "My words" : function (c) { "use strict"; return  c.v != null; },
    "All words" : function (c) { "use strict"; return  true; }
};

var patlh_lurgh = {
    "Total Score" : -1,
    "Number of Votes" : 1,
    "Alphabetical Order" : 1,
    "Recent Activity" : -1,
    "Number of Comments" : -1,
    "My Vote" : -1
};

var patlh_mIw = {
    "Total Score" : function (a, b) {
        "use strict";
        return patlh_lurgh["Total Score"] *
               ((chabal_tetlh[a]["+"] - chabal_tetlh[a]["-"]) -
               (chabal_tetlh[b]["+"] - chabal_tetlh[b]["-"]));
    },
    "Number of Votes" : function (a, b) {
        "use strict";
        return patlh_lurgh["Number of Votes"] *
               ((chabal_tetlh[a]["+"] + chabal_tetlh[a]["-"]) -
               (chabal_tetlh[b]["+"] + chabal_tetlh[b]["-"]));
    },
    "Alphabetical Order" : function (a, b) {
        "use strict";
        return patlh_lurgh["Alphabetical Order"] *
               (chabal_tetlh[a].m.localeCompare(chabal_tetlh[b].m));
    },
    "Recent Activity" : function (a, b) {
        "use strict";
        return patlh_lurgh["Recent Activity"] *
               (chabal_tetlh[a].gh - chabal_tetlh[b].gh);
    },
    "Number of Comments" : function (a, b) {
        "use strict";
        return patlh_lurgh["Number of Comments"] *
                (chabal_tetlh[a].QH - chabal_tetlh[b].QH);
    },
    "My Vote" : function (a, b) {
        "use strict";
        return patlh_lurgh["My Vote"] *
                (chabal_tetlh[a].w - chabal_tetlh[b].w);
    }
};

var qawHaqHom = {
    "chabal_zar_chazluz" : 27,
    "chabal_chazluzbogh_wazDIch" : 0,
    "patlh_meq" : "Number of Votes",
    "chIjmeH_per" : "Not voted on yet"
};

function Dez_qawlaHzaz()
{
    try {
        localStorage.setItem("chabal_tetlh_qawHaq_waHmeH_Dez", "teH");
    } catch (e) {
        return false;
    }
    return true;
}

function chabal_zar_chazluz()
{
    if (!Dez_qawlaHzaz()) {
        return qawHaqHom["chabal_zar_chazluz"];
    }

    var Dez = localStorage.getItem("chabal_tetlh_chabal_zar_chazluz");
    if (Dez === null) {
        return 27;
    }
    return parseInt(Dez);
}

function chabal_chazmeH_mIz_yIwIv(mIz)
{
    if (!Dez_qawlaHzaz()) {
        qawHaqHom["chabal_zar_chazluz"] = mIz;
        return;
    }
    localStorage.setItem("chabal_tetlh_chabal_zar_chazluz", mIz);
}

function chabal_chazluzbogh_wazDIch()
{
    if (!Dez_qawlaHzaz()) {
        return qawHaqHom["chabal_chazluzbogh_wazDIch"];
    }

    var Dez = localStorage.getItem("chabal_tetlh_chabal_chazluzbogh_wazDIch");
    if (Dez === null) {
        return 0;
    }
    return parseInt(Dez);
}

function chabal_chazluzbogh_wazDIch_yIwIv(mIz)
{
    if (!Dez_qawlaHzaz()) {
        qawHaqHom["chabal_chazluzbogh_wazDIch"] = mIz;
        return;
    }
    localStorage.setItem("chabal_tetlh_chabal_chazluzbogh_wazDIch", mIz);
}

function patlh_meq()
{
    if (!Dez_qawlaHzaz()) {
        return qawHaqHom["patlh_meq"];
    }

    var Dez = localStorage.getItem("chabal_tetlh_patlh_meq");
    if (Dez === null) {
        if (chabal_tetlh_wpuser !== 0) {
            return "Total Score";
        }
        return "Number of Votes";
    }
    return Dez;
}

function patlh_meq_yIwIv(meq)
{
    if (!Dez_qawlaHzaz()) {
        qawHaqHom["patlh_meq"] = mIz;
        return;
    }
    localStorage.setItem("chabal_tetlh_patlh_meq", meq);
}

function chIjmeH_per()
{
    if (!Dez_qawlaHzaz()) {
        return qawHaqHom["chIjmeH_per"];
    }
    var Dez = localStorage.getItem("chabal_tetlh_chIjmeH_per");
    if (Dez === null) {
        if (chabal_tetlh_wpuser !== 0) {
            return "All words";
        }
        return "Not voted on yet";
    }
    return Dez;
}

function chIjmeH_per_yIwIv(per)
{
    if (!Dez_qawlaHzaz()) {
        qawHaqHom["chIjmeH_per"] = mIz;
        return;
    }
    localStorage.setItem("chabal_tetlh_chIjmeH_per", per);
}

function turwIz_Daq_yIper()
{
    "use strict";
    if (turwIz_Daq === null) {
        var Daq = document.createElement("a");
        Daq.setAttribute("href", chabal_tetlh_wpdata.ajax);
        Daq.protocol = window.location.protocol;
        turwIz_Daq = Daq.href;
    }

    return turwIz_Daq;
}

function chabal_tetlh_chabal_yIpatlh(e)
{
    "use strict";
    var pongDaH = e.parentNode.id.split("_");

    if (pongDaH.length === 3 && pongDaH[0] === "chabal" &&
        pongDaH[1] === "tetlh") {
        var patlh = e.value;

        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: "POST",
            data: {
                action: "chabal_tetlh",
                chabal: pongDaH[2],
                wIv: patlh,
                ghorgh: ghorgh_vurmoHluzpuz
            }
        }).done(function(Dez) {
            chabal_tetlh_Dez_yIlaj(Dez);
        });
    }
}

function chabal_tetlh_chabal_yIlel(chabal)
{
    "use strict";
    if (confirm("Deleting this entry will also remove all associated activity "
        + "including votes and comments.")) {
        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: "POST",
            data: {
                action: "chabal_tetlh",
                yIlel: chabal,
                ghorgh: ghorgh_vurmoHluzpuz
            }
        }).done(function() {
            location.reload(true);
        });
    }
}

function chabal_tetlh_chabal_yIlaj(chabal)
{
    "use strict";
    if(confirm("Accepting this entry will prevent voting on it and cannot "
       + "be undone.")) {
        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: "POST",
            data: {
                action: "chabal_tetlh",
                yIlaj: chabal,
                ghorgh: ghorgh_vurmoHluzpuz
            }
        }).done(function() {
            location.reload(true);
        });
    }
}

function chabal_tetlh_chabal_yIlajQoz(chabal)
{
    "use strict";
    if(confirm("Blacklisting this entry will prevent voting on it and cannot "
       + "be undone.")) {
        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: "POST",
            data: {
                action: "chabal_tetlh",
                yIlajQoz: chabal,
                ghorgh: ghorgh_vurmoHluzpuz
            }
        }).done(function() {
            location.reload(true);
        });
    }
}

function chabal_tetlh_chabal_tlhIn_neH_yughmoH(f)
{
    "use strict";
    var gherzID = [];

    Object.keys(chabal_tetlh).forEach(function (p) {
        if (f(chabal_tetlh[p])) {
            gherzID.push(p);
        }
    });

    return gherzID;
}

function chabal_tetlh_Dez_yIlaj(Dez)
{
    "use strict";
    var Dez_pojluzpuzbogh = JSON.parse(Dez);
    var tetlh = Dez_pojluzpuzbogh.tetlh;

    veH = Dez_pojluzpuzbogh.v;

    if (Dez_pojluzpuzbogh.l === 1) {
        loHwIz_jIH = true;
    }

    Object.keys(tetlh).forEach(function(chabal) {
        chabal_tetlh[chabal] = tetlh[chabal];
        if (chabal_tetlh[chabal].gh > ghorgh_vurmoHluzpuz) {
            ghorgh_vurmoHluzpuz = chabal_tetlh[chabal].gh;
        }
    });

    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_tetlh_yIvurmoH()
{
    "use strict";
    jQuery.ajax({
        url: turwIz_Daq_yIper(),
        data: {
            action: "chabal_tetlh",
            ghorgh: ghorgh_vurmoHluzpuz
        }
    }).done(function(Dez) {
        chabal_tetlh_Dez_yIlaj(Dez);
    });
}



function chabal_tetlh_chabal_yIngaQmoH(chabal)
{
    "use strict";
    jQuery.ajax({
        url: turwIz_Daq_yIper(),
        method: "POST",
        data: {
            action: "chabal_tetlh",
            yIngaQmoH: chabal
        }
    }).done(function(Dez) {
        chabal_tetlh_Dez_yIlaj(Dez);
    });
}

function chabal_tetlh_chabal_yIngaQHazmoH(chabal)
{
    "use strict";
    jQuery.ajax({
        url: turwIz_Daq_yIper(),
        method: "POST",
        data: {
            action: "chabal_tetlh",
            yIngaQHazmoH: chabal
        }
    }).done(function(Dez) {
        chabal_tetlh_Dez_yIlaj(Dez);
    });
}

function chabal_tetlh_wIvmeH_leQ_yIlIng(wIv)
{
    var Dez = "<select class='leQ form-control' " +
         "onChange='chabal_tetlh_chabal_yIpatlh(this)'>\n";

    if (wIv == "pagh") {
        Dez += "    <option value='pagh' selected>Vote!</option>\n";
    }
    for (var i = veH * -1; i <= veH; i++) {
        Dez += "    <option value='" + i + "'";
        if (wIv == i) {
            Dez += " selected";
        }
        Dez += ">";
        if (i > 0) {
            Dez += "+";
        }
        Dez += i + "</option>\n";
    }

    Dez += "</select>\n";

    return Dez;
}

function chabal_tetlh_mIvwaz_yIvurmoH(chabal)
{
    "use strict";
    var mIvwaz = chabal_tetlh[chabal]["+"] - chabal_tetlh[chabal]["-"];
    var wIv = (
        chabal_tetlh[chabal].hasOwnProperty("w")
            ? chabal_tetlh[chabal].w
            : "pagh"
    );
    var leQ = (
        chabal_tetlh_wpuser != 0 && ! chabal_tetlh[chabal].ng &&
            ! chabal_tetlh[chabal].Q && ! chabal_tetlh[chabal].l
            ? chabal_tetlh_wIvmeH_leQ_yIlIng(wIv)
            : ""
    );

    jQuery(`#chabal_tetlh_${chabal}`).html(`
            ${leQ}
            <div class='mIz_toghbogh'>${mIvwaz}</div>
            <div class='gherzID_naQ'>
                (+${chabal_tetlh[chabal]["+"]} /
                 -${chabal_tetlh[chabal]["-"]})
            </div>
        </div>
    `);
}

function chabal_tetlh_chabal_yIvurmoH(chabal)
{
    "use strict";
    jQuery.ajax({
        url: turwIz_Daq_yIper(),
        data: {
            action: "chabal_tetlh",
            chabal: chabal
        }
    }).done(function(Dez) {
        chabal_tetlh_Dez_yIlaj(Dez);
    });
}

function chabal_tetlh_chabal_chazluzbogh_tItogh()
{
    return chabal_tetlh_chabal_tlhIn_neH_yughmoH(
        chIjmeH_permey[chIjmeH_per()]).length;
}

function chabal_tetlh_tetlh_yIchaz()
{
    "use strict";
    var zar_chazluz = chabal_zar_chazluz();
    var wazDIch = chabal_chazluzbogh_wazDIch();
    var tetlh =
        chabal_tetlh_chabal_tlhIn_neH_yughmoH(chIjmeH_permey[chIjmeH_per()]);
    tetlh.sort(patlh_mIw[patlh_meq()]);

    if (Dez_nejluzbogh.length > 0) {
        var Dez = Dez_nejluzbogh.toLowerCase();
        tetlh = tetlh.filter(e => chabal_tetlh[e].m.toLowerCase().includes(Dez)
            || chabal_tetlh[e].p.toLowerCase().includes(Dez));
    }

    chabal_tetlh_chabal_chazluzbogh_wIvmeH_leQ_yIchaz();

    if (zar_chazluz < tetlh.length) {
        if (wazDIch >= tetlh.length) {
            chabal_tetlh_chabal_wazDIch_yIwIv(wazDIch);
            wazDIch = chabal_chazluzbogh_wazDIch();
        }
        tetlh = tetlh.slice(wazDIch, wazDIch + zar_chazluz);
    }

    var ct = jQuery("#chabal_tetlh")

    if (ct.length == 0) {
        Object.keys(chabal_tetlh).forEach(function(chabal) {
            chabal_tetlh_mIvwaz_yIvurmoH(chabal);
        });
    }

    ct.empty();

    tetlh.forEach(function(chabal) {
        var yIlel = "";
        var yIngaQmoH = "";
        var yIlajQoz = "";
        var yIlaj = "";
        var ngaQ = (
            chabal_tetlh[chabal].ng
                ? "\n<p>Voting has been locked on this word</p>\n"
                : ""
        );
        var lajQozluzpuz = (
            chabal_tetlh[chabal].Q
                ? "\n<p>This word has been blacklisted and is no longer " +
                  "counted towards your total word allowance.</p>\n"
                : ""
        );
        var lajluzpuz = (
            chabal_tetlh[chabal].l
                ? "\n<p>This word has been revealed as a new word and is no " +
                  "longer counted towards your total word allowance.</p>\n"
                : ""
        );
        var Segh = (
            chabal_tetlh[chabal].Q
                ? "chabal lajQozluzpuz"
                : "chabal"
        );

        if (loHwIz_jIH) {
            var yIvang = (
                chabal_tetlh[chabal].ng
                    ? "ngaQHazmoH"
                    : "ngaQmoH"
            );
            var per = (
                chabal_tetlh[chabal].ng
                    ? "🔒"
                    : "🔓"
            );
            var laj = (
                chabal_tetlh[chabal].l
                ? ""
                : "+"
            );
            var lajQoz = (
                chabal_tetlh[chabal].Q
                    ? ""
                    : "🚫"
            );

            yIngaQmoH = `
                <button class='${yIvang} button outline small'
                    onclick='chabal_tetlh_chabal_yI${yIvang}(${chabal});'
                >${per}</button>
            `;
            yIlel = "\n<button class='lel button outline small' onclick='chabal_tetlh_chabal_yIlel(" + chabal + ");'>x</button>\n";
            if (chabal_tetlh[chabal].Q == null) {
                yIlajQoz = `
                    <button class='lajQoz button outline small'
                        onclick='chabal_tetlh_chabal_yIlajQoz(${chabal});'>🚫
                    </button>
                `;
            }
            if (chabal_tetlh[chabal].l == null) {
                yIlaj = `
                    <button class='laj button outline small'
                        onclick='chabal_tetlh_chabal_yIlaj(${chabal});'>+
                    </button>
                `;   
            }
             yIlaj = `
                    <button class='laj button outline small'
                        onclick='chabal_tetlh_chabal_yIlaj(${chabal});'>+
                    </button>
                `; 
        }

        var QInHomtogh = `
		<button class='QInHomtogh button outline small'
		   onclick="location.href='${chabal_tetlh[chabal].D}#comments';"
		>${chabal_tetlh[chabal].QH} Comments</button>
	    `;

        ct.append(`
            <li class='${Segh}'>
                <div class='wIv col-md-2 col-sm-3 col-xs-4' id='chabal_tetlh_${chabal}'>
                </div>
                <div class='${Segh} col-md-10 col-sm-9 col-xs-8'>${yIlel}${yIlajQoz}${yIlaj}${yIngaQmoH}${QInHomtogh}
                    <a href='${chabal_tetlh[chabal].D}'>${lajQozluzpuz}${lajluzpuz}${ngaQ}
                        <div class='muz unipIqaD'>
                            ${chabal_tetlh[chabal].m}
                        </div>
                        <div class='muz_Segh unipIqaD'>
                            ${chabal_tetlh[chabal].S}
                        </div>
                        <div class='QIjmeH_per unipIqaD'>
                            ${chabal_tetlh[chabal].p}
                        </div>
                    </a>
                </div>
            </li>
        `);
        chabal_tetlh_mIvwaz_yIvurmoH(chabal);

    });

    if (Object.keys(chabal_tetlh).length === 0) {
        jQuery("#chabal_tetlh").append(`
            <li><p>Loading words<span id='chabal_tetlh_loSlIz'></span></p></li>
            <script>setInterval(
                function() {
                    jQuery("#chabal_tetlh_loSlIz").html(".".repeat(
                        (Date.now() % 2000) / 500));
                    },
                500
            );</script>
        `);
    } else if (tetlh.length === 0) {
        jQuery("#chabal_tetlh").append(`
            <li><p>No matching entries.</p></li>
        `);
    }
}

function chabal_tetlh_chIjmeH_per_yIwIv(per)
{
    "use strict";
    chIjmeH_per_yIwIv(per);
    chabal_tetlh_chIjmeH_tetlh_yIchaz();
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_patlh_meq_yIwIv(meq)
{
    "use strict";
    patlh_meq_yIwIv(meq);
    jQuery("#patlh_lurgh").val(patlh_lurgh[patlh_meq()]);
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_patlh_lurgh_yIwIv(lurgh)
{
    "use strict";
    patlh_lurgh[patlh_meq()] = parseInt(lurgh);
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_chIjmeH_tetlh_yIchaz()
{
    "use strict";
    jQuery("#chabal_tetlh_chIjmeH_tetlh").empty();

    Object.keys(chIjmeH_permey).forEach(function(per) {
        var wIvbogh = (
            (per === chIjmeH_per())
                ? "wIvbogh"
                : ""
        );
        jQuery("#chabal_tetlh_chIjmeH_tetlh").append(`
            <li class='${wIvbogh}'
                onclick='chabal_tetlh_chIjmeH_per_yIwIv("${per}");'>
                ${per}
            </li>
        `);
    });
}

function rurbogh_muz_tInguz(muz)
{
    "use strict";
    var rurbogh_muzmey = {};
    var muz_DaH = [];

    var muz_waz = muz.toLowerCase();

    Object.keys(chabal_tetlh).forEach(function(per) {
        var muz_chaz = chabal_tetlh[per].m.toLowerCase();
        var rav = choH_tItogh(muz_waz, muz_chaz);

        if (muz_chaz.includes(" ")) {
            muz_chaz.split(" ").forEach(function (zayz) {
                var chuq = choH_tItogh(muz_waz, zayz);
                if (chuq < rav) {
                    rav = chuq;
                }
            });
        }

        if (rav < 3) {
            rurbogh_muzmey[per] = rav;
        }
    });

    muz_DaH = Object.keys(rurbogh_muzmey).sort(function (a, b) {
        return rurbogh_muzmey[a] - rurbogh_muzmey[b];
    });

    var QIn = jQuery("#rurbogh_muz_QIn");

    QIn.empty();

    if (muz_DaH.length > 0) {
        QIn.append(`
            <p>The following similar word(s) were found: if your word is not
               substantially different, consider voting on the similar word(s)
               and submitting another word instead.
            </p>
            <ul id='rurbogh_muzmey'></ul>
        `);
        muz_DaH.forEach(function(chabal) {
            var m = chabal_tetlh[chabal].m;
            var D = chabal_tetlh[chabal].D;
            jQuery("#rurbogh_muzmey").append(`<li><a href='${D}'>${m}</a></li>`);
        });
    }
}

function chabal_tetlh_chabal_yInej(e)
{
    Dez_nejluzbogh = e.value;
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_Hoch_yIchaz()
{
    "use strict";
    var meq = patlh_meq();
    jQuery("#patlh_meq").val(meq);
    jQuery("#patlh_lurgh").val(patlh_lurgh[meq]);
    chabal_tetlh_tetlh_yIvurmoH();
    chabal_tetlh_chIjmeH_per_yIwIv(chIjmeH_per());
}

function chabal_tetlh_chabal_zar_chazluz(e)
{
    "use strict";

    chabal_chazmeH_mIz_yIwIv(e.value);
    chabal_tetlh_chabal_chazluzbogh_wIvmeH_leQ_yIchaz();
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_chabal_chazluzbogh_wIvmeH_leQ_yIchaz()
{
    "use strict";
    var wazDIch = chabal_chazluzbogh_wazDIch();
    var chabal_zar_tuzluz = chabal_tetlh_chabal_chazluzbogh_tItogh();
    var zar_chazluz = chabal_zar_chazluz();
    var Qav = Math.min(chabal_zar_tuzluz, wazDIch + zar_chazluz);

    var zar = jQuery("<select>");
    var mIz = 3;
    var mIz_wIvluz = false;

    zar.attr("onChange", "chabal_tetlh_chabal_zar_chazluz(this)");
    zar.addClass("form-control");

    while (mIz < chabal_zar_tuzluz) {
        var wIv = jQuery("<option>").attr("value", mIz).html(mIz);
        if (mIz == zar_chazluz) {
            wIv.prop("selected", true);
            mIz_wIvluz = true;
        }
        zar.append(wIv);
        mIz = mIz * 3;
    }

    var Hoch = jQuery("<option>")
        .attr("value", Number.MAX_SAFE_INTEGER)
        .html("All");
    if (!mIz_wIvluz) {
        Hoch.prop("selected", true);
    }
    zar.append(Hoch);

    var leQ = jQuery(".chabal_chazluzbogh_wIvmeH_leQ");

    leQ.html("Show ");
    leQ.append(zar);
    leQ.append(" entries per page.");

    if (mIz_wIvluz) {
        leQ.append(`<div class="pull-right">
            <button class='button outline small' onclick='chabal_tetlh_chabal_wazDIch_yIwIv("wazDIch");'>
                &lt;&lt;</button>
            <button class='button outline small' onclick='chabal_tetlh_chabal_wazDIch_yIwIv("vorgh");'>
                &lt;</button>
            <input onChange='chabal_tetlh_chabal_wazDIch_yIwIv(this.value);'
                value='${wazDIch + 1}' class='form-control'/> - ${Qav} of ${chabal_zar_tuzluz}
            <button class='button outline small' onclick='chabal_tetlh_chabal_wazDIch_yIwIv("veb");'>
                &gt;</button>
            <button class='button outline small' onclick='chabal_tetlh_chabal_wazDIch_yIwIv("HochDIch");'>
                &gt;&gt;</button>
        </div>`);
    }
}

function chabal_tetlh_chabal_wazDIch_yIwIv(wazDIch)
{
    "use strict";
    var chabal_zar_tuzluz = chabal_tetlh_chabal_chazluzbogh_tItogh();
    var zar_chazluz = chabal_zar_chazluz();
    var wazDIch_chazluzbogh = chabal_chazluzbogh_wazDIch();
    var wazDIch_wIvbogh;

    if (wazDIch == "wazDIch") {
        wazDIch_wIvbogh = 0;
    } else if (wazDIch == "vorgh") {
        wazDIch_wIvbogh = wazDIch_chazluzbogh - zar_chazluz;
    } else if (wazDIch == "veb") {
        wazDIch_wIvbogh = wazDIch_chazluzbogh + zar_chazluz;
    } else if (wazDIch == "HochDIch") {
        wazDIch_wIvbogh = chabal_zar_tuzluz;
    } else {
        wazDIch_wIvbogh = parseInt(wazDIch);
        if (isNaN(wazDIch_wIvbogh)) {
            wazDIch_wIvbogh = 1;
        }
        wazDIch_wIvbogh--;
    }

    if (wazDIch_wIvbogh < 0) {
        wazDIch_wIvbogh = 0;
    }
    if (wazDIch_wIvbogh >= chabal_zar_tuzluz) {
        wazDIch_wIvbogh =
            Math.floor(chabal_zar_tuzluz / zar_chazluz) * zar_chazluz;
    }

    chabal_chazluzbogh_wazDIch_yIwIv(wazDIch_wIvbogh);
    chabal_tetlh_tetlh_yIchaz();
}

/*

This copyright notice and license text refers to the function immediately below:

Copyright (c) 2011 Andrei Mackenzie

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

// Compute the edit distance between the two given strings
function choH_tItogh(a, b){
  "use strict";
  if(a.length === 0) {
      return b.length;
  }
  if(b.length === 0) {
      return a.length;
  }

  var matrix = [];

  // increment along the first column of each row
  var i;
  for(i = 0; i <= b.length; i++){
    matrix[i] = [i];
  }

  // increment each column in the first row
  var j;
  for(j = 0; j <= a.length; j++){
    matrix[0][j] = j;
  }

  // Fill in the rest of the matrix
  for(i = 1; i <= b.length; i++){
    for(j = 1; j <= a.length; j++){
      if(b.charAt(i-1) === a.charAt(j-1)){
        matrix[i][j] = matrix[i-1][j-1];
      } else {
        matrix[i][j] = Math.min(matrix[i-1][j-1] + 1, // substitution
                                Math.min(matrix[i][j-1] + 1, // insertion
                                         matrix[i-1][j] + 1)); // deletion
      }
    }
  }

  return matrix[b.length][a.length];
}
