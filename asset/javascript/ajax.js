/* 
 * CypressXt
 */


function requestAjaxRemoveUser(userId) {
    var line = document.getElementById('line' + userId);
    $.post('/SphereGuard/controller/cAjax.php', {function: "removeApiUser", user_pk: userId}, function(e) {
        if (e === "1") {
            $('#line' + userId).fadeOut(800, function() {
                $(this).remove();
            });
        }
    });
}

function requestAjaxRefreshKeyUser(userId) {
    var inputKey = document.getElementById('key' + userId);
    $.post('/SphereGuard/controller/cAjax.php', {function: "refreshKey", user_pk: userId}, function(e) {
        if (e !== "") {
            inputKey.value = e;
        }
    });
}