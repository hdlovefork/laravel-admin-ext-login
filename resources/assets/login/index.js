(function(global,$){
    var $err = $('#err');
    var showError = function(el,err){
        $err.html(err).show();
        el.focus();
    };

    $('form').on('submit',function(){
        var account = $('#account'),pwd = $('#pwd');
        if(!account.val())return showError(account,'请输入用户名!');
        if(!pwd.val()) return showError(pwd,'请输入密码!');
    })
})(window,jQuery);

$(document).ready(function() {
    $('.login-bg').iosParallax({
        movementFactor: 50
    });
});