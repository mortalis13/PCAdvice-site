(function() {
  
  tinymce.create('tinymce.plugins.MceShortcuts', {
    /**
     * Initializes the plugin, this will be executed after the plugin has been created.
     * This call is done before the editor instance has finished it's initialization so use the onInit event
     * of the editor instance to intercept that event.
     *
     * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
     * @param {string} url Absolute URL to where the plugin is located.
     */
    init : function(ed, url) {
      ed.addCommand('codeFormat', function() {
        ed.formatter.toggle('code');
      });
      
      ed.addCommand('activateHTML', function() {
        // var tab=$("#content-ace")
        var tab=document.getElementById('content-ace')
        tab && tab.click()
        var x=1
        // ed.formatter.toggle('code');
      });
      
      ed.addShortcut('ctrl+h','Show Blocks','mceVisualBlocks')
      ed.addShortcut('ctrl+r','HTML Tab','activateHTML')
      ed.addShortcut('ctrl+f11','Full Screen','mceFullScreen')
      ed.addShortcut('ctrl+d','Code Format','codeFormat')
    },
  });

  // Register plugin
  tinymce.PluginManager.add('mceShortcuts', tinymce.plugins.MceShortcuts);
  
})();