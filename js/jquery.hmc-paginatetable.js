(function ( $ ) {

	/*
	Harmonic Paginate Table plugin
	Version: 1.0.0
	
	Options:
	{
		param : ( required | array ) description
	}
	
	Usage:
	
	To do:
	 - lots
	*/
	
	var defaultOptions = {
		'navPosition': 'bottom',
		'navTextNext': 'Next &#8250',
		'navTextPrev': '&#8249 Prev',
		'rowsPerPage': 10,
		'tableSorterJsCompatible': false,
	};

	$.fn.paginator = function( options ) {
		var options = $.extend({}, defaultOptions, options || {});
			
		var table = $(this);
		var rows = table.find("tr").not("tr:first");
		
		var navPosition = options['navPosition'];
		var navTextNext = options['navTextNext'];
		var navTextPrev = options['navTextPrev'];
		var rowsPerPage = options['rowsPerPage'];
		var tableSorter = options['tableSorterJsCompatible'];
		
		var totalPages = Math.ceil( rows.length / rowsPerPage );
		var currPage = 1;
		
		if (totalPages <= 1) return;
		
		var nav = $('<ul class="pag"><li><a href="#">' + navTextPrev + '</a></li></ul>');
		var navLiNext = $('<li><a href="#">' + navTextNext + '</a></li>');
		
		for (var i = 1; i <= totalPages; i++) {
			var li = $('<li><a href="#">' + i + '</a></li>');
			nav.append( li );
		}
		nav.append( navLiNext );
		
		// insert pagination navigation bar(s)
		if ( navPosition == 'top' ) {
			$(this).before(nav);
		} else if ( navPosition == 'bottom' ){
			$(this).after(nav);
		} else {
			var nav2 = nav.clone();
			$(this).before(nav);
			$(this).after(nav2);
			nav = nav.add(nav2);
		}
		
		// set click handlers
		nav.each( function() {
			$(this).find("li").not(":first, :last").each( function(i) {
				$(this).find('a').bind( 'click.paginator', function(e) {
					if (i+1 != currPage) {
						updatePagination(i+1);
					}
					e.preventDefault();
					$(this).blur();
				});
			});
			$(this).find("li:first a").bind( 'click.paginator', function(e) {
				if (currPage > 1) {
					updatePagination( currPage - 1);
				}	
				e.preventDefault();
				$(this).blur();
			});
			$(this).find("li:last a").bind( 'click.paginator', function(e) {
				if (currPage < totalPages) {
					updatePagination( currPage + 1);
				}
				e.preventDefault();
				$(this).blur();
			});
		});
		
		// paginate to page 1
		updatePagination(1);
		
		// paginate to indicated page
		function updatePagination( page ) {
			nav.each( function(i) {
				var lis = $(this).find("li");
				lis.removeClass("active").removeClass("no-link");
				
				lis.eq(page).addClass("active");
				
				if (page == 1) {
					lis.first().addClass("no-link");	
				} else if (page == totalPages) {
					lis.last().addClass("no-link");
				}
			});
				
			// update current page
			currPage = page;
			
			// update table
			var rows = table.find("tr").not("tr:first");
			rows.hide();
			for (var i = 0; i < rowsPerPage; i++) {
				rows.eq( (rowsPerPage * (currPage-1) ) + i).show();
			}
		}
		
		// make compatible with tableSorter.js
		if (tableSorter) {
			// reinitialize when table is sorted with tableSorter.js
			$(this).find("th").click( function() {
				rows.css("visibility", "hidden");
				
				var to = setTimeout( function() {
					updatePagination(1);
					rows.css("visibility", "visible");
				}, 100 );
			});
		}
		
		return $(this);
	}
	
}( jQuery ));