function utf8(a){return a=a.replace("é","é"),a=a.replace("à","à"),a=a.replace("ô","ô"),a=a.replace("è","è"),a=a.replace("ê","ê"),a=a.replace("û","û")}function stripHTML(a){return a.replace(/<(.|\n)*?>/g,"")}function Left(a,b){return b<=0?"":b>String(a).length?a:String(a).substring(0,b)}function Right(a,b){if(b<=0)return"";if(b>String(a).length)return a;var c=String(a).length;return String(a).substring(c,c-b)}function listGetAt(a,b,c){var d,e=0,f=0;for(f=0;f<b;f++)e=a.indexOf(c),e>=0?(d=a.substring(0,e),a=a.substring(e+1,a.length+1)):d=a;return d}String.prototype.trim=function(){return this.replace(/^\s+|\s+$/,"")},$(document).ready(function(){$(".news").on("submit",function(a){a.preventDefault(),$.ajax({url:"/app/newsletter-action.cfm",type:"POST",data:$(this).serialize(),success:function(a){$(".news").find(".result-news").html(a)}})}),$("[data-load-remote]").on("click",function(a){a.preventDefault();var b=$(this),c=b.data("load-remote");c&&$(b.data("remote-target")).load(c)})}),$(document).ready(function(){$(window).width()>=980&&$(".dropdown").hover(function(){$(this).find(".dropdown-menu").first().stop(!0,!1).slideDown(200),$(this).parent().toggleClass("show")},function(){$(this).find(".dropdown-menu").first().stop(!0,!1).slideUp(300),$(this).parent().toggleClass("show")}),$(window).width()<=768&&$(".dropdown").click(function(){$(".dropdown-menu").removeClass("show"),$(this).find(".dropdown-menu").toggleClass("show")})}),$(".load_connexion_window").on("click",function(a){$(".connexion_window").show(),$(".connexion_window").load("/inc/singnIn.cfm")}),$("body").on("click",".ls-close-btn",function(){$(".connexion_window").fadeOut()}),$("body").on("click",".forgetPassword > a",function(){$(".logintab").fadeOut("fast"),$(".ls-forgot-password-window").fadeIn("fast")}),$("body").on("click",".backToSignIn > a",function(){$(".logintab").fadeIn("fast"),$(".ls-forgot-password-window").fadeOut("fast")}),$(function(){$('[data-toggle="popover"]').popover(),$('[data-bs-toggle="popover"]').popover(),$('[data-bs-toggle="tooltip"]').tooltip()});