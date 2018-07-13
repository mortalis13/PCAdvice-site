( function( global, $ ) {
	var editor,
	syncCSS = function() {
		$( '#custom_css_textarea' ).val( editor.getSession().getValue() );
	},
	loadAce = function() {
    var dom = require("ace/lib/dom");
    ace.require("ace/ext/searchbox");
    // ace.require("ace/ext/language_tools");
    
    editor = ace.edit( 'custom_css_div' );
    editor.$blockScrolling = Infinity
    
    editor.commands.addCommands([{
      name: "toggleFullscreen",
      bindKey: {win: "F11", mac: "F11"},
      exec: function(editor) {
        var fullScreen = dom.toggleCssClass(document.body, "fullScreen")
        dom.setCssClass(editor.container, "fullScreen", fullScreen)
        
        var leftMenu,topMenu,left,top,width,height
        
        if(fullScreen){
          leftMenu=$("#adminmenuwrap")
          topMenu=$("#wpadminbar")
          
          left=leftMenu.width()
          top=topMenu.height()
          width=$(window).width()-left
          height=$(window).height()-top
          
          if(leftMenu.css('display')=='none'){
            left=0
            width="100%"
          }
          
          var container=$(editor.container)
          container.css({
            "width":width,
            "height":height,
            "left":left,
            "top":top,
          })
        }else{
          setInitialStyle()
        }
        
        editor.setAutoScrollEditorIntoView(!fullScreen)
        editor.resize()
      },
      readOnly: true
    }]);

		global.safecss_editor = editor;
    editor.getSession().setUseWrapMode( true );
		editor.getSession().setValue( $( '#custom_css_textarea' ).val() );
    editor.renderer.setScrollMargin(5, 5, 0, 0) 
    
    editor.getSession().setMode("ace/mode/css");
    editor.setTheme("ace/theme/sublime");
    // editor.setTheme("ace/theme/monokai");
    // editor.setTheme("ace/theme/tomorrow_night");
    
    editor.setOptions({
      // enableBasicAutocompletion: true,
      // enableLiveAutocompletion: true,
      // enableSnippets: true,
      enableEmmet: true,
      displayIndentGuides:true,
      fontSize:15,
      useSoftTabs:true,
      // showPrintMargin:false,
      tabSize:2,
      // showInvisibles:true
    });
    
    setInitialStyle()
    editor.resize()
    
		$( '#options_form' ).submit( syncCSS );
    
    editor.focus();
	};
    
	if ( $.browser.msie && parseInt( $.browser.version, 10 ) <= 7 ) {
		$( '#custom_css_container' ).hide();
		$( '#custom_css_textarea' ).show();
		return false;
	} else {
		$( global ).load( loadAce );
	}
  
	global.aceSyncCSS = syncCSS;
  
  function setInitialStyle(){
    var container=$(editor.container)
    container.css({
      "width":"100%",
      "height":"400px",
      "left":"0",
      "top":"0",
    })
  }
  
} )( this, jQuery );
