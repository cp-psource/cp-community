jQuery(document).ajaxComplete(function() {
    
    if (jQuery('.cpc_show_after_page_load').length) {
        jQuery('.cpc_show_after_page_load').show();
    }
    
}); 


jQuery(document).ready(function() {

	// Click to hide
	jQuery('body').on('click','#cpc_activity_dialog', function(e) { 

        jQuery('#cpc_activity_dialog').fadeOut(200); 
        setTimeout(function() {
            jQuery("body").removeClass("cpc_wait_loading");
        }, 10);
        
	});

	// Escape or Enter to hide
	jQuery(document).on('keyup', function(e) {
	  	if (e.keyCode == 13 || e.keyCode == 27) { 
            if (jQuery('#cpc_activity_dialog').length) {
                jQuery('#cpc_activity_dialog').fadeOut(200); 
                setTimeout(function() {
                    jQuery("body").removeClass("cpc_wait_loading");
                }, 10);
            }
	   	};
	});
    
    // Show content after page has loaded as looks better
    if (jQuery('.cpc_show_after_page_load').length) {
        jQuery('.cpc_show_after_page_load').show();
    }

});


function cpc_show_image(image_obj) {

    if (image_obj.data('width') > 0) {
        
        jQuery("body").addClass("cpc_wait_loading");

        if (!jQuery('#cpc_activity_dialog').length) {
            jQuery('<div id="cpc_activity_dialog"></div>').appendTo("body");
        }

        var image_url = cpc_strip_tags(image_obj.html());
        var image_width = image_obj.data('width');
        var image_height = image_obj.data('height');
        var image_source = image_obj.data('source');
        var image_desc = image_obj.data('desc');
        var image_ratio = image_width/image_height;
        
        var source = '';
        if (typeof image_source != 'undefined' && image_source != '') {
            image_source = cpc_htmlencode(image_source);
            image_source = image_source.replace(/[\r\n]/g, "<br />");
            source = '<div id="cpc_activity_dialog_source">'+image_source+'</div>';
        }
        var desc = '';
        if (typeof image_desc != 'undefined' && image_desc != '') {
            image_desc = cpc_htmlencode(image_desc);
            image_desc = image_desc.replace(/[\r\n]/g, "<br />");
            desc = '<div id="cpc_activity_dialog_desc">'+image_desc+'</div>';
        }
        
        jQuery('#cpc_activity_dialog').hide().html(desc+source+'<img src="'+image_url+'" />');
        
        var screen_width = jQuery(window).width();
        var screen_height = jQuery(window).height();

        var max_size = 0.9;
        

        if (image_width > (screen_width*max_size)) { image_width = (screen_width*max_size); }
        if (image_height > (screen_height*max_size)) { image_height = (screen_height*max_size); }
        image_width = image_height * image_ratio;

        // check widths (particuarly on mobile devices)
        if (image_width > screen_width) {
            var reduce_by = (screen_width*max_size)/image_width;
            image_width = image_width * reduce_by;
            image_height = image_height * reduce_by;
        }

        var dialog = jQuery('#cpc_activity_dialog');
        var dialog_img = jQuery('#cpc_activity_dialog img');
        dialog.css("position","fixed").css("cursor","pointer").css("z-index","100000");
        dialog_img.css("width", image_width+"px");
        dialog_img.css("height", image_height+"px");
        dialog.css("left",  "50%").css("margin-left", "-"+(image_width / 2)+"px");
        dialog.css("top", "50%").css("margin-top", "-"+(image_height / 2)+"px");
        dialog.fadeIn('fast');
        jQuery(dialog).appendTo("body");

    }
    
}

