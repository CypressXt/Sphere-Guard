/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.onresize = function (event) {
    setWrapperHeight();
    resizeLeftMenu();
    displayToMobileMargin();
};

$(document).ready(function () {
    setWrapperHeight();
    resizeLeftMenu();
    displayToMobileMargin();
});

function resizeLeftMenu() {
    dashboardHeight = $(".dashBoard").outerHeight();
    $(".leftMenu").outerHeight(dashboardHeight);
}

function displayToMobileMargin() {
    windowSize = $(window).width();
    if (windowSize < 992) {
        $(".dashBoard").css('margin-top', 70 + 'px');
        $(".dashWrapper").css('padding-bottom', 70 + 'px');
    } else {
        $(".dashBoard").css('margin-top', 30 + 'px');
    }
}

function setWrapperHeight() {
    $(".dashBoard").css('min-height', ($(window).height() * 70 / 100) + 'px')
}