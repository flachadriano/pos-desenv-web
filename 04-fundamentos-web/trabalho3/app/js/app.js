$( document ).on( "pageinit", "#demo-page", function() {
    $( document ).on( "swipeleft", "#demo-page", function( e ) {
        if ( $.mobile.activePage.jqmData( "panel" ) !== "open" ) {
            $( "#right-panel" ).panel( "open" );
        }
    });
});