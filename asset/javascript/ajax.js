/* 
 * Clément Hampaï
 */

var nbClickRemoveUser = 0;

/**
 * This function remove the given user by id.
 * @param {int} userId
 * @returns {void}
 */
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

/**
 * This function create a new api key and set it to the given user by id.
 * @param {int} userId
 * @returns {void}
 */
function requestAjaxRefreshKeyUser(userId) {
    var inputKey = document.getElementById('key' + userId);
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshKey", user_pk: userId}, function(e) {
        if (e !== "") {
            inputKey.value = e;
        }
    });
}

/**
 * This function create a new api user, if isAdministrator is set to 1
 * the new user can log in the administration panel, otherwise he can only use
 * the Sphere-Guard api. 
 * @param {string} name
 * @param {string} mail
 * @param {string} password
 * @param {string} passwordConf
 * @param {0/1} isAdministrator
 * @returns {void}
 */
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

/**
 * This function refresh the user's table.
 * @returns {void}
 */
function requestAjaxUpdateUserTable() {
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshUserTable"}, function(e) {
        if (e !== "") {
            console.log(e);
            $('#userArea').html(e);
        }
    });
}

/*
 * This function add a new host and refresh the host's table.
 * @param {string} name hostname
 * @param {string} ipAddr IPv4 from the new host
 * @returns {void}
 */
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

/**
 * This function update the host's table.
 * @returns {void}
 */
function requestAjaxUpdatehostTable() {
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshHostTable"}, function(e) {
        if (e !== "") {
            $('#hostArea').html(e);
        }
    });
}

/**
 * This function remove the host given by id.
 * @param {int} hostId
 * @returns {void}
 */
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