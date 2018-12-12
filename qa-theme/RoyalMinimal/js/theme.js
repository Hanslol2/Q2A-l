$(document).ready(function(){
var windowheight = document.body.clientHeight;
var docheight = $(document).height();  
var diff = Math.abs(windowheight - docheight); 
if(docheight << windowheight)
{
	$('#footer-filler').css({"height":diff});
}   
var menuLeft=document.getElementById('qa-nav-group'),showLeftPush=document.getElementById('showLeftPush'),body=document.body;showLeftPush.onclick=function(){classie.toggle(this,'active');classie.toggle(body,'qa-spmenu-push-toright');classie.toggle(menuLeft,'qa-spmenu-open');};$(".qa-nav-cat-list.qa-nav-cat-list-1").before("<h2>Categories</h2>");$(".qa-activity-count").before("<h2>All Activity Count</h2>");$(function(){var $window=$(window),$a=$("#sidepanelpull"),$l=$("#sidepanelclose"),$side=$(".qa-sidepanel");$a.on("click",function(){$side.slideToggle("fast");$l.fadeToggle("fast");$('#sidepull-icon').toggleClass('icon-up-open-big');return false;});$l.hide().on("click",function(){$side.slideToggle("fast");$l.fadeOut("fast");$('#sidepull-icon').toggleClass('icon-up-open-big');return false});$window.resize(function(){var b=$window.width();if(b>320&&$side.is(":hidden")){$side.removeAttr("style")}});});});


