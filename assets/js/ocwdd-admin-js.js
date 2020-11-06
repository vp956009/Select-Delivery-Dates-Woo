jQuery(document).ready(function(){
    //slider setting options by tabbing
    jQuery('.ocwdd-inner-block ul.tabs li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.ocwdd-inner-block ul.tabs li').removeClass('current');
        jQuery('.ocwdd-inner-block .tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
    })

    jQuery( "#ocwdd_starting_date" ).datepicker({ minDate: 0,dateFormat : "yy/mm/dd" });
    jQuery( "#ocwdd_ending_date" ).datepicker({ minDate: 0,dateFormat : "yy/mm/dd" });

})