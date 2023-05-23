function insertPenal(){
    $('#insertPena').bind('submit', function () {
        $.ajax({
            type: 'post',
            url: '../Controller/insertPenalite.php',
            data: $('form').serialize(),
            success: function (response) {
                if (response === 'ok') {
                    $('#insertPena').trigger('reset');
                    viewTabJurons();

                }else{
                    alert('Une erreur est survenue');
                }
            }
        });
        return false;
    });
}

function adminLoad(){
    $.ajax({
        type: 'GET',
        url: '../Controller/executeAdminLoad.php',
        success: function (response){
            let json = JSON.parse(response);
            let currentUser = json.currentUser;
            if(currentUser.id_roles === "1" || currentUser.id_roles === 1){
                document.getElementById('panelAdmin').style.display = 'block';
            }if (currentUser.id_roles === "2" || currentUser.id_roles === 2){
                document.getElementById('panelAdmin').remove();
            }
        }
    });
}

function viewTabBalance(action){
    $.ajax({
        type: 'POST',
        url: '../Controller/executeTabBalance.php',
        data: {
            action: action
        },
        success: function (response){
            let json = JSON.parse(response);
            let success = json.success;
            let newAction = json.action;
            if(success === 'ok'){
                $('#balance').empty();
                if (newAction === 'allTime'){
                    $('#titreBalance').empty();
                    $('#titreBalance').append(
                        'Top des balances All Time');
                    document.getElementById('btnBalanceAll').style.display = 'none';
                    document.getElementById('btnBalanceWeek').style.display = 'block';
                    let balancesAllTime = json.allTime;
                    for(let i = 0; i < balancesAllTime.length; i++){
                        let nom = balancesAllTime[i].nom.toUpperCase();
                        let prenom = balancesAllTime[i].prenom.charAt(0).toUpperCase() + balancesAllTime[i].prenom.slice(1);
                        let place = i+1;
                        let total = balancesAllTime[i].total;
                        $("#balance").append(
                            '<tr>'+
                            '<td>'+ place + '</td>'+
                            '<td>'+ nom + '</td>'+
                            '<td>'+ prenom + '</td>' +
                            '<td>'+ total + '</td>' +
                            '</tr>'
                        );
                    }
                }
                if (newAction === 'week'){
                    $('#titreBalance').empty();
                    $('#titreBalance').append(
                        'Top des balances de la semaine');
                    document.getElementById('btnBalanceAll').style.display = 'block';
                    document.getElementById('btnBalanceWeek').style.display = 'none';
                    let balancesWeek = json.week;
                    for(let i = 0; i < balancesWeek.length; i++){
                        let nom = balancesWeek[i].nom.toUpperCase();
                        let prenom = balancesWeek[i].prenom.charAt(0).toUpperCase() + balancesWeek[i].prenom.slice(1);
                        let place = i+1;
                        let total = balancesWeek[i].total;
                        $("#balance").append(
                            '<tr>'+
                            '<td>'+ place + '</td>'+
                            '<td>'+ nom + '</td>'+
                            '<td>'+ prenom + '</td>' +
                            '<td>'+ total + '</td>' +
                            '</tr>'
                        );
                    }
                }
            }if (success === 'erreur'){
                alert("Impossible d'afficher le tableau");
            }
        }
    });
}
function viewTabCommettre(){
    $.ajax({
        type: 'get',
        url: '../Controller/executeTabCommettre.php',
        data: {
          action : 'load',
        },
        success: function (response) {
            let json = JSON.parse(response);
            let success = json.success;
            let currentUser = json.currentUser;
            if (currentUser.id_roles === "2" || currentUser.id_roles === 2){
                location.href= "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
            }
            if (success === 'ok'){
                document.getElementById('retourArriere').style.display = 'none';
                let infraction;
                let penalitys = json.penalitys;
                $('#viewCommettre').empty();
                for (let i = 0; i < penalitys.length; i++) {
                    let id = penalitys[i].id_commettre;
                    let login = penalitys[i].login_utilisateur;
                    let balance = penalitys[i].login_balance;
                    let date = penalitys[i].date_infraction;
                    if (penalitys[i].code_infraction === 'code_1'){
                        infraction = 'Retard';
                    }
                    if (penalitys[i].code_infraction === 'code_2'){
                        infraction = 'Petit juron'
                    }
                    if (penalitys[i].code_infraction === 'code_3'){
                        infraction = 'Gros juron'
                    }
                    if (penalitys[i].code_infraction === 'code_4'){
                        infraction = 'Rot'
                    }
                    if (penalitys[i].code_infraction === 'code_5'){
                        infraction = 'Geste'
                    }
                        $('#viewCommettre').append(
                            '<tr id="'+ id +'">'+
                            '<td data-label="Infraction">'+ infraction +'</td>' +
                            '<td data-label="Login">'+ login +'</td>' +
                            '<td data-label="Balance">'+ balance +'</td>' +
                            '<td data-label="Date">'+ date +'</td>' +
                            '<td data-label="Action"><button class="btn btn-danger bouton" onclick="deleteCommettre('+ id +')" >Supprimer</button></td>' +
                            '</tr>'
                        )
                }

            }else if (success === 'erreur'){
                alert("Error");
            }
        }
    });

}

