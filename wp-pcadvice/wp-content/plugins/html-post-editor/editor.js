
jQuery(document).ready(function ($) {	

  $('.wp-switch-editor.switch-html').attr('disabled',false)
  $('.wp-switch-editor.switch-ace').attr('disabled',false)
  
  // $(document).on('keydown.starter', function(e){
  //   if(e.ctrlKey && e.which === 82 ) {
  //     var tab=$("#content-ace")
  //     tab.click()
  //     var x=1
  //   }
  // });
  
	$('#content').AceEditor({

		setEditorContent: function () {
      tinyMCE.get(this.element).save()
      
      var value = $("#content").text();
      var frame=$("#content_ifr")[0]
      if(frame) value=frame.contentDocument.body.innerHTML
        
      var opt={
        'indent_inner_html': false,
        'indent_size': 2,
        "wrap_line_length":0,
        "end_with_newline":true,
      }
      
      value=html_beautify(value,opt)
      value=this.customFormatHTML(value)
   
  		this.editor.getSession().setValue(value);			
		},
    
		onInit: function () {
			var self = this;
      
      var button=$('<button id="content-ace" type="button" class="wp-switch-editor switch-ace">HTML</button>')
      button.appendTo('.wp-editor-tabs')
      
			button.click(function () {
        if(!self.loaded) self.loadAce();
        return false
      });
			
			$('#content-html, #content-tmce').on('click', function (e) {
				var clicked = $(e.currentTarget).attr('id').split('-')[1];
        
        if(self.loaded){
  				switch (clicked) {
  					case 'tmce':
              // this.$elem.hide();
              self.$container.find(".mce-container").show();
              $('.wp-switch-editor.switch-html').attr('disabled',false)
              $('.wp-switch-editor.switch-ace').attr('disabled',false)
              // $(".mce-container",this.$container).show();
              // $("#content").hide();
              // $("#ed_toolbar").hide();
              break;
            case 'html':
              self.$elem.show();
              $("#ed_toolbar").show();
              break;
          }
          
          self.synchronize.apply(self);
  				self.destroy(e);
        }else{
          switch (clicked) {
            case 'tmce':
              $('.wp-switch-editor.switch-ace').attr('disabled',false)
              break;
            case 'html':
              $('.wp-switch-editor.switch-ace').attr('disabled',true)
              break;
          }
        }
			});
		},
    
		onLoaded: function () {
      this.$elem.hide();
      this.$container.find(".mce-container").hide();
      // $(".mce-container",this.$container).hide();
			// $("#ed_toolbar").hide();
			$('#wp-content-wrap').removeClass('html-active tmce-active').addClass('ace-active');
      
      $('.wp-switch-editor.switch-html').attr('disabled',true)
      this.editor.focus()
		},
    
		onDestroy: function (e) {
			var clicked = $(e.currentTarget).attr('id').split('-')[1];
			var check;
			setUserSetting('editor', clicked);
      
      
      $('#wp-content-wrap').addClass(clicked + '-active').removeClass('ace-active');
      
      switch (clicked) {
        case 'tmce':
          // this.$elem.hide();
          
          this.$container.css({
            "width":"auto", 
            "height":"auto", 
            "min-height": "auto", 
            "min-width": "auto", 
          })
          break;
        case 'html':
					break;
			}
		}
    
	});

});

