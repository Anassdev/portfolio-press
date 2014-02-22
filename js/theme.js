jQuery(document).ready(function ($) {

	var PortfolioPressJS = {
		'nav' : $('#navigation'),
		'menu' : $('#navigation .nav-menu'),
		'submenu' : false,
	};

	// Enable menu toggle for small screens
	(function() {
		if ( ! PortfolioPressJS.nav ) {
			return;
		}

		button = PortfolioPressJS.nav.find('.menu-toggle');
		if ( ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		if ( ! PortfolioPressJS.menu || ! PortfolioPressJS.menu.children().length ) {
			button.hide();
			return;
		}

		button.on( 'click', function() {
			PortfolioPressJS.nav.toggleClass('toggled-on');
			PortfolioPressJS.menu.slideToggle( '200' );
		} );
	})();

	// If the site title and menu don't fit on the same line, clear the menu
	if ( $('#branding .col-width').width() < ( $('#logo').width() + PortfolioPressJS.nav.width() ) ) {
		$('body').addClass('clear-menu');
	}

	// Centers the submenus directly under the top menu
    function portfolio_desktop_submenus() {
		if ( document.body.clientWidth > 780 && !PortfolioPressJS.submenu ) {
			PortfolioPressJS.menu.attr('style','');
			PortfolioPressJS.nav.find('li').each( function() {
				var ul = $(this).find("ul");
			    if ( ul.length > 0 ) {
			        var parent_width = $(this).outerWidth( true );
			        var child_width = ul.outerWidth( true );
			        var new_width = parseInt((child_width - parent_width)/2);
			        ul.css('margin-left', -new_width+"px");
			    }
			});
			PortfolioPressJS.submenu = true;
		}
	}

	// Clears submenu alignment for the mobile menu
	function portfolio_mobile_submenus() {
		if ( document.body.clientWidth <= 780 && PortfolioPressJS.submenu ) {
			PortfolioPressJS.nav.find('ul').css('margin-left', '');
			PortfolioPressJS.submenu = false;
		}
	}

	// Menu Alignment
    portfolio_desktop_submenus();

    $(window).on('resize', function(){
		portfolio_desktop_submenus();
		portfolio_mobile_submenus();
	});

});