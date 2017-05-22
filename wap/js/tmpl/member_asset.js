$(function(){
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/tmpl/member/login.html';
        return;
    }
    $.getJSON(ApiUrl + '/index.php?app=member_index&wwi=my_asset', {key:key}, function(result){
        checkLogin(result.login);
        $('#predepoit').html(result.datas.predepoit+' 元');
        $('#rcb').html(result.datas.available_rc_balance+' 元');
        $('#voucher').html(result.datas.voucher+' 张');
        $('#redpacket').html(result.datas.redpacket+' 个');
        $('#point').html(result.datas.point+' 分');
    });
});