function deleteCommettre(id){
    $.ajax({
        method: 'post',
        url: '../Controller/executeDeleteCommettre.php',
        data:{
            id: id,
        },
        success: function (response){
            if (response === 'ok'){
                document.getElementById(id).remove();
            }if (response === 'erreur'){
                alert("Une erreur est survenue");
            }
        }
    })
}

function searchLogin(){
    let login = $('#searchName').val();
        $.ajax({
            type: 'post',
            url: '../Controller/executeTabCommettre.php',
            data: {
                action: 'search',
                login: login
            },
            success: function (response) {
                let json = JSON.parse(response);
                let success = json.success;
                if (success === 'ok'){
                    $('#search').trigger('reset');
                    document.getElementById('retourArriere').style.display = 'block';
                    let infraction;
                    let penalitys = json.penalitys;
                    $('#viewCommettre').empty();
                    for (let i = 0; i < penalitys.length; i++) {
                        let id = penalitys[i].id_commettre;
                        let login = penalitys[i].login_utilisateur;
                        let balance = penalitys[i].login_balance;
                        let date = penalitys[i].date_infraction;
                        if (penalitys[i].code_infraction === 'code_1'){
                            infraction = 'Retard';
                        }
                        if (penalitys[i].code_infraction === 'code_2'){
                            infraction = 'Petit juron'
                        }
                        if (penalitys[i].code_infraction === 'code_3'){
                            infraction = 'Gros juron'
                        }
                        if (penalitys[i].code_infraction === 'code_4'){
                            infraction = 'Rot'
                        }
                        if (penalitys[i].code_infraction === 'code_5'){
                            infraction = 'Geste'
                        }
                        $('#viewCommettre').append(
                            '<tr id="'+ id +'">'+
                            '<td data-label="Infraction">'+ infraction +'</td>' +
                            '<td data-label="Login">'+ login +'</td>' +
                            '<td data-label="Balance">'+ balance +'</td>' +
                            '<td data-label="Date">'+ date +'</td>' +
                            '<td data-label="Action"><button class="btn btn-danger bouton" onclick="deleteCommettre('+ id +')" >Supprimer</button></td>' +
                            '</tr>'
                        )
                    }

                }else if (success === 'erreur'){
                    alert("Error");
                }
            }

        });


}

function viewTabInfraction(){
    $.ajax({
        type: 'get',
        url: '../Controller/executeTabInfraction.php',
        data: {
          action : 'load',
        },
        success: function (response) {
            let json = JSON.parse(response);
            let success = json.success;
            if (success === 'ok'){
                let infractions = json.infractions;
                $('#viewInfraction').empty();
                for (let i = 0; i < infractions.length; i++) {
                    let code = infractions[i].code_infraction;
                    let categorie = infractions[i].categorie_infraction;
                    let tarif = infractions[i].tarif_infraction;
                    $('#viewInfraction').append(
                        '<tr id="'+ code +'">'+
                        '<td class="formInfra" data-label="Code">'+ code +'</td>'+
                        '<td class="formInfra" data-label="Categorie">'+ categorie +'</td>'+
                        '<td class="formInfra" data-label="Tarif">'+ tarif +'</td>' +
                        '<td class="formInfra" data-label="Action"><button onclick="deleteInfraction('+ code +')" class="btn btn-danger bouton">Supprimer</button></td>'+
                        '</tr>')
                }
            }else if (success === 'erreur'){
                alert("Error");
            }
        }
    })
}