jQuery.fn.cpcbootstrapFileInput = function() {

  this.each(function(i,elem){

    var jQueryelem = jQuery(elem);

    // Maybe some fields don't need to be standardized.
    if (typeof jQueryelem.attr('data-bfi-disabled') != 'undefined') {
      return;
    }

    // Set the word to be displayed on the button
    var buttonWord = 'Browse';

    if (typeof jQueryelem.attr('title') != 'undefined') {
      buttonWord = jQueryelem.attr('title');
    }

    var className = '';

    if (!!jQueryelem.attr('class')) {
      className = ' ' + jQueryelem.attr('class');
    }

    // Now we're going to wrap that input field with a Bootstrap button.
    // The input will actually still be there, it will just be float above and transparent (done with the CSS).
    jQueryelem.wrap('<a class="file-input-wrapper ' + className + '"></a>').parent().prepend(buttonWord);
      
    // Disable to avoid repetition
    jQueryelem.attr('data-bfi-disabled', 'true');
  })

  // After we have found all of the file inputs let's apply a listener for tracking the mouse movement.
  // This is important because the in order to give the illusion that this is a button in FF we actually need to move the button from the file input under the cursor. Ugh.
  .promise().done( function(){

    // As the cursor moves over our new Bootstrap button we need to adjust the position of the invisible file input Browse button to be under the cursor.
    // This gives us the pointer cursor that FF denies us

    jQuery('.file-input-wrapper').mousemove(function(cursor) {

      var input, wrapper,
        wrapperX, wrapperY,
        inputWidth, inputHeight,
        cursorX, cursorY;

      // This wrapper element (the button surround this file input)
      wrapper = jQuery(this);
      // The invisible file input element
      input = wrapper.find("input");
      // The left-most position of the wrapper
      wrapperX = wrapper.offset().left;
      // The top-most position of the wrapper
      wrapperY = wrapper.offset().top;
      // The with of the browsers input field
      inputWidth= input.width();
      // The height of the browsers input field
      inputHeight= input.height();
      //The position of the cursor in the wrapper
      cursorX = cursor.pageX;
      cursorY = cursor.pageY;

      //T he positions we are to move the invisible file input
      // The 20 at the end is an arbitrary number of pixels that we can shift the input such that cursor is not pointing at the end of the Browse button but somewhere nearer the middle
      moveInputX = cursorX - wrapperX - inputWidth + 20;
      // Slides the invisible input Browse button to be positioned middle under the cursor
      moveInputY = cursorY- wrapperY - (inputHeight/2);

      // Apply the positioning styles to actually move the invisible file input
      input.css({
        left:0,
        top:0
      });
      /*
      // Removed this and forced position above, to avoid taking over screen area
      input.css({
        left:moveInputX,
        top:moveInputY
      });
      */
    });

    jQuery('body').on('change', '.file-input-wrapper input[type=file]', function(){

      var fileName;
      fileName = jQuery(this).val();

      // Remove any previous file names
      jQuery(this).parent().next('.file-input-name').remove();
      if (!!jQuery(this).prop('files') && jQuery(this).prop('files').length > 1) {
        fileName = jQuery(this)[0].files.length+' files';
        //jQuery(this).parent().after('<span class="file-input-name">'+jQuery(this)[0].files.length+' files</span>');
      }
      else {
        // var fakepath = 'C:\\fakepath\\';
        // fileName = jQuery(this).val().replace('C:\\fakepath\\','');
        fileName = fileName.substring(fileName.lastIndexOf('\\')+1,fileName.length);
      }

      jQuery(this).parent().after('<span class="file-input-name">'+fileName+'</span>');
    });

  });

};

// Add the styles before the first stylesheet
// This ensures they can be easily overridden with developer styles
var cssHtml = '<style>'+
  '.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }'+
  '.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }'+
  '.file-input-name { margin-left: 8px; }'+
  '</style>';
jQuery('link[rel=stylesheet]').eq(0).before(cssHtml);

// strip_tags
// allow can be a string like '<b><i>'
function cpc_strip_tags(str, allow) {
  // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
  allow = (((allow || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
  var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
  });
}

// Javascript HTML encode
function cpc_htmlencode(str) {
    return str.replace(/[&<>"']/g, function($0) {
        return "&" + {"&":"amp", "<":"lt", ">":"gt", '"':"quot", "'":"#39"}[$0] + ";";
    });
}

function cpc_removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
        return url;
    } else {
        return url;
    }
}