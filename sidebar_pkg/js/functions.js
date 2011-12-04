// make jquery work with moo tools
// jQuery.noConflict(); removed for WhoIs Conflicts

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
var ISIE6 = false;
jQuery("document").ready(function($){

	$("#select_state").change(function() {
		PopulateDistricts($("#select_state").val(), "");
	});

	$("#select_state2").change(function() {
		PopulateDistricts($("#select_state2").val(), "2");
	});
	
	
	var version;
	if($.browser.msie){
		userAgent = $.browser.version;
		userAgent = userAgent.substring(0,userAgent.indexOf('.'));	
		version = userAgent;
		// if ie <= 6 hide popup
		if (parseInt(version) > 6) {
			ISIE6 = false;
		} else {
			ISIE6 = true;
		}
	}
	
	
	var hidePopup = false;
	
	// show only for browser size > 1130 in width
	if (parseInt(jQuery(window).width()) < 1130){
		hidePopup = true;
	};
	
	if(ISIE6){
		hidePopup1 = true;
	}
	
	$(window).resize(function() {
		var hidePopup1 = false;
		var version;
		if(ISIE6){
			hidePopup1 = true;
		}
		
		if (parseInt($(window).width()) < 1130){
			hidePopup1 = true;
		}

		// hide popup when its the case
		if (hidePopup1 == true) {
			$("#sidebar_popup").css("display", "none");
		} else {
			$("#sidebar_popup").css("display", "block");
		}
	});
	
	
	
	// hide popup when its the case
	if (hidePopup) {
		$("#sidebar_popup").css("display", "none");
	} else {
		$("#sidebar_popup").css("display", "block");
	}
	
	var OPENED_POPUP;
	
	$("a.watchus").click(function(){
		chk = 'true';
		$("#watchus_dialog").modal({onOpen: function (dialog) {
			dialog.overlay.fadeIn('slow', function () {
				dialog.container.slideDown('slow', function () {
					dialog.data.fadeIn('slow');
				});
			});
		}});
		return false;
	});
	
	$("a.inventit").click(function(){
		chk = 'true';
		$("#inventit_dialog").modal({onOpen: function (dialog) {
			dialog.overlay.fadeIn('slow', function () {
				dialog.container.slideDown('slow', function () {
					dialog.data.fadeIn('slow');
				});
			});
		}});
		return false;
	});
	
	
	
	$("a.loveit").click(function(){
		$("#loveit_dialog").modal({onOpen: function (dialog) {
			dialog.overlay.fadeIn('slow', function () {
				dialog.container.slideDown('slow', function () {
					dialog.data.fadeIn('slow');
				});
			});
		}});
		return false;
	});
	
});

var chk = 'true';

	
function PopulateDistricts(state, selectid) {	
	jQuery('#select_district_box' + selectid).html("<img src='sidebar_pkg/sidebar_img/loader.gif' />");
	
	jQuery.ajax({
		type: "GET",
		data : "state=" + state + "&selectid=select_district" + selectid,
		url: "sidebar_pkg/functions/populate.php",
		success: function(data) {
			jQuery('#select_district_box' + selectid).html(data);	
			jQuery("#select_district" + selectid).change(function() {
				PopulateSchools(jQuery(this).val(), selectid);
			});
		}
	});
}

function PopulateSchools(district, selectid) {
	jQuery('#select_school_box'  + selectid).html("<img src='sidebar_pkg/sidebar_img/loader.gif' />");
	
	jQuery.ajax({
		type: "GET",
		data : "district=" + district + "&selectid=select_school" + selectid,
		url: "sidebar_pkg/functions/populate2.php",
		success: function(data) {
			jQuery('#select_school_box' + selectid).html(data);
		}
	});
}

function ShowSDSBOX() {
	if (chk != 'true'){			
		jQuery("#statedisctrictschool_box").show('slow');
		jQuery("#statedisctrictschool_box2").show('slow');
		jQuery("#simplemodal-container").animate({'height': '+=100px'},'slow');
		chk = 'true';
	}
}
		
function HideSDSBOX() {
	if (chk == 'true'){
		jQuery("#statedisctrictschool_box").hide('fast');
		jQuery("#statedisctrictschool_box2").hide('fast');
		jQuery("#simplemodal-container").animate({'height': '-=100px'},'slow');
		chk = 'false';
	}
}

function SubmitDataAjax(str, boxid) {
	jQuery('#' + boxid).html("<img src='sidebar_pkg/sidebar_img/loader.gif' />");

	jQuery.ajax({
		type: "GET",
		data: str,
		url: "sidebar_pkg/SF_Connector/insertlead.php",
		success: function(data) {
			//alert("##completed##" + data);
			jQuery('#' + boxid).html('Thank you for registering! <input type="button" id="successButton" value="OK" onClick="jQuery.modal.close();" />');	
		}
	});
}

function getQueryString(boxID) {
	var first_name = jQuery("#first_name" + boxID).val();
	var last_name = jQuery("#last_name" + boxID).val();
	var email = jQuery("#email" + boxID).val();

	var choosen_state = jQuery("#select_state"+ boxID).val();
	var choosen_district = jQuery("#select_district" + boxID).val();
	var choosen_school = jQuery("#select_school" + boxID).val();
	
	if (choosen_district == "") {
		choosen_school = "";
	}
	
	var LeadSource = jQuery("#LeadSource").val();
	
	var submitstring = "";
	submitstring +=  "FirstName=" + first_name;
	submitstring += "&LastName=" + last_name;
	submitstring += "&Email=" + email;
		
	if (jQuery('input:radio[name=RadioGroup' + boxID + ']:checked').val().toLowerCase() == "yes") {
		submitstring += "&State=" + choosen_state;
		submitstring += "&District=" + choosen_district;
		submitstring += "&School=" + choosen_school;
	}
	submitstring += "&LeadSource=" + LeadSource;
	
	if (boxID == "2" || boxID == 2){
		submitstring += "&Builder=1";
	}
	
	//alert("submitstring" + submitstring);
	return submitstring;
}

function SubmitData(){
	jQuery("#info_box").hide();
	if (!isValidEmailAddress(jQuery("#email").val())) {
		jQuery("#info_box").html('<span style = "color : #660000">Please enter a valid email adress</span>');
		jQuery("#info_box").show();
		return false;
	}
	var submitstring = getQueryString("");	
	SubmitDataAjax(submitstring, "response_box");
}

function SubmitData2(){
	jQuery("#info_box2").hide();
	if (!isValidEmailAddress(jQuery("#email2").val())) {
		jQuery("#info_box2").html('<span style = "color : #660000">Please enter a valid email adress</span>');
		jQuery("#info_box2").show();
		return false;
	}
	var submitstring = getQueryString("2");	
	SubmitDataAjax(submitstring, "response_box2");
}


