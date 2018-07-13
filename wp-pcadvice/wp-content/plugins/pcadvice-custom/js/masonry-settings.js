jQuery(function($){
  
  var containerSelector='.android-items-container'
  var itemSelector='.app-item'
  var masonryList=[]
  
  setMasonry(containerSelector,itemSelector)

  enquire.register("screen and (max-width:260px)", {
    match : function() {
      masonryList.forEach(function(item){
        item.destroy()
      })
    },      
    unmatch : function() {
      setMasonry(containerSelector,itemSelector)
    }   
  }); 
  
  
  function setMasonry(containerSelector,itemSelector){
    masonryList=[]
    var container = document.querySelectorAll(containerSelector);
    
    Array.forEach(container,function(item){
      masonryList.push(
        new Masonry(item, {
          itemSelector:itemSelector,
        })
      )
    })
    
  }

})