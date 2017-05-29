<?php
if (!defined('ABSPATH')) {
    die;
}
?>
<style type="text/css">
    ul#cnss-fa-ul li {list-style-type: none; width: 33.33%; float: left; margin-bottom: 20px;}
    ul#cnss-fa-ul li a i{font-size: 32px;}
    ul#cnss-fa-ul li a{text-decoration: none;}
</style>
<script>
function cnssSearchIconFn() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('cnssSearchInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("cnss-fa-ul");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<section id="brand">
  <div class="fontawesome-icon-list">
    <p style="text-align: center;">
      <input style="width:100%; padding: 5px;" type="text" id="cnssSearchInput" onKeyUp="cnssSearchIconFn()" placeholder="Search icons...">
    </p>
    <ul id="cnss-fa-ul">
      <li><a href="#500px"><i class="fa fa-500px" aria-hidden="true"></i> 500px</a></li>
      <li><a href="#adn"><i class="fa fa-adn" aria-hidden="true"></i> adn</a></li>
      <li><a href="#amazon"><i class="fa fa-amazon" aria-hidden="true"></i> amazon</a></li>
      <li><a href="#android"><i class="fa fa-android" aria-hidden="true"></i> android</a></li>
      <li><a href="#angellist"><i class="fa fa-angellist" aria-hidden="true"></i> angellist</a></li>
      <li><a href="#apple"><i class="fa fa-apple" aria-hidden="true"></i> apple</a></li>
      <li><a href="#bandcamp"><i class="fa fa-bandcamp" aria-hidden="true"></i> bandcamp</a></li>
      <li><a href="#behance"><i class="fa fa-behance" aria-hidden="true"></i> behance</a></li>
      <li><a href="#behance-square"><i class="fa fa-behance-square" aria-hidden="true"></i> behance-square</a></li>
      <li><a href="#bitbucket"><i class="fa fa-bitbucket" aria-hidden="true"></i> bitbucket</a></li>
      <li><a href="#bitbucket-square"><i class="fa fa-bitbucket-square" aria-hidden="true"></i> bitbucket-square</a></li>
      <li><a href="#btc"><i class="fa fa-bitcoin" aria-hidden="true"></i> bitcoin <span class="text-muted">(alias)</span></a></li>
      <li><a href="#black-tie"><i class="fa fa-black-tie" aria-hidden="true"></i> black-tie</a></li>
      <li><a href="#bluetooth"><i class="fa fa-bluetooth" aria-hidden="true"></i> bluetooth</a></li>
      <li><a href="#bluetooth-b"><i class="fa fa-bluetooth-b" aria-hidden="true"></i> bluetooth-b</a></li>
      <li><a href="#btc"><i class="fa fa-btc" aria-hidden="true"></i> btc</a></li>
      <li><a href="#buysellads"><i class="fa fa-buysellads" aria-hidden="true"></i> buysellads</a></li>
      <li><a href="#cc-amex"><i class="fa fa-cc-amex" aria-hidden="true"></i> cc-amex</a></li>
      <li><a href="#cc-diners-club"><i class="fa fa-cc-diners-club" aria-hidden="true"></i> cc-diners-club</a></li>
      <li><a href="#cc-discover"><i class="fa fa-cc-discover" aria-hidden="true"></i> cc-discover</a></li>
      <li><a href="#cc-jcb"><i class="fa fa-cc-jcb" aria-hidden="true"></i> cc-jcb</a></li>
      <li><a href="#cc-mastercard"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> cc-mastercard</a></li>
      <li><a href="#cc-paypal"><i class="fa fa-cc-paypal" aria-hidden="true"></i> cc-paypal</a></li>
      <li><a href="#cc-stripe"><i class="fa fa-cc-stripe" aria-hidden="true"></i> cc-stripe</a></li>
      <li><a href="#cc-visa"><i class="fa fa-cc-visa" aria-hidden="true"></i> cc-visa</a></li>
      <li><a href="#chrome"><i class="fa fa-chrome" aria-hidden="true"></i> chrome</a></li>
      <li><a href="#codepen"><i class="fa fa-codepen" aria-hidden="true"></i> codepen</a></li>
      <li><a href="#codiepie"><i class="fa fa-codiepie" aria-hidden="true"></i> codiepie</a></li>
      <li><a href="#connectdevelop"><i class="fa fa-connectdevelop" aria-hidden="true"></i> connectdevelop</a></li>
      <li><a href="#contao"><i class="fa fa-contao" aria-hidden="true"></i> contao</a></li>
      <li><a href="#css3"><i class="fa fa-css3" aria-hidden="true"></i> css3</a></li>
      <li><a href="#dashcube"><i class="fa fa-dashcube" aria-hidden="true"></i> dashcube</a></li>
      <li><a href="#delicious"><i class="fa fa-delicious" aria-hidden="true"></i> delicious</a></li>
      <li><a href="#deviantart"><i class="fa fa-deviantart" aria-hidden="true"></i> deviantart</a></li>
      <li><a href="#digg"><i class="fa fa-digg" aria-hidden="true"></i> digg</a></li>
      <li><a href="#dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i> dribbble</a></li>
      <li><a href="#dropbox"><i class="fa fa-dropbox" aria-hidden="true"></i> dropbox</a></li>
      <li><a href="#drupal"><i class="fa fa-drupal" aria-hidden="true"></i> drupal</a></li>
      <li><a href="#edge"><i class="fa fa-edge" aria-hidden="true"></i> edge</a></li>
      <li><a href="#eercast"><i class="fa fa-eercast" aria-hidden="true"></i> eercast</a></li>
      <li><a href="#empire"><i class="fa fa-empire" aria-hidden="true"></i> empire</a></li>
      <li><a href="#envira"><i class="fa fa-envira" aria-hidden="true"></i> envira</a></li>
      <li><a href="#etsy"><i class="fa fa-etsy" aria-hidden="true"></i> etsy</a></li>
      <li><a href="#expeditedssl"><i class="fa fa-expeditedssl" aria-hidden="true"></i> expeditedssl</a></li>
      <li><a href="#font-awesome"><i class="fa fa-fa" aria-hidden="true"></i> fa <span class="text-muted">(alias)</span></a></li>
      <li><a href="#facebook"><i class="fa fa-facebook" aria-hidden="true"></i> facebook</a></li>
      <li><a href="#facebook"><i class="fa fa-facebook-f" aria-hidden="true"></i> facebook-f <span class="text-muted">(alias)</span></a></li>
      <li><a href="#facebook-official"><i class="fa fa-facebook-official" aria-hidden="true"></i> facebook-official</a></li>
      <li><a href="#facebook-square"><i class="fa fa-facebook-square" aria-hidden="true"></i> facebook-square</a></li>
      <li><a href="#firefox"><i class="fa fa-firefox" aria-hidden="true"></i> firefox</a></li>
      <li><a href="#first-order"><i class="fa fa-first-order" aria-hidden="true"></i> first-order</a></li>
      <li><a href="#flickr"><i class="fa fa-flickr" aria-hidden="true"></i> flickr</a></li>
      <li><a href="#font-awesome"><i class="fa fa-font-awesome" aria-hidden="true"></i> font-awesome</a></li>
      <li><a href="#fonticons"><i class="fa fa-fonticons" aria-hidden="true"></i> fonticons</a></li>
      <li><a href="#fort-awesome"><i class="fa fa-fort-awesome" aria-hidden="true"></i> fort-awesome</a></li>
      <li><a href="#forumbee"><i class="fa fa-forumbee" aria-hidden="true"></i> forumbee</a></li>
      <li><a href="#foursquare"><i class="fa fa-foursquare" aria-hidden="true"></i> foursquare</a></li>
      <li><a href="#free-code-camp"><i class="fa fa-free-code-camp" aria-hidden="true"></i> free-code-camp</a></li>
      <li><a href="#empire"><i class="fa fa-ge" aria-hidden="true"></i> ge <span class="text-muted">(alias)</span></a></li>
      <li><a href="#get-pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i> get-pocket</a></li>
      <li><a href="#gg"><i class="fa fa-gg" aria-hidden="true"></i> gg</a></li>
      <li><a href="#gg-circle"><i class="fa fa-gg-circle" aria-hidden="true"></i> gg-circle</a></li>
      <li><a href="#git"><i class="fa fa-git" aria-hidden="true"></i> git</a></li>
      <li><a href="#git-square"><i class="fa fa-git-square" aria-hidden="true"></i> git-square</a></li>
      <li><a href="#github"><i class="fa fa-github" aria-hidden="true"></i> github</a></li>
      <li><a href="#github-alt"><i class="fa fa-github-alt" aria-hidden="true"></i> github-alt</a></li>
      <li><a href="#github-square"><i class="fa fa-github-square" aria-hidden="true"></i> github-square</a></li>
      <li><a href="#gitlab"><i class="fa fa-gitlab" aria-hidden="true"></i> gitlab</a></li>
      <li><a href="#gratipay"><i class="fa fa-gittip" aria-hidden="true"></i> gittip <span class="text-muted">(alias)</span></a></li>
      <li><a href="#glide"><i class="fa fa-glide" aria-hidden="true"></i> glide</a></li>
      <li><a href="#glide-g"><i class="fa fa-glide-g" aria-hidden="true"></i> glide-g</a></li>
      <li><a href="#google"><i class="fa fa-google" aria-hidden="true"></i> google</a></li>
      <li><a href="#google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i> google-plus</a></li>
      <li><a href="#google-plus-official"><i class="fa fa-google-plus-circle" aria-hidden="true"></i> google-plus-circle <span class="text-muted">(alias)</span></a></li>
      <li><a href="#google-plus-official"><i class="fa fa-google-plus-official" aria-hidden="true"></i> google-plus-official</a></li>
      <li><a href="#google-plus-square"><i class="fa fa-google-plus-square" aria-hidden="true"></i> google-plus-square</a></li>
      <li><a href="#google-wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> google-wallet</a></li>
      <li><a href="#gratipay"><i class="fa fa-gratipay" aria-hidden="true"></i> gratipay</a></li>
      <li><a href="#grav"><i class="fa fa-grav" aria-hidden="true"></i> grav</a></li>
      <li><a href="#hacker-news"><i class="fa fa-hacker-news" aria-hidden="true"></i> hacker-news</a></li>
      <li><a href="#houzz"><i class="fa fa-houzz" aria-hidden="true"></i> houzz</a></li>
      <li><a href="#html5"><i class="fa fa-html5" aria-hidden="true"></i> html5</a></li>
      <li><a href="#imdb"><i class="fa fa-imdb" aria-hidden="true"></i> imdb</a></li>
      <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i> instagram</a></li>
      <li><a href="#internet-explorer"><i class="fa fa-internet-explorer" aria-hidden="true"></i> internet-explorer</a></li>
      <li><a href="#ioxhost"><i class="fa fa-ioxhost" aria-hidden="true"></i> ioxhost</a></li>
      <li><a href="#joomla"><i class="fa fa-joomla" aria-hidden="true"></i> joomla</a></li>
      <li><a href="#jsfiddle"><i class="fa fa-jsfiddle" aria-hidden="true"></i> jsfiddle</a></li>
      <li><a href="#lastfm"><i class="fa fa-lastfm" aria-hidden="true"></i> lastfm</a></li>
      <li><a href="#lastfm-square"><i class="fa fa-lastfm-square" aria-hidden="true"></i> lastfm-square</a></li>
      <li><a href="#leanpub"><i class="fa fa-leanpub" aria-hidden="true"></i> leanpub</a></li>
      <li><a href="#linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i> linkedin</a></li>
      <li><a href="#linkedin-square"><i class="fa fa-linkedin-square" aria-hidden="true"></i> linkedin-square</a></li>
      <li><a href="#linode"><i class="fa fa-linode" aria-hidden="true"></i> linode</a></li>
      <li><a href="#linux"><i class="fa fa-linux" aria-hidden="true"></i> linux</a></li>
      <li><a href="#maxcdn"><i class="fa fa-maxcdn" aria-hidden="true"></i> maxcdn</a></li>
      <li><a href="#meanpath"><i class="fa fa-meanpath" aria-hidden="true"></i> meanpath</a></li>
      <li><a href="#medium"><i class="fa fa-medium" aria-hidden="true"></i> medium</a></li>
      <li><a href="#meetup"><i class="fa fa-meetup" aria-hidden="true"></i> meetup</a></li>
      <li><a href="#mixcloud"><i class="fa fa-mixcloud" aria-hidden="true"></i> mixcloud</a></li>
      <li><a href="#modx"><i class="fa fa-modx" aria-hidden="true"></i> modx</a></li>
      <li><a href="#odnoklassniki"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> odnoklassniki</a></li>
      <li><a href="#odnoklassniki-square"><i class="fa fa-odnoklassniki-square" aria-hidden="true"></i> odnoklassniki-square</a></li>
      <li><a href="#opencart"><i class="fa fa-opencart" aria-hidden="true"></i> opencart</a></li>
      <li><a href="#openid"><i class="fa fa-openid" aria-hidden="true"></i> openid</a></li>
      <li><a href="#opera"><i class="fa fa-opera" aria-hidden="true"></i> opera</a></li>
      <li><a href="#optin-monster"><i class="fa fa-optin-monster" aria-hidden="true"></i> optin-monster</a></li>
      <li><a href="#pagelines"><i class="fa fa-pagelines" aria-hidden="true"></i> pagelines</a></li>
      <li><a href="#paypal"><i class="fa fa-paypal" aria-hidden="true"></i> paypal</a></li>
      <li><a href="#pied-piper"><i class="fa fa-pied-piper" aria-hidden="true"></i> pied-piper</a></li>
      <li><a href="#pied-piper-alt"><i class="fa fa-pied-piper-alt" aria-hidden="true"></i> pied-piper-alt</a></li>
      <li><a href="#pied-piper-pp"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i> pied-piper-pp</a></li>
      <li><a href="#pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> pinterest</a></li>
      <li><a href="#pinterest-p"><i class="fa fa-pinterest-p" aria-hidden="true"></i> pinterest-p</a></li>
      <li><a href="#pinterest-square"><i class="fa fa-pinterest-square" aria-hidden="true"></i> pinterest-square</a></li>
      <li><a href="#product-hunt"><i class="fa fa-product-hunt" aria-hidden="true"></i> product-hunt</a></li>
      <li><a href="#qq"><i class="fa fa-qq" aria-hidden="true"></i> qq</a></li>
      <li><a href="#quora"><i class="fa fa-quora" aria-hidden="true"></i> quora</a></li>
      <li><a href="#rebel"><i class="fa fa-ra" aria-hidden="true"></i> ra <span class="text-muted">(alias)</span></a></li>
      <li><a href="#ravelry"><i class="fa fa-ravelry" aria-hidden="true"></i> ravelry</a></li>
      <li><a href="#rebel"><i class="fa fa-rebel" aria-hidden="true"></i> rebel</a></li>
      <li><a href="#reddit"><i class="fa fa-reddit" aria-hidden="true"></i> reddit</a></li>
      <li><a href="#reddit-alien"><i class="fa fa-reddit-alien" aria-hidden="true"></i> reddit-alien</a></li>
      <li><a href="#reddit-square"><i class="fa fa-reddit-square" aria-hidden="true"></i> reddit-square</a></li>
      <li><a href="#renren"><i class="fa fa-renren" aria-hidden="true"></i> renren</a></li>
      <li><a href="#rebel"><i class="fa fa-resistance" aria-hidden="true"></i> resistance <span class="text-muted">(alias)</span></a></li>
      <li><a href="#rss"><i class="fa fa-rss" aria-hidden="true"></i> rss</a></li>
      <li><a href="#rss-square"><i class="fa fa-rss-square" aria-hidden="true"></i> rss-square</a></li>
      <li><a href="#phone"><i class="fa fa-phone" aria-hidden="true"></i> phone</a></li>
      <li><a href="#phone-square"><i class="fa fa-phone-square" aria-hidden="true"></i> phone-square</a></li>
      <li><a href="#safari"><i class="fa fa-safari" aria-hidden="true"></i> safari</a></li>
      <li><a href="#scribd"><i class="fa fa-scribd" aria-hidden="true"></i> scribd</a></li>
      <li><a href="#sellsy"><i class="fa fa-sellsy" aria-hidden="true"></i> sellsy</a></li>
      <li><a href="#share-alt"><i class="fa fa-share-alt" aria-hidden="true"></i> share-alt</a></li>
      <li><a href="#share-alt-square"><i class="fa fa-share-alt-square" aria-hidden="true"></i> share-alt-square</a></li>
      <li><a href="#shirtsinbulk"><i class="fa fa-shirtsinbulk" aria-hidden="true"></i> shirtsinbulk</a></li>
      <li><a href="#simplybuilt"><i class="fa fa-simplybuilt" aria-hidden="true"></i> simplybuilt</a></li>
      <li><a href="#skyatlas"><i class="fa fa-skyatlas" aria-hidden="true"></i> skyatlas</a></li>
      <li><a href="#skype"><i class="fa fa-skype" aria-hidden="true"></i> skype</a></li>
      <li><a href="#slack"><i class="fa fa-slack" aria-hidden="true"></i> slack</a></li>
      <li><a href="#slideshare"><i class="fa fa-slideshare" aria-hidden="true"></i> slideshare</a></li>
      <li><a href="#snapchat"><i class="fa fa-snapchat" aria-hidden="true"></i> snapchat</a></li>
      <li><a href="#snapchat-ghost"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i> snapchat-ghost</a></li>
      <li><a href="#snapchat-square"><i class="fa fa-snapchat-square" aria-hidden="true"></i> snapchat-square</a></li>
      <li><a href="#soundcloud"><i class="fa fa-soundcloud" aria-hidden="true"></i> soundcloud</a></li>
      <li><a href="#spotify"><i class="fa fa-spotify" aria-hidden="true"></i> spotify</a></li>
      <li><a href="#stack-exchange"><i class="fa fa-stack-exchange" aria-hidden="true"></i> stack-exchange</a></li>
      <li><a href="#stack-overflow"><i class="fa fa-stack-overflow" aria-hidden="true"></i> stack-overflow</a></li>
      <li><a href="#steam"><i class="fa fa-steam" aria-hidden="true"></i> steam</a></li>
      <li><a href="#steam-square"><i class="fa fa-steam-square" aria-hidden="true"></i> steam-square</a></li>
      <li><a href="#stumbleupon"><i class="fa fa-stumbleupon" aria-hidden="true"></i> stumbleupon</a></li>
      <li><a href="#stumbleupon-circle"><i class="fa fa-stumbleupon-circle" aria-hidden="true"></i> stumbleupon-circle</a></li>
      <li><a href="#superpowers"><i class="fa fa-superpowers" aria-hidden="true"></i> superpowers</a></li>
      <li><a href="#telegram"><i class="fa fa-telegram" aria-hidden="true"></i> telegram</a></li>
      <li><a href="#tencent-weibo"><i class="fa fa-tencent-weibo" aria-hidden="true"></i> tencent-weibo</a></li>
      <li><a href="#themeisle"><i class="fa fa-themeisle" aria-hidden="true"></i> themeisle</a></li>
      <li><a href="#trello"><i class="fa fa-trello" aria-hidden="true"></i> trello</a></li>
      <li><a href="#tripadvisor"><i class="fa fa-tripadvisor" aria-hidden="true"></i> tripadvisor</a></li>
      <li><a href="#tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i> tumblr</a></li>
      <li><a href="#tumblr-square"><i class="fa fa-tumblr-square" aria-hidden="true"></i> tumblr-square</a></li>
      <li><a href="#twitch"><i class="fa fa-twitch" aria-hidden="true"></i> twitch</a></li>
      <li><a href="#twitter"><i class="fa fa-twitter" aria-hidden="true"></i> twitter</a></li>
      <li><a href="#twitter-square"><i class="fa fa-twitter-square" aria-hidden="true"></i> twitter-square</a></li>
      <li><a href="#usb"><i class="fa fa-usb" aria-hidden="true"></i> usb</a></li>
      <li><a href="#viacoin"><i class="fa fa-viacoin" aria-hidden="true"></i> viacoin</a></li>
      <li><a href="#viadeo"><i class="fa fa-viadeo" aria-hidden="true"></i> viadeo</a></li>
      <li><a href="#viadeo-square"><i class="fa fa-viadeo-square" aria-hidden="true"></i> viadeo-square</a></li>
      <li><a href="#vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i> vimeo</a></li>
      <li><a href="#vimeo-square"><i class="fa fa-vimeo-square" aria-hidden="true"></i> vimeo-square</a></li>
      <li><a href="#vine"><i class="fa fa-vine" aria-hidden="true"></i> vine</a></li>
      <li><a href="#vk"><i class="fa fa-vk" aria-hidden="true"></i> vk</a></li>
      <li><a href="#weixin"><i class="fa fa-wechat" aria-hidden="true"></i> wechat <span class="text-muted">(alias)</span></a></li>
      <li><a href="#weibo"><i class="fa fa-weibo" aria-hidden="true"></i> weibo</a></li>
      <li><a href="#weixin"><i class="fa fa-weixin" aria-hidden="true"></i> weixin</a></li>
      <li><a href="#whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> whatsapp</a></li>
      <li><a href="#wikipedia-w"><i class="fa fa-wikipedia-w" aria-hidden="true"></i> wikipedia-w</a></li>
      <li><a href="#windows"><i class="fa fa-windows" aria-hidden="true"></i> windows</a></li>
      <li><a href="#wordpress"><i class="fa fa-wordpress" aria-hidden="true"></i> wordpress</a></li>
      <li><a href="#wpbeginner"><i class="fa fa-wpbeginner" aria-hidden="true"></i> wpbeginner</a></li>
      <li><a href="#wpexplorer"><i class="fa fa-wpexplorer" aria-hidden="true"></i> wpexplorer</a></li>
      <li><a href="#wpforms"><i class="fa fa-wpforms" aria-hidden="true"></i> wpforms</a></li>
      <li><a href="#xing"><i class="fa fa-xing" aria-hidden="true"></i> xing</a></li>
      <li><a href="#xing-square"><i class="fa fa-xing-square" aria-hidden="true"></i> xing-square</a></li>
      <li><a href="#y-combinator"><i class="fa fa-y-combinator" aria-hidden="true"></i> y-combinator</a></li>
      <li><a href="#hacker-news"><i class="fa fa-y-combinator-square" aria-hidden="true"></i> y-combinator-square <span class="text-muted">(alias)</span></a></li>
      <li><a href="#yahoo"><i class="fa fa-yahoo" aria-hidden="true"></i> yahoo</a></li>
      <li><a href="#y-combinator"><i class="fa fa-yc" aria-hidden="true"></i> yc <span class="text-muted">(alias)</span></a></li>
      <li><a href="#hacker-news"><i class="fa fa-yc-square" aria-hidden="true"></i> yc-square <span class="text-muted">(alias)</span></a></li>
      <li><a href="#yelp"><i class="fa fa-yelp" aria-hidden="true"></i> yelp</a></li>
      <li><a href="#yoast"><i class="fa fa-yoast" aria-hidden="true"></i> yoast</a></li>
      <li><a href="#youtube"><i class="fa fa-youtube" aria-hidden="true"></i> youtube</a></li>
      <li><a href="#youtube-play"><i class="fa fa-youtube-play" aria-hidden="true"></i> youtube-play</a></li>
      <li><a href="#youtube-square"><i class="fa fa-youtube-square" aria-hidden="true"></i> youtube-square</a></li>

      <li><a href="#mobile"><i class="fa fa-mobile" aria-hidden="true"></i> mobile</a></li>
      <li><a href="#address-book"><i class="fa fa-address-book" aria-hidden="true"></i> address-book</a></li>
      <li><a href="#address-book-o"><i class="fa fa-address-book-o" aria-hidden="true"></i> address-book-o</a></li>
      <li><a href="#address-card"><i class="fa fa-address-card" aria-hidden="true"></i> address-card</a></li>
      <li><a href="#address-card-o"><i class="fa fa-address-card-o" aria-hidden="true"></i> address-card-o</a></li>
      <li><a href="#envelope"><i class="fa fa-envelope" aria-hidden="true"></i> email</a></li>
      <li><a href="#envelope-o"><i class="fa fa-envelope-o" aria-hidden="true"></i> email-o</a></li>

    </ul>
  </div>
</section>