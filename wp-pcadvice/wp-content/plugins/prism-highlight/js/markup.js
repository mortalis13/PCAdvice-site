
jQuery(function($){
  var pre=$("pre[class*=code-]")
  if(pre){
    var trigger="code-"
    
    pre.each(function(id,pre){
      var lang="javascript"
      var classList=pre.classList
      
      for(var i in classList){
        if(/code-/.test(classList[i])){
          lang=classList[i].substring(trigger.length)
          switch(lang){
            case "js":
              lang="javascript"
              break
          }
          break
        }
      }
        
      var pre=$(pre)
      
      var html=pre.html()
      var langClass="language-"+lang
      pre.addClass('line-numbers')
      
      var code=pre.find(">code")
      if(code.length)
        code.addClass(langClass)
      else
        pre.wrapInner('<code class="'+langClass+'"></code>')
    })
    
  }
})
