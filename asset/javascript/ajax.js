/* 
 * CypressXt
 */

var nbClickRemoveUser = 0;

function requestAjaxRemoveUser(userId) {
    var line = document.getElementById('line' + userId);
    if (nbClickRemoveUser === 1) {
        $.post('/SphereGuard/controller/cAjax.php', {function: "removeApiUser", user_pk: userId}, function(e) {
            if (e === "1") {
                $('#line' + userId).fadeOut(800, function() {
                    $(this).remove();
                });
                $('#lineResp' + userId).fadeOut(800, function() {
                    $(this).remove();
                });
            }
        });
        nbClickRemoveUser = 0;
    } else {
        document.getElementById('buttonRemove' + userId).innerHTML = "Sure ??";
        document.getElementById('buttonRemoveResp' + userId).innerHTML = "Sure ??";
        nbClickRemoveUser++;
    }
}

function requestAjaxRefreshKeyUser(userId) {
    var inputKey = document.getElementById('key' + userId);
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshKey", user_pk: userId}, function(e) {
        if (e !== "") {
            inputKey.value = e;
        }
    });
}


function requestAjaxCreateUser(name, mail, password, passwordConf, isAdministrator) {
    var name = name.val();
    var mail = mail.val();
    var password = password.val();
    var passConf = passwordConf.val();
    var modalNotif = document.getElementById('modalNotifArea');
    $.post('/SphereGuard/controller/cAjax.php', {function: "addUser", name: name, mail: mail, password: password, passConf: passConf, isAdministrator: isAdministrator}, function(e) {
        if (e === "1") {
            modalNotif.innerHTML = '<div class = "alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New api user created successfully !</div>';
            $('#newUserForm').find(':input').each(function() {
                switch (this.type) {
                    case 'password':
                    case 'select-multiple':
                    case 'select-one':
                    case 'text':
                    case 'email':
                    case 'textarea':
                        $(this).val('');
                        break;
                    case 'checkbox':
                    case 'radio':
                        this.checked = false;
                }
            });
            $('#modalNotifArea').fadeIn(800);
            requestAjaxUpdateUserTable();
        } else {

        }
    });
}

function requestAjaxUpdateUserTable() {
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshUserTable"}, function(e) {
        if (e !== "") {
            console.log(e);
            $('#userArea').html(e);
        }
    });
}

function requestAjaxCreateHost(name, ipAddr) {
    var name = name.val();
    var ipAddr = ipAddr.val();
    var modalNotif = document.getElementById('modalNotifArea');
    $.post('/SphereGuard/controller/cAjax.php', {function: "addHost", name: name, ipAddr: ipAddr}, function(e) {
        if (e === "1") {
            modalNotif.innerHTML = '<div class = "alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New api host created successfully !</div>';
            $('#newHostForm').find(':input').each(function() {
                switch (this.type) {
                    case 'password':
                    case 'select-multiple':
                    case 'select-one':
                    case 'text':
                    case 'email':
                    case 'textarea':
                        $(this).val('');
                        break;
                    case 'checkbox':
                    case 'radio':
                        this.checked = false;
                }
            });
            $('#modalNotifArea').fadeIn(800);
            requestAjaxUpdatehostTable();
        } else {

        }
    });
}

function requestAjaxUpdatehostTable() {
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshHostTable"}, function(e) {
        if (e !== "") {
            $('#hostArea').html(e);
        }
    });
}

function requestAjaxRemoveHost(hostId) {
    if (nbClickRemoveUser === 1) {
        $.post('/SphereGuard/controller/cAjax.php', {function: "removeApiHost", hostId: hostId}, function(e) {
            if (e === "1") {
                $('#line' + hostId).fadeOut(800, function() {
                    $(this).remove();
                });
                $('#lineResp' + hostId).fadeOut(800, function() {
                    $(this).remove();
                });
            }
        });
        nbClickRemoveUser = 0;
    } else {
        document.getElementById('buttonRemove' + hostId).innerHTML = "Sure ??";
        document.getElementById('buttonRemoveResp' + hostId).innerHTML = "Sure ??";
        nbClickRemoveUser++;
    }
}