(function ($) {
	var AceSettings = AceSettings || {};	
	var AceEditor = function (config) {
		$.extend(this, config);
		
		this.$elem = this.element;
		this.element = this.$elem.attr('id');
		
		this.$container = this.container ? $(this.container) : this.$elem.parent();	
		this.contWd = this.$container.width();
		this.loaded = false;
		this.tinymce = !!window.tinymce;
		
		if (this.onInit) this.onInit.call(this);		
	};

	AceEditor.prototype = {
		
		loadAce: function () {
      if (this.loaded) return false;
			var self = this;
      
      this.height=this.$container.height(),
			this.insertEditor();	
      
			this.editor = ace.edit(this.aceId);
			this.$editor = $('#' + this.aceId);
      
			this.setEditorProps();
      this.setEditorContent();  
			this.setEditorStyle();	
      
      this.editor.resize(true);
      
			this.loaded = true;
      if (this.onLoaded) 
        this.onLoaded.call(this);
		},
		
		insertEditor: function () {
			$('<div id="' + this.aceId + '"></div>').insertAfter(this.$elem);
		},
		
		setEditorProps: function () {
      // ace.require("ace/ext/language_tools");
      
      this.editor.$blockScrolling = Infinity
      
      var dom = require("ace/lib/dom");
      this.editor.commands.addCommands([{
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
          }else{
            left=0
            top=0
            width="auto"
            height="auto"
          }
          
          var container=$(editor.container)
          container.css({
            "width":width,
            "height":height,
            "left":left,
            "top":top
          })
          
          editor.setAutoScrollEditorIntoView(!fullScreen)
          editor.resize()
        },
        readOnly: true
      }]);

      this.editor.commands.addCommands([{
        name: "newLine",
        bindKey: {win: "Ctrl+Enter", mac: "Command+Enter"},
        exec: function(editor) {
          editor.navigateLineEnd()
          editor.getSession().getDocument().insertNewLine(editor.getCursorPosition())
        },
        readOnly: true
      }]);
      
      this.editor.commands.addCommands([{
        name: "Visual Tab",
        bindKey: {win: "Ctrl+R", mac: "Command+R"},
        exec: function(editor) {
          var tab=$('#content-tmce')
          tab && tab.click()
        },
        readOnly: true
      }]);
      
      this.editor.getSession().setMode('ace/mode/html');
			this.editor.setTheme('ace/theme/sublime');
      
      this.editor.getSession().setUseWrapMode(true);
      this.editor.getSession().setTabSize(2);
      this.editor.setShowPrintMargin( false );
      
      this.editor.setOptions({
        // enableBasicAutocompletion: true,
        // enableSnippets: true,
        // enableLiveAutocompletion: true,
        enableEmmet: true,
        behavioursEnabled:false,
        displayIndentGuides:true,
      });
		},
		
		setEditorStyle: function () {
      var self=this
      this.$container.css({
        "position": 'relative',
        "min-height": "100px",
        "height":this.height,
      })
      
      this.editor.renderer.setScrollMargin(5, 5, 0, 0) 
      
      this.$container.resizable({
        handles:'s',
        resize: function( event, ui ) {
          self.editor.resize();
        }
      })
		},
		
		synchronize: function () {
			var val = this.editor.getValue();
      $("#content").text(val)
      
      var mceElement=tinyMCE.get(this.element)
			if (this.tinymce && mceElement){
        mceElement.setContent(val);
      }
		},
		
    destroy: function () {
      if (!this.loaded) return false;
      this.$editor.remove();
      this.editor.destroy();
      // this.$elem.show();
      this.loaded = false;
      if (this.onDestroy) 
        this.onDestroy.apply(this, arguments);
    },
    
		customFormatHTML: function (value) {
      var newLineTags=['p','pre','div','h3']
      
      var val=value
      for(var i in newLineTags){
        var tag=newLineTags[i]
        var rx=new RegExp("(<"+tag+")","g")
        val=val.replace(rx,'\n$1')
      }
      
      return val
		}
		
	};
	
	$.fn.AceEditor = function (option, value) {
		var option = option || null;
		var data = $(this).data('AceEditor');
		
		if (data && typeof option == 'string' && data[option]) {                    // if data exists (has been instantiated) and calling a public method
			data[option](value || null);
		} else if (!data) {                                                         // if no data, then instantiate the plugin
      
			return this.each(function () {
				var config = $.extend({
					element: $(this),
					aceId: 'ace-editor',
					theme: 'textmate',
					defaultHt: '400px',
					container: false
				}, option);		
				$(this).data('AceEditor', new AceEditor(config));
			});
      
		} else {
			$.error( 'Method "' +  option + '" does not exist on AceEditor!');
		}
	};
	
	
})(jQuery);


