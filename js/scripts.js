/*function add_club_input() {
	
}

function delete_club_input() {

}*/
function initTable() {
	var docHeight = $(window).height();
	$(".category_wrapper, .table_wrapper").css("height", docHeight - 40);
}

function initTitles() {
	var titleHeight = $(".category_title").height();
	$(".category_buttons").css("margin-top", titleHeight + 5);
	$(".table_spacer").css("height", titleHeight);
}

function initLRHeight() {
	var docHeight = $(window).height();
	var titleHeight = 0; //$(".create_title").outerHeight();
	var totalHeight = docHeight - 40 - titleHeight - 2;
	$(".anno_left, .anno_right").css("height", totalHeight);
}
//205
function initDescrHeight() {
	var LHeight = $(".anno_left").height();
	var aTitleHeight = $(".anno_title").outerHeight();
	var aSEHeight = $(".anno_start_end").outerHeight();
	var aOptHeight = $(".anno_optional").outerHeight();
	var aCalcDescrHeight = LHeight - aTitleHeight - aSEHeight - aOptHeight - 2;
	console.log(aCalcDescrHeight);
	var aDescrLabelHeight = $(".anno_description_label").outerHeight();
	if (aCalcDescrHeight > aDescrLabelHeight + 210) { //*If the height of the mce is smaller than the actual descr div, then resize it to the div
		$(".anno_description").css("height", aCalcDescrHeight);
		console.log("resizing mce");
		var aDescrHeight = $(".anno_description").outerHeight();
		var aDescrLabelHeight = $(".anno_description_label").outerHeight();
		var mceHeight = aDescrHeight - aDescrLabelHeight - 35 - 34 - 34 - 32; //vicious vicious hack. The mceHeight only does it for the white space, so I had to subtract the height of the headers and footers. Must fix later.
		tinymce.init({
		selector: "textarea",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			//"insertdatetime media table contextmenu paste moxiemanager" //*Don't think this plugin matters
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		height: mceHeight,
	});
	} else { //*If the height of the mce is bigger than the actual descr div, then resize the div to the mce
		/*console.log("resizing div");
		var aDescrLabelHeight = $(".anno_description_label").outerHeight();
		console.log("Description Height: " + aDescrLabelHeight);*/
		tinymce.init({
			selector: "textarea",
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				//"insertdatetime media table contextmenu paste moxiemanager" //*Don't think this plugin matters
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			//height: mceHeight,
		});
		/*var mceHeight = $(".mcedummy").height();
		console.log("mce Height: " + mceHeight);
		$(".anno_description").css("height", aDescrLabelHeight + mceHeight);*/
	}
}

function init_delete_clubs() { 
	$(".delete_club").each( 
		function() {
			$(this).unbind("click");
			$(this).click(
				function(e) {
					e.preventDefault();
					//*Make the hidden input to delete
					var club_id = $(this).prev().val();
					if(club_id != "") {
						$("form").append("<input name='cdelete[]' type='hidden' value='"+ club_id +"' />");
					}
					
					//*Removes the input
					$(this).parent().remove();
					//console.log("Clicked and removed.");
				} 
			);
		}
	);
}

function init_delete_sports() { 
	$(".delete_sports").each( 
		function() {
			$(this).unbind("click");
			$(this).click(
				function(e) {
					e.preventDefault();
					//*Make the hidden input to delete
					var sports_id = $(this).prev().val();
					if(sports_id != "") {
						$("form").append("<input name='sdelete[]' type='hidden' value='"+ sports_id +"' />");
					}
					
					//*Removes the input
					$(this).parent().remove();
					//console.log("Clicked and removed.");
				} 
			);
		}
	);
}

function initDeletes() {
	$(".delete_link").click(
		function(e) {
			e.preventDefault();
			if(confirm("Confirm Delete?")) {
				window.location = $(this).prop("href");
			}
		}
	);
}

function initSettingsColumns() {
	var maxHeight = 0;
	$(".settings_columns .column").each(
		function() {
			if($(this).outerHeight() > maxHeight){
				maxHeight = $(this).outerHeight();
			};
		}
	);
	$(".settings_columns .column").height(maxHeight);
}

$(document).ready( function() {
	init_delete_clubs();
	init_delete_sports();
	//var club_counter = 0;
	//Making clubs
	$("#add_club").click(
		function(e) {
			e.preventDefault();
			$("#clubs_info").append("<div class='club_wrapper'><label>New Club:</label><input class='cnew' name='cname[]' type='text' value='' /><input name='cid[]' type='hidden' value=''/><a href='#' class='delete_club'>X</a><br /></div>");
			init_delete_clubs();
		}
	);
	
	$("#add_sports").click(
		function(e) {
			e.preventDefault();
			$("#sports_info").append("<div class='sports_wrapper'><label>New Sport:</label><input class='snew' name='sname[]' type='text' value='' /><input name='sid[]' type='hidden' value=''/><a href='#' class='delete_sports'>X</a><br /></div>");
			init_delete_sports();
		}
	);
});