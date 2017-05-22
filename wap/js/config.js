var SiteUrl = "http://s5.shopwwi.com/mall";
var ApiUrl = "http://s5.shopwwi.com/mo_bile";
var pagesize = 10;
var WapSiteUrl = "http://s5.shopwwi.com/wap";
var IOSSiteUrl = "https://itunes.apple.com/us/app/";
var AndroidSiteUrl = "http://www.shopwwi.com/download/app/AndroidShopWWI2014Moblie.apk";

// auto url detection
(function() {
    var m = /^(https?:\/\/.+)\/wap/i.exec(location.href);
    if (m && m.length > 1) {
        SiteUrl = m[1] + '/mall';
        ApiUrl = m[1] + '/mo_bile';
        WapSiteUrl = m[1] + '/wap';
    }
})();
