$=jQuery;

/**
 * Ajax Post object class
 *
 * @param data
 * @param options
 * @param success_callback
 * @param error_callback
 * @constructor
 */
function AjaxPost(data, options, success_callback, error_callback){
  this.spinner = false;

  // Add options so we can scale it easily
  // Create some defaults, extending them with any options that were provided
  var settings = $.extend({
    'spinner': false
  }, options);

  this.init = function(){
    if(settings.spinner) this.spinner = settings.spinner;
    return this;
  };

  this.doAjaxPost = function(){
    var current_object = this;
    if(current_object.spinner){
      current_object.spinner.spinIt();
    }
    $.post(ajaxurl, data, function(response) {
      if(settings.spinner){
        current_object.spinner.hideSpinner(function(){
          if(typeof(success_callback)=="function") success_callback(response);
        });
      }
      else if(typeof(success_callback)=="function") success_callback(response);
    })
    .error(function() {
      var callError = function(){
        bootstrap_alert("Connection error", 'error');
        if(typeof(error_callback)=="function") error_callback();
      }
      if(settings.spinner)
        current_object.spinner.hideSpinner(function(){callError();});
      else callError();
    });
  }

  this.init();
}

$(document).ready(function(){
  $('.watch-more[href=""]').click(function(e){
    e.preventDefault();
    var button = $(this);
    if(!button.hasClass('disabled')){
      var page = button.data('page');
      if(!page){
        page = 2;
      }
      button.addClass('disabled');
      var data = {
        action: 'load_more_videos',
        'page'  : page
      };
      var pivot = $('#video-pivot');
      var post = new AjaxPost(data, {},
      // Ajax replied
      function(response){
        try {
          var json_response = JSON.parse(response);
          if (json_response.status==1){
            if(json_response.done){
              button.fadeOut('slow', function(){
                button.remove();
              });
            }
            else {
              button.data('page', page+1);
              button.removeClass('disabled');
            }
            if(json_response.html!=''){
              $(json_response.html).insertBefore(pivot);
            }
          }
          else {
            $('<div class="alert alert-error">Failed to load more videos.</div>').insertAfter(pivot);
            button.removeClass('disabled');
          }
        } catch (e) {
          $('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button> Failed to load more videos.</div>').insertAfter(pivot);
          button.removeClass('disabled');
        }
        if($('.alert-error')){
          setTimeout(function(){$('.alert').fadeOut('fast', function(){$(this).remove();});}, 2000);
        }
      },
      // Ajax post error (means connection error)
      function(){
        button.removeClass('disabled');
      });
      post.doAjaxPost();
    }
  });
});

$(document).ready(function(){
  $('.read-more[href=""]').click(function(e){
    e.preventDefault();
    var button = $(this);
    if(!button.hasClass('disabled')){
      var page = button.data('page');
      if(!page){
        page = 2;
      }
      button.addClass('disabled');
      var data = {
        action: 'load_more_news',
        'page'  : page
      };
      var pivot = $('#news-pivot');
      var post = new AjaxPost(data, {},
      // Ajax replied
      function(response){
        try {
          var json_response = JSON.parse(response);
          if (json_response.status==1){
            if(json_response.done){
              button.fadeOut('slow', function(){
                button.remove();
              });
            }
            else {
              button.data('page', page+1);
              button.removeClass('disabled');
            }
            if(json_response.html!=''){
              $(json_response.html).insertBefore(pivot);
            }
          }
          else {
            $('<div class="alert alert-error">Failed to load more news.</div>').insertAfter(pivot);
            button.removeClass('disabled');
          }
        } catch (e) {
          $('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button> Failed to load more videos.</div>').insertAfter(pivot);
          button.removeClass('disabled');
        }
        if($('.alert-error')){
          setTimeout(function(){$('.alert').fadeOut('fast', function(){$(this).remove();});}, 2000);
        }
      },
      // Ajax post error (means connection error)
      function(){
        button.removeClass('disabled');
      });
      post.doAjaxPost();
    }
  });

  /**
   * Colorbox element for expanding photo/video
   */
  var colorbox_elm = $('.colorbox-element');
  if(colorbox_elm.length>0){
    colorbox_elm.unbind('click');
    colorbox_elm.colorbox({
      iframe: function(){return ($(this).attr('data-video')=='1');},
      innerWidth  : function(){return ($(this).attr('data-video')=='1')?640:0;},
      innerHeight : function(){return ($(this).attr('data-video')=='1')?480:0;}
    });
  }

  if(!is_touch_device()){
    $("a[href*='tel:']").attr('href', 'javascript:void(0);');
    $(document).on('click', 'a.show-phone', function(e){
      e.preventDefault();
      var btn = $(this);
      if(!btn.hasClass('disabled')){
        var icon = $('span', btn);
        btn.html(' <span class="fade-out-text" style="position:relative;left:0;opacity:1;">'+btn.text()+'</span>');
        btn.prepend(icon);
        $('.fade-out-text', btn).animate({'left':10,'opacity':0}, 'fast', function(){
          $(this).remove();
          btn.html(' <span class="fade-in-number" style="position:relative;left:40px;opacity:0;">'+btn.attr('data-phone')+'</span>');
          btn.prepend(icon);
          $('.fade-in-number', btn).animate({'left':0,'opacity':1}, 'slow', function(){
            btn.removeClass('disabled show-phone');
          });
        });
      }
    });
  }
});

function share_project(social_media, project_url, message){
  var width, height, left, top, url = '';
  switch(social_media){
    case 'googleplus':
      width  = 620;
      height = 620;
      url = "https://plus.google.com/share?url="+encodeURIComponent(project_url);
      break;
    case 'twitter':
      width  = 600;
      height = 258;
      url = "http://twitter.com/intent/tweet?url="+encodeURIComponent(project_url)+"&text="+encodeURIComponent(message)+"&count=none/";
      break;
    case 'facebook':
      width = 600;
      height = 325;
      url = "http://www.facebook.com/sharer.php?u="+encodeURIComponent(project_url)+"&t="+encodeURIComponent(message);
      break;
  }
  left   = ($(window).width()  - width)  / 2;
  top    = ($(window).height() - height) / 2;
  var opts   = 'status=1' +
           ',width='  + width +
           ',height=' + height +
           ',top='    + top +
           ',left='   + left +
           ',resizable=1';
  window.open(url, social_media, opts);
}

function is_touch_device() {
  var bool = false;
  if(('ontouchstart' in window) || (window.DocumentTouch && (document instanceof DocumentTouch)) || navigator.msMaxTouchPoints>0){
    bool = true;
  }
  return bool;
}