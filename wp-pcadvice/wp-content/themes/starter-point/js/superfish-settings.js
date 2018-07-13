/* 
 * Custom Superfish settings
 */
 jQuery(document).ready(function($){
  var sf= $('ul.nav-menu');
  enquire.register("screen and (min-width:730px)", {
    // Triggered when a media query matches.
    match : function() {
      sf.superfish({
        delay: 300,
        speed:50,
        disableHI:true,
        autoArrows:true
      });
    },      

    // Triggered when the media query transitions 
    // *from a matched state to an unmatched state*.
    unmatch : function() {
      sf.superfish('destroy');
    }   
  });        
});