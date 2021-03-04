$(document).ready(function() {
    // SUPPRESSION D'UN POKEMON DE LA BASE DE DONNEE
    $(".supp").click(function (e) {
        console.log('ok');
        e.preventDefault();

        let PkmnBtn = parseInt($(this).attr('idPkmnBtn'));

        let idPkmn = parseInt($(`#Pkmn-${PkmnBtn}`).attr(`Pkmn-Id`));
        
        console.log(PkmnBtn);
        console.log(idPkmn);

        // let idPkmn = $("id=`idPkmn{PkmnBtn}`")
        // let test = parseFloat($(this).attr('id'));
        // console.log(idPkmn);
    
        $.ajax({
            url: "index.php",
            type: "GET",
            data: "idPkmnBDD=" + idPkmn,
            success: function () {
                console.log('Success !')
                window.location.href = `index.php?supp=${idPkmn}`
            }
        });
    });
});
