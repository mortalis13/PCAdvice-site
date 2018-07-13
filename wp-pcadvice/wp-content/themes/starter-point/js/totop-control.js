
/*
 * The script controls the 'toTop' button vertical position if there is a possibiblity of intersection with the footer
 * on smaller screens or when window size changes
 */
 
jQuery(function($){
  var toTop,footer,intersect,bottom,origBottom,
  restore,bottomChanged=false
  
  toTop=$('#toTop')
  footer=$('.footer-content')
  
  /*
   * Determines if the toTop button can intersect with the footer when scrolled down
   */
  function isHIntersect(){
    var windowWidth,footerWidth,sideDistance,toTopWidth,diff,right
    
    windowWidth=$(window).width()
    footerWidth=footer.outerWidth()
    sideDistance=(windowWidth-footerWidth)/2
    right=parseInt(toTop.css('right'),10)
    
    toTopWidth=toTop.width()+right
    diff=sideDistance-toTopWidth
    
    if(diff<0) return true
    return false
  }
  
  origBottom=parseInt(toTop.css('bottom'),10)

  // Checks if the toTop and footer intersection occurs
  // Adds the scrolling difference to the 'bottom' value of toTop button lest it overlaps the footer
  
  $(window).scroll(function(){
    intersect=isHIntersect()
    restore=false
    
    if(intersect){                                              // if there is apossibility of intersection (overlapping)
      // console.log('intersect')
      var toTopOffset,footerOffset,footerHeight,diff
      
      bottom=parseInt(toTop.css('bottom'),10)
      toTopOffset=toTop.offset().top+toTop.height()+bottom
      footerOffset=footer.offset().top
      diff=toTopOffset-footerOffset
      
      if(diff>0){
        // console.log('Intersection: '+diff)
        toTop.css('bottom',origBottom+diff)
        bottomChanged=true
      }
      else restore=true
    }else restore=true
    
    if(restore && bottomChanged){
      if(intersect){                                              // no animation if button restores its 'bottom' after scrolling up and if no overlapping
        console.log('restore')
        toTop.css('bottom',origBottom)
        bottomChanged=false
      }else{
        console.log('restore-animate')                            // animates when the button goes down if the window is resized and scrolled
        toTop.animate({'bottom':origBottom},500)
        bottomChanged=false
      }
    }
    
  })
  
})
