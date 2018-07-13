
jQuery(function($){
  // lazy image load
  
  var minImageSize=300
  $('img.lazy').each(function(i){
    var width=$(this).width()
    var height=$(this).height()
    
    if(width>=minImageSize && height>=minImageSize){
      $(this).lazyload({
        effect : "fadeIn"
      })
    }else{
      $(this).attr('src',$(this).attr('data-original'))
      $(this).removeClass("lazy")
    }
  })

  // remove last comment border-bottom
  // it's the last comment body of the last comment (including all children - sub-comments)

  var li=$(".comments-area .comment-list > li:last-child")
  var comNav=$(".comment-navigation")
  if(li.length && comNav.length){
    var lastLi
    while(li.length){
      lastLi=li
      li=$("> .children > li:last-child",li)
    }
    lastLi.find(">.comment-body").css({
      "border-bottom":"none"
    })
  }

  // gallery caption media query

  var useGalleryMediaQuery=false
  var useGalleryCaption=true

  enquire.register("screen and (max-width:1040px)", {
    match : function() {
      useGalleryMediaQuery=true         // on medium screens set caption position to the center of an image
    },      
    unmatch : function() {
      useGalleryMediaQuery=false        // on wider screens calculate the caption left coordinate to show it to the right of an image
    }   
  }); 

  enquire.register("screen and (max-width:620px)", {
    match : function() {
      useGalleryCaption=false       // disable caption on small screen (not to overflow the page)
    },      
    unmatch : function() {
      useGalleryCaption=true
    }   
  }); 

  // image gallery hover
  
  var gallery=$('.gallery')
  if(gallery.length && useGalleryCaption){
    var item=$('.gallery-item')
    var image=$('.gallery-item img')

    image.hoverIntent({                                           // hoverIntent prevents caption showing on mouse hover without delay above an image
      over: function() {
        var parentItem=$(this).parents('.gallery-item')
        var caption=parentItem.find('.gallery-caption')

        var left=parentItem.width()/2+$(this).width()*0.7         // move the caption slightly to the right of an image
        if(useGalleryMediaQuery) left='50%'

        caption.css({'left':left})
        caption.fadeIn(300)
      },
      out: function() {
        var parentItem=$(this).parents('.gallery-item')
        var caption=parentItem.find('.gallery-caption')
        caption.fadeOut(300)
      },
      sensitivity:4,
      timeout:100,
      interval:50
    })
  }

  // post navigation vertical division (adjust divider border and paddings)

  var postNav=$('.post-navigation')
  if(postNav.length){
    var navPrev=$('.nav-previous',postNav)
    var navNext=$('.nav-next',postNav)

    if(!navPrev.length){
      navNext.css({
        'border-top':'none',
        'padding-top':0
      })
    }

    if(!navNext.length){
      navPrev.css({
        'padding-bottom':0
      })
    }
  }

  // comments navigation vertical division

  var commNav=$('.comment-navigation')
  if(commNav.length){
    var navPrev=$('.nav-previous:not(:empty)',commNav)
    var navNext=$('.nav-next:not(:empty)',commNav)

    if(!navPrev.length){
      navNext.css({
        'border-top':'none',
        'padding-top':0
      })

      var navPrev=$('.nav-previous',commNav)
      navPrev.css({
        'padding-bottom':0
      })
    }

    if(!navNext.length){
      navPrev.css({
        'padding-bottom':0
      })

      var navNext=$('.nav-next',commNav)
      navNext.css({
        'border-top':'none',
        'padding-top':0
      })
    }
  }

  // post-navigation margin-bottom if there are comments (?)

  var postNav=$('.single-post .post-navigation')
  if(postNav.length){
    commArea=$('.comments-area')
    if(commArea.length){
      // postNav.css({
      //   'margin-bottom':0
      // })
    }
  }
  
  // scroll to top button
  
  var settings = {
    text: 'To Top',
    containerID: 'toTop',
    // containerHoverID: 'toTopHover',
    min: 200,
    inDelay: 600,
    outDelay: 400,
    scrollSpeed: 700,
    easingType: 'swing'
  };
  
  var toTopHidden = true;
  var toTop = $('#' + settings.containerID);
  
  toTop.click(function(e) {
    e.preventDefault();
    $.scrollTo(0, settings.scrollSpeed, {easing: settings.easingType});
    this.blur();
  });
  
  $(window).scroll(function() {
    var sd = $(this).scrollTop();
    if (sd > settings.min && toTopHidden) {
      toTop.addClass('show');
      // toTop.fadeIn(settings.inDelay);
      // toTop.show();
      toTopHidden = false;
    }
    else if(sd <= settings.min && ! toTopHidden) {
      toTop.removeClass('show');
      // toTop.fadeOut(settings.outDelay);
      // toTop.hide();
      toTopHidden = true;
    }
  });

});