function insertInfraction(){

    let code = $('#code').val();
    let categorie = $('#categorie').val();
    let tarif = $('#tarif').val();
        $.ajax({
            method: 'post',
            url: '../Controller/executeTabInfraction.php',
            data:{
                action: 'add',
                code: code,
                categorie: categorie,
                tarif: tarif,
            },
            success: function (response){
                if (response === 'ok'){
                    $('#insertInfra').trigger('reset');
                    viewTabInfraction();
                }else {
                    alert("Une erreur est survenue");
                }
            }
        });

}


// creation d'un call ajax pour l'envoi des données d'un formulaire
function inscription(){
    $('#connexion').bind('submit', function () {
        $.ajax({
            type: 'post',
            url: '../Controller/executeInscription.php',
            data: $('form').serialize(),
            success: function (response) {
                if (response === 'ok') {
                    $('#connexion').trigger('reset');
                    location.href = '../View/login.php';
                }else if (response === 'erreur') {
                    alert('Formulaire incomplet !');
                }
            }
        });
        return false;
    });
}


function viewTabJurons(){
        $.ajax({
            type: 'get',
            url: '../Controller/executeTableau.php',
            success: function (response) {
                let json = JSON.parse(response);
                let success = json.success;
                if (success === 'ok') {
                    $('#viewJurons').empty();
                    let data = json.data;

                    for (let i = 0; i < data.length; i++) {
                        //envoie les données reçu par le controller dans le tableau.
                        $('#viewJurons').append(
                            '<tr>' +
                            '<td>' + data[i].nom.toUpperCase() + '</td>' +
                            '<td>' + data[i].prenom + '</td>' +
                            '<td>' + data[i].petit + '</td>' +
                            '<td>' + data[i].gros + '</td>' +
                            '<td>' + data[i].rot + '</td>' +
                            '<td>' + data[i].geste + '</td>' +
                            '<td>' + data[i].retard + '</td>' +
                            '<td>' + data[i].total + '</td>' +
                            '</tr>'
                        )
                    }


                }
                if (success === 'erreur') {
                    alert('Impossible de proceder aux changements');
                }
                if (success === 'no users found'){
                    alert("Il ni a actuellement pas d'infraction");
                }

            }
        });
}

function insertJuron(){

    $.ajax({
        method: 'post',
        url: '../Controller/executeAdminLoad.php',
        success: function (response) {
            let json = JSON.parse(response);
            let users = json.users;
            for (let i = 0; i < users.length; i++) {
                let nom = users[i].nom.toUpperCase();
                let prenom = users[i].prenom.charAt(0).toUpperCase() + users[i].prenom.slice(1);

                $('#select').append(
                    '<option value="' + users[i].login_utilisateur + '">' + nom +
                    ' ' + prenom + '</option>');
            }
            //Récupère les données de tout les utilisateur pour les mettre dans le formulaire d'infraction.
        }
    });

}

function deleteInfraction(code){
    $.ajax({
        method: 'post',
        url: '../Controller/executeDeleteInfraction.php',
        data:{
            code: code,
        },
        success: function (response){
            if (response === 'ok'){
                document.getElementById(code).remove();
            }if (response === 'erreur'){
                alert("Une erreur est survenue");
            }
        }
    });
}

function loadUsersFormAdmin(){
    $.ajax({
        method: 'post',
        url: '../Controller/executeAdminLoad.php',
        success: function (response) {
            let json = JSON.parse(response);
            let users = json.users;
            for (let i = 0; i < users.length; i++) {
                let nom = users[i].nom.toUpperCase();
                let prenom = users[i].prenom.charAt(0).toUpperCase() + users[i].prenom.slice(1);
                $('#selectUser').append('<option value="' + users[i].login_utilisateur + '">' + nom + ' ' + prenom + '</option>');
            }
        }
    });
}

function insertAdmin() {
    let login = $('#selectUser').val();
    let role = $('#selectRole').val();
        $.ajax({
            url: '../Controller/executeChangeRole.php',
            method : 'post',
            data : {
                login: login,
                role: role,
            },
            success: function (response) {
                if (response === 'ok') {
                    $('#insertAdmin').trigger('reset');
                    alert('Administrateur ajouté avec succès');
                }else {
                    alert('Une erreur est survenue');
                }
            }
        });
}

function loginMe(){
    let login = $('#login').val();
    let password = $('#password').val();
    $.ajax({
        method: 'post',
        url: '../Controller/executeLogin.php',
        data: {
            login: login,
            password: password,
        },
        success: function (response) {
            if (response === 'ok') {
                location.href = '../View/index.php';
            }else {
                document.getElementById('messageIncorrect').style.display = 'block';
            }
        }
    });
}

function profil(){
    $.ajax({
        method: 'post',
        url: '../Controller/executeProfil.php',
        success: function (response) {
            let json = JSON.parse(response);
            let success = json.success;
            let msg = json.msg;
            let currentUser = json.currentUser;
            let prenom = currentUser.prenom.charAt(0).toUpperCase() + currentUser.prenom.slice(1);
            let nom = currentUser.nom.toUpperCase();
            $('#bioLogin').append('<span>Login: </span> ' + currentUser.login_utilisateur);
            $('#bioPrenomNom').append('<span>Prenom: </span> ' + prenom + '  <span>Nom: </span>' + nom);
            $('#bioEmail').append('<span>Email: </span> ' + currentUser.email);
            $('#bioDate').append('<span>Date de naissance: </span> ' + currentUser.date_naissance);
            $('#profilEmail').append(currentUser.email);
            $('#nomPrenom').append(prenom + ' ' + nom);
            $('#pdp').append('<img src="'+currentUser.photo+'" alt="photodeprofil" />');
            $('#login').val(currentUser.login_utilisateur);
            $('#password').val(currentUser.password);
            $('#email').val(currentUser.email);
            $('#nom').val(currentUser.nom);
            $('#prenom').val(currentUser.prenom);
            $('#date_naissance').val(currentUser.date_naissance);
            if (success === 'ok') {
                let penality = json.penality;
                $('#profilJurons').append(
                    '<tr>' +
                    '<td>' + penality.petit + '</td>' +
                    '<td>' + penality.gros + '</td>' +
                    '<td>' + penality.rot + '</td>' +
                    '<td>' + penality.geste + '</td>' +
                    '<td>' + penality.retard + '</td>' +
                    '<td>' + penality.total + '</td>' +
                    '</tr>'
                )
            }else{
                document.getElementsByClassName('profilTabJuron').style.display = 'none';
                document.getElementById('profilJ').style.display = 'block';
            }if (msg === 'ok') {
                let balance = json.balance;
                let infraction;
                for (let i = 0; i < balance.length; i++) {
                    if (balance[i].code_infraction === 'code_1') {
                        infraction = 'retard';
                    }if (balance[i].code_infraction === 'code_2') {
                        infraction = 'petite insulte';
                    }if (balance[i].code_infraction === 'code_3') {
                        infraction = 'grosse insulte';
                    }if (balance[i].code_infraction === 'code_4') {
                        infraction = 'rot';
                    }if (balance[i].code_infraction === 'code_5') {
                        infraction = 'geste';
                    }
                    $('#profilBalance').append(
                        '<tr>' +
                        '<td>' + infraction + '</td>' +
                        '<td>' + balance[i].login_utilisateur + '</td>' +
                        '<td>' + balance[i].date_infraction + '</td>' +
                        '</tr>'
                    )
                }
            }else{
                document.getElementById('profilB').style.display = 'block';
                document.getElementById('profilTabBalance').style.display = 'none';
            }
        }
    });
}
