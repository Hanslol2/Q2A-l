$(document).ready(function(){

	// off canvace js
	var menuLeft = document.getElementById( 'qa-nav-group' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;


	showLeftPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'qa-spmenu-push-toright' );
		classie.toggle( menuLeft, 'qa-spmenu-open' );
	};

	// widget heading js
	$(".qa-nav-cat-list.qa-nav-cat-list-1").before("<h2>Categories</h2>");
    $(".qa-activity-count").before("<h2>All Activity Count</h2>");

	//sidebar puldown menu for medium and small devices
	$(function() {

	    var $window = $(window),
	        $a = $("#sidepanelpull"),
	        $l = $("#sidepanelclose"),
	        $side = $(".qa-sidepanel");
	        // sideHeight = $side.height(); // Declared but never used??

	    $a.on("click", function() {
	        $side.slideToggle("fast");
	        $l.fadeToggle("fast");
	        // $a.find('span').text( $a.find('span').text() == 'Hide - Account / Sidebar' ? 'Show - Account / Sidebar' : 'Hide - Account / Sidebar' );
	        $('#sidepull-icon').toggleClass('icon-up-open-big');
	        return false;
	    });

	    $l.hide().on("click", function() {
	        $side.slideToggle("fast");
	        $l.fadeOut("fast");
	        // $a.text( $a.text() == 'Hide Sidebar' ? 'Show Sidebar' : 'Hide Sidebar' );
	        $('#sidepull-icon').toggleClass('icon-up-open-big');
	        return false
	    });

	    $window.resize(function() {
	        var b = $window.width();
	        if (b > 320 && $side.is(":hidden")) {
	            $side.removeAttr("style")
	        }
	    });

	});

});