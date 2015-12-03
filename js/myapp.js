 $(function () {
        $("#tabs").addClass('custom-tabs');
		
		
    var icons = {
        header: "ui-icon-triangle-1-e",
        activeHeader: "ui-icon-triangle-1-s",
        headerSelected: "ui-icon-triangle-1-s"
    };
    var act = 0;
    $( "#accordion" ).accordion({
        icons: icons,
        collapsible: true,
        clearStyle: true,
        heightStyle: "content",
        autoHeight: false,
        create: function(event, ui) {
            //get index in cookie on accordion create event
            if($.cookie('saved_index') != null){
               act =  parseInt($.cookie('saved_index'));
            }
        },
        activate: function(event, ui) {
            //set cookie for current index on change event
            var active = jQuery("#accordion").accordion('option', 'active');
            $.cookie('saved_index', null);
            $.cookie('saved_index', active);
        },
        active:parseInt($.cookie('saved_index'))
    });
    $( "#toggle" ).button().toggle(function() {
        $( "#accordion" ).accordion( "option", "icons", false );
    },
    function() {
        $( "#accordion" ).accordion( "option", "icons", icons );
    });
});