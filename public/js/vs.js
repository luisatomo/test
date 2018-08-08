jQuery(function() {
    jQuery('.startlive').click(function(e) {
        e.preventDefault();
        $zopim.livechat.window.show();
    });

    jQuery("#datepicker1,#datepicker2,#datepicker3").datepicker({
        minDate: 0,
        maxDate: "+2M +10D",
        dateFormat: "yy-mm-dd"
    });

jQuery('#datepicker4').datepicker(
{
maxDate: "0",
        dateFormat: "yy-mm-dd"
}
);

    jQuery("#datepicker1,#datepicker2,#datepicker3,#datepicker4").val("");

    jQuery("#timepicker1,#timepicker2,#timepicker3").timepicki();

    jQuery(".wpcf7-form-control-wrap").click(function() {
        jQuery(this).children(".wpcf7-not-valid-tip").css("display", "none");
    });

jQuery(window).scroll(function(){
		if((jQuery(window).scrollTop()>85&&jQuery(window).width()>767)||(jQuery(window).scrollTop()>125&&jQuery(window).width()<768)){
		jQuery('.navbar-verasafe').addClass('navbar-fixed-top');
		}
		else{
		jQuery('.navbar-verasafe').removeClass('navbar-fixed-top');		
		}
	});

jQuery(".click-button").click(function() {
    jQuery('html, body').animate({
        scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top
    }, 2000);
});

jQuery('.free-con-form p').each(function() {
    var $this = $(this);
    if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});

if(jQuery(window).width()<992&&jQuery('.fullwidth').length){
jQuery('.sidebar').appendTo(jQuery('.vscontainer'));
}

jQuery( window ).resize(function() {
if(jQuery(window).width()>991&&jQuery('.fullwidth').length&&jQuery('.vscontainer > .sidebar').length){
jQuery('.vscontainer > .sidebar').insertAfter('.mainc');
}
else if(jQuery(window).width()<992&&jQuery('.fullwidth').length&&jQuery('.vscontainer > .container > .row > .sidebar').length){
jQuery('.sidebar').appendTo(jQuery('.vscontainer'));
}
});

jQuery('.stepOneContentSidebarForm button.btn').click(function(e){
e.preventDefault();
if(jQuery('input:checked').val()=='contact'){
window.location='/about-verasafe/contact-us/';
}
else{
if(!jQuery('input').is(':checked')){
alert('Please Select your Organization’s Approximate Annual Revenue (Gross)');
return false;
}
jQuery('.stepOneContentSidebarForm').submit();
}
});

});
