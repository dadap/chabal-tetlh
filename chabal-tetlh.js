var chabal_tetlh = {};

function chabal_tetlh_chabal_yIpatlh(e)
{
    var pongDaH = e.parentNode.id.split('_');

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
            url: chabal_tetlh_wpdata.ajax,
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
            url: chabal_tetlh_wpdata.ajax,
            method: 'POST',
            data: { action: 'chabal_tetlh', yIlel: chabal }
        }).done(function() {
            location.reload(true);
        });
    }
}

function chabal_tetlh_tetlh_yIvurmoH()
{
    jQuery.ajax({
        url: chabal_tetlh_wpdata.ajax,
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
    jQuery("#chabal_tetlh").empty();

    for (var chabal in chabal_tetlh) {
        var mIvwaz = chabal_tetlh[chabal]["+"] - chabal_tetlh[chabal]["-"];
        var ghurbogh = chabal_tetlh[chabal]["w"] > 0 ? ' wIvbogh' : '';
        var nupbogh = chabal_tetlh[chabal]["w"] < 0 ? ' wIvbogh' : '';
        var leQmey = chabal_tetlh_wpdata.user != 0 ? `
            <button class='ghurmoH${ghurbogh}'
                onclick='chabal_tetlh_chabal_yIpatlh(this);'>+</button>
            <button class='nupmoH${nupbogh}'
                onclick='chabal_tetlh_chabal_yIpatlh(this);'>-</button>
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
                <a href='${chabal_tetlh[chabal]["D"]}'>
                    <div class='muz'>${chabal_tetlh[chabal]["m"]}</div>
                    <div class='QIjmeH_per'>${chabal_tetlh[chabal]["p"]}</div>
                </a>
                ${yIlel}
            </li>
        `);
    }
}
