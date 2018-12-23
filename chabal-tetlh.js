var chabal_tetlh = {};

var turwIz_Daq = null;

var chIjmeH_permey = {
    "Not voted on yet" : function (c) { return  c.w == null; },
    "My words" : function (c) { return  c.v != null; },
    "All words" : function (c) { return  true; },
};

var patlh_lurgh = {
    "Total Score" : -1,
    "Number of Votes" : 1,
    "Alphabetical" : 1,
};

var patlh_mIw = {
    "Total Score" : function (a, b) {
        return patlh_lurgh["Total Score"] *
               ((chabal_tetlh[a]["+"] - chabal_tetlh[a]["-"]) -
               (chabal_tetlh[b]["+"] - chabal_tetlh[b]["-"]));
    },
    "Number of Votes" : function (a, b) {
        return patlh_lurgh["Number of Votes"] *
               ((chabal_tetlh[a]["+"] + chabal_tetlh[a]["-"]) -
               (chabal_tetlh[b]["+"] + chabal_tetlh[b]["-"]));
    },
    "Alphabetical" : function (a, b) {
        return patlh_lurgh["Alphabetical"] *
               (chabal_tetlh[a].m.localeCompare(chabal_tetlh[b].m));
    },
};

var patlh_meq = "Number of Votes";

var chIjmeH_per = "Not voted on yet";

function turwIz_Daq_yIper()
{
    if (turwIz_Daq == null) {
        var Daq = document.createElement('a');
        Daq.setAttribute('href', chabal_tetlh_wpdata.ajax);
        Daq.protocol = window.location.protocol;
        turwIz_Daq = Daq.href;
    }

    return turwIz_Daq;
}

function chabal_tetlh_chabal_yIpatlh(e)
{
    var pongDaH = e.parentNode.parentNode.id.split('_');

    if (pongDaH.length == 3 && pongDaH[0] == 'chabal' &&
        pongDaH[1] == 'tetlh') {
        if (e.className.includes('wIvbogh')) {
            patlh = 0;
            e.className = e.className.replace(/ *wIvbogh/, '');
        } else {
            if (e.className.includes('ghurmoH')) {
                patlh = 1;
            } else if (e.className.includes('nupmoH')) {
                patlh = -1;
            } else {
                patlh = 0;
            }
            for (var sibling = e.parentNode.firstElementChild; sibling;
                 sibling = sibling.nextElementSibling) {
                sibling.className = sibling.className.replace(/ *wIvbogh/, '');
            }
            e.className += ' wIvbogh';
        }

        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: 'POST',
            data: {
                action: 'chabal_tetlh',
                chabal: pongDaH[2],
                wIv: patlh
            }
        }).done(function() {
            chabal_tetlh_tetlh_yIvurmoH();
        });
    }
}

function chabal_tetlh_chabal_yIlel(chabal)
{
    if (confirm("Deleting this entry will also remove all associated activity "
        + "including votes and comments.")) {
        jQuery.ajax({
            url: turwIz_Daq_yIper(),
            method: 'POST',
            data: { action: 'chabal_tetlh', yIlel: chabal }
        }).done(function() {
            location.reload(true);
        });
    }
}

function chabal_tetlh_chabal_tlhIn_neH_yughmoH(f)
{
    var gherzID = [];

    Object.keys(chabal_tetlh).forEach(function (p) {
        if (f(chabal_tetlh[p])) {
            gherzID.push(p);
        }
    });

    return gherzID;
}

function chabal_tetlh_tetlh_yIvurmoH()
{
    jQuery.ajax({
        url: turwIz_Daq_yIper(),
        data: { action: 'chabal_tetlh' },
    }).done(function(Dez) {
        var tetlh = JSON.parse(Dez);

        for (var chabal in tetlh) {
            chabal_tetlh[chabal] = tetlh[chabal];
        }

        chabal_tetlh_tetlh_yIchaz();
    });
}

function chabal_tetlh_tetlh_yIchaz()
{
    var tetlh =
        chabal_tetlh_chabal_tlhIn_neH_yughmoH(chIjmeH_permey[chIjmeH_per]);
    tetlh.sort(patlh_mIw[patlh_meq]);

    jQuery("#chabal_tetlh").empty();

    tetlh.forEach(function(chabal) {
        var mIvwaz = chabal_tetlh[chabal]["+"] - chabal_tetlh[chabal]["-"];
        var ghurbogh = chabal_tetlh[chabal]["w"] > 0 ? ' wIvbogh' : '';
        var nupbogh = chabal_tetlh[chabal]["w"] < 0 ? ' wIvbogh' : '';
        var leQmey = chabal_tetlh_wpdata.user != 0 ? `
            <div class='leQmey'>
                <button class='nupmoH${nupbogh}'
                    onclick='chabal_tetlh_chabal_yIpatlh(this);'>-</button>
                <button class='ghurmoH${ghurbogh}'
                    onclick='chabal_tetlh_chabal_yIpatlh(this);'>+</button>
            </div>
        ` : '';
        var yIlel = chabal_tetlh[chabal]["v"] ?
            "<button class='lel' onclick='chabal_tetlh_chabal_yIlel(" +
            chabal + ");'>x</button>\n" : "";

        jQuery("#chabal_tetlh").append(`
            <li>
                <div class='wIv' id='chabal_tetlh_${chabal}'>
                    ${leQmey}
                    <div class='mIz_toghbogh'>${mIvwaz}</div>
                    <div class='gherzID_naQ'>
                        (+${chabal_tetlh[chabal]["+"]} /
                         -${chabal_tetlh[chabal]["-"]})
                    </div>
                </div>
                <div class='chabal'>
                    ${yIlel}
                    <a href='${chabal_tetlh[chabal]["D"]}'>
                        <div class='muz'>
                            ${chabal_tetlh[chabal]["m"]}
                        </div>
                        <div class='QIjmeH_per'>
                            ${chabal_tetlh[chabal]["p"]}
                        </div>
                    </a>
                </div>
            </li>
        `);
    });
}

function chabal_tetlh_chIjmeH_per_yIwIv(per)
{
    chIjmeH_per = per;
    chabal_tetlh_chIjmeH_tetlh_yIchaz();
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_patlh_meq_yIwIv(meq)
{
    patlh_meq = meq;
    jQuery("#patlh_lurgh").val(patlh_lurgh[patlh_meq]);
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_patlh_lurgh_yIwIv(lurgh)
{
    patlh_lurgh[patlh_meq] = parseInt(lurgh);
    chabal_tetlh_tetlh_yIchaz();
}

function chabal_tetlh_chIjmeH_tetlh_yIchaz()
{
    jQuery("#chabal_tetlh_chIjmeH_tetlh").empty();

    Object.keys(chIjmeH_permey).forEach(function(per,mIz) {
        var wIvbogh = (per == chIjmeH_per) ? "wIvbogh" : "";
        jQuery("#chabal_tetlh_chIjmeH_tetlh").append(`
            <li class='${wIvbogh}'
                onclick='chabal_tetlh_chIjmeH_per_yIwIv("${per}");'>
                ${per}
            </li>
        `);
    });
}

function chabal_tetlh_Hoch_yIchaz()
{
    jQuery("#patlh_meq").val(patlh_meq);
    jQuery("#patlh_lurgh").val(patlh_lurgh[patlh_meq]);
    chabal_tetlh_tetlh_yIvurmoH();
    chabal_tetlh_chIjmeH_per_yIwIv(chIjmeH_per);
}
