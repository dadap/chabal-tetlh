function chabal_tetlh_chabal_yIpatlh(e)
{
    pongDaH = e.parentNode.id.split('_');

    if (pongDaH.length == 3 && pongDaH[0] == 'chabal' && pongDaH[1] == 'tetlh') {
        if (e.className.includes('ghurmoH')) {
            patlh = 1;
        } else if (e.className.includes('nupmoH')) {
            patlh = -1;
        } else {
            patlh = 0;
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

function chabal_tetlh_tetlh_yIvurmoH()
{
    jQuery.ajax({
        url: chabal_tetlh_wpdata.ajax,
        data: { action: 'chabal_tetlh' },
    }).done(function(Dez) {
        tetlh = JSON.parse(Dez);

        for (chabal in tetlh) {
            jQuery("#chabal_tetlh_" + chabal +
                   " > .mIvwaz").html(tetlh[chabal]);
        }
    });
}
