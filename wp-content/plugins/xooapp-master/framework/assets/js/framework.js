/**
 *
 * -----------------------------------------------------------
 *
 * Codestar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Copyright 2015 Codestar <info@xstheme.com>
 *
 * -----------------------------------------------------------
 *
 */
;(function ( $, window, document, undefined ) {
  'use strict';

  $.XOOAPPFramework = $.XOOAPPFramework || {};

  // caching selector
  var $XOOAPP_body = $('body');

  // caching variables
  var XOOAPP_is_rtl  = $XOOAPP_body.hasClass('rtl');

  // ======================================================
  // XOOAPPFramework TAB NAVIGATION
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_TAB_NAVIGATION = function() {
    return this.each(function() {

      var $this   = $(this),
          $nav    = $this.find('.xooapp-nav'),
          $reset  = $this.find('.xooapp-reset'),
          $expand = $this.find('.xooapp-expand-all');

      $nav.find('ul:first a').on('click', function (e) {

        e.preventDefault();

        var $el     = $(this),
            $next   = $el.next(),
            $target = $el.data('section');

        if( $next.is('ul') ) {

          $next.slideToggle( 'fast' );
          $el.closest('li').toggleClass('xooapp-tab-active');

        } else {

          $('#xooapp-tab-'+$target).show().siblings().hide();
          $nav.find('a').removeClass('xooapp-section-active');
          $el.addClass('xooapp-section-active');
          $reset.val($target);

        }

      });

      $expand.on('click', function (e) {
        e.preventDefault();
        $this.find('.xooapp-body').toggleClass('xooapp-show-all');
        $(this).find('.fa').toggleClass('fa-eye-slash' ).toggleClass('fa-eye');
      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework DEPENDENCY
  // ------------------------------------------------------
  $.XOOAPPFramework.DEPENDENCY = function( el, param ) {

    // Access to jQuery and DOM versions of element
    var base     = this;
        base.$el = $(el);
        base.el  = el;

    base.init = function () {

      base.ruleset = $.deps.createRuleset();

      // required for shortcode attrs
      var cfg = {
        show: function( el ) {
          el.removeClass('hidden');
        },
        hide: function( el ) {
          el.addClass('hidden');
        },
        log: false,
        checkTargets: false
      };

      if( param !== undefined ) {
        base.depSub();
      } else {
        base.depRoot();
      }

      $.deps.enable( base.$el, base.ruleset, cfg );

    };

    base.depRoot = function() {

      base.$el.each( function() {

        $(this).find('[data-controller]').each( function() {

          var $this       = $(this),
              _controller = $this.data('controller').split('|'),
              _condition  = $this.data('condition').split('|'),
              _value      = $this.data('value').toString().split('|'),
              _rules      = base.ruleset;

          $.each(_controller, function(index, element) {

            var value     = _value[index] || '',
                condition = _condition[index] || _condition[0];

            _rules = _rules.createRule('[data-depend-id="'+ element +'"]', condition, value);
            _rules.include($this);

          });

        });

      });

    };

    base.depSub = function() {

      base.$el.each( function() {

        $(this).find('[data-sub-controller]').each( function() {

          var $this       = $(this),
              _controller = $this.data('sub-controller').split('|'),
              _condition  = $this.data('sub-condition').split('|'),
              _value      = $this.data('sub-value').toString().split('|'),
              _rules      = base.ruleset;

          $.each(_controller, function(index, element) {

            var value     = _value[index] || '',
                condition = _condition[index] || _condition[0];

            _rules = _rules.createRule('[data-sub-depend-id="'+ element +'"]', condition, value);
            _rules.include($this);

          });

        });

      });

    };


    base.init();
  };

  $.fn.XOOAPPFramework_DEPENDENCY = function ( param ) {
    return this.each(function () {
      new $.XOOAPPFramework.DEPENDENCY( this, param );
    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework CHOSEN
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_CHOSEN = function() {
    return this.each(function() {
      $(this).chosen({allow_single_deselect: true, disable_search_threshold: 15, width: parseFloat( $(this).actual('width') + 25 ) +'px'});
    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework IMAGE SELECTOR
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_IMAGE_SELECTOR = function() {
    return this.each(function() {

      $(this).find('label').on('click', function () {
        $(this).siblings().find('input').prop('checked', false);
      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework SORTER
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_SORTER = function() {
    return this.each(function() {

      var $this     = $(this),
          $enabled  = $this.find('.xooapp-enabled'),
          $disabled = $this.find('.xooapp-disabled');

      $enabled.sortable({
        connectWith: $disabled,
        placeholder: 'ui-sortable-placeholder',
        update: function( event, ui ){

          var $el = ui.item.find('input');

          if( ui.item.parent().hasClass('xooapp-enabled') ) {
            $el.attr('name', $el.attr('name').replace('disabled', 'enabled'));
          } else {
            $el.attr('name', $el.attr('name').replace('enabled', 'disabled'));
          }

        }
      });

      // avoid conflict
      $disabled.sortable({
        connectWith: $enabled,
        placeholder: 'ui-sortable-placeholder'
      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework MEDIA UPLOADER / UPLOAD
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_UPLOADER = function() {
    return this.each(function() {

      var $this  = $(this),
          $add   = $this.find('.xooapp-add'),
          $input = $this.find('input'),
          wp_media_frame;

      $add.on('click', function( e ) {

        e.preventDefault();

        // Check if the `wp.media.gallery` API exists.
        if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) {
          return;
        }

        // If the media frame already exists, reopen it.
        if ( wp_media_frame ) {
          wp_media_frame.open();
          return;
        }

        // Create the media frame.
        wp_media_frame = wp.media({

          // Set the title of the modal.
          title: $add.data('frame-title'),

          // Tell the modal to show only images.
          library: {
            type: $add.data('upload-type')
          },

          // Customize the submit button.
          button: {
            // Set the text of the button.
            text: $add.data('insert-title'),
          }

        });

        // When an image is selected, run a callback.
        wp_media_frame.on( 'select', function() {

          // Grab the selected attachment.
          var attachment = wp_media_frame.state().get('selection').first();
          $input.val( attachment.attributes.url ).trigger('change');

        });

        // Finally, open the modal.
        wp_media_frame.open();

      });

    });

  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework IMAGE UPLOADER
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_IMAGE_UPLOADER = function() {
    return this.each(function() {

      var $this    = $(this),
          $add     = $this.find('.xooapp-add'),
          $preview = $this.find('.xooapp-image-preview'),
          $remove  = $this.find('.xooapp-remove'),
          $input   = $this.find('input'),
          $img     = $this.find('img'),
          wp_media_frame;

      $add.on('click', function( e ) {

        e.preventDefault();

        // Check if the `wp.media.gallery` API exists.
        if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) {
          return;
        }

        // If the media frame already exists, reopen it.
        if ( wp_media_frame ) {
          wp_media_frame.open();
          return;
        }

        // Create the media frame.
        wp_media_frame = wp.media({
          library: {
            type: 'image'
          }
        });

        // When an image is selected, run a callback.
        wp_media_frame.on( 'select', function() {

          var attachment = wp_media_frame.state().get('selection').first().attributes;
          var thumbnail = ( typeof attachment.sizes !== 'undefined' && typeof attachment.sizes.thumbnail !== 'undefined' ) ? attachment.sizes.thumbnail.url : attachment.url;

          $preview.removeClass('hidden');
          $img.attr('src', thumbnail);
          $input.val( attachment.id ).trigger('change');

        });

        // Finally, open the modal.
        wp_media_frame.open();

      });

      // Remove image
      $remove.on('click', function( e ) {
        e.preventDefault();
        $input.val('').trigger('change');
        $preview.addClass('hidden');
      });

    });

  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework IMAGE GALLERY
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_IMAGE_GALLERY = function() {
    return this.each(function() {

      var $this   = $(this),
          $edit   = $this.find('.xooapp-edit'),
          $remove = $this.find('.xooapp-remove'),
          $list   = $this.find('ul'),
          $input  = $this.find('input'),
          $img    = $this.find('img'),
          wp_media_frame;

      $this.on('click', '.xooapp-add, .xooapp-edit', function( e ) {

        var $el   = $(this),
            ids   = $input.val(),
            what  = ( $el.hasClass('xooapp-edit') ) ? 'edit' : 'add',
            state = ( what === 'add' && !ids.length ) ? 'gallery' : 'gallery-edit';

        e.preventDefault();

        // Check if the `wp.media.gallery` API exists.
        if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) { return; }

         // Open media with state
        if( state === 'gallery' ) {

          wp_media_frame = wp.media({
            library: {
              type: 'image'
            },
            frame: 'post',
            state: 'gallery',
            multiple: true
          });

          wp_media_frame.open();

        } else {

          wp_media_frame = wp.media.gallery.edit( '[gallery ids="'+ ids +'"]' );

          if( what === 'add' ) {
            wp_media_frame.setState('gallery-library');
          }

        }

        // Media Update
        wp_media_frame.on( 'update', function( selection ) {

          $list.empty();

          var selectedIds = selection.models.map( function ( attachment ) {

            var item  = attachment.toJSON();
            var thumb = ( typeof item.sizes.thumbnail !== 'undefined' ) ? item.sizes.thumbnail.url : item.url;

            $list.append('<li><img src="'+ thumb +'"></li>');

            return item.id;

          });

          $input.val( selectedIds.join( ',' ) ).trigger('change');
          $remove.removeClass('hidden');
          $edit.removeClass('hidden');

        });

      });

      // Remove image
      $remove.on('click', function( e ) {
        e.preventDefault();
        $list.empty();
        $input.val('').trigger('change');
        $remove.addClass('hidden');
        $edit.addClass('hidden');
      });

    });

  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework TYPOGRAPHY
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_TYPOGRAPHY = function() {
    return this.each( function() {

      var typography      = $(this),
          family_select   = typography.find('.xooapp-typo-family'),
          variants_select = typography.find('.xooapp-typo-variant'),
          typography_type = typography.find('.xooapp-typo-font');

      family_select.on('change', function() {

        var _this     = $(this),
            _type     = _this.find(':selected').data('type') || 'custom',
            _variants = _this.find(':selected').data('variants');

        if( variants_select.length ) {

          variants_select.find('option').remove();

          $.each( _variants.split('|'), function( key, text ) {
            variants_select.append('<option value="'+ text +'">'+ text +'</option>');
          });

          variants_select.find('option[value="regular"]').attr('selected', 'selected').trigger('chosen:updated');

        }

        typography_type.val(_type);

      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework GROUP
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_GROUP = function() {
    return this.each(function() {

      var _this           = $(this),
          field_groups    = _this.find('.xooapp-groups'),
          accordion_group = _this.find('.xooapp-accordion'),
          clone_group     = _this.find('.xooapp-group:first').clone();

      if ( accordion_group.length ) {
        accordion_group.accordion({
          header: '.xooapp-group-title',
          collapsible : true,
          active: false,
          animate: 250,
          heightStyle: 'content',
          icons: {
            'header': 'dashicons dashicons-arrow-right',
            'activeHeader': 'dashicons dashicons-arrow-down'
          },
          beforeActivate: function( event, ui ) {
            $(ui.newPanel).XOOAPPFramework_DEPENDENCY( 'sub' );
          }
        });
      }

      field_groups.sortable({
        axis: 'y',
        handle: '.xooapp-group-title',
        helper: 'original',
        cursor: 'move',
        placeholder: 'widget-placeholder',
        start: function( event, ui ) {
          var inside = ui.item.children('.xooapp-group-content');
          if ( inside.css('display') === 'block' ) {
            inside.hide();
            field_groups.sortable('refreshPositions');
          }
        },
        stop: function( event, ui ) {
          ui.item.children( '.xooapp-group-title' ).triggerHandler( 'focusout' );
          accordion_group.accordion({ active:false });
        }
      });

      var i = 0;
      $('.xooapp-add-group', _this).on('click', function( e ) {

        e.preventDefault();

        clone_group.find('input, select, textarea').each( function () {
          this.name = this.name.replace(/\[(\d+)\]/,function(string, id) {
            return '[' + (parseInt(id,10)+1) + ']';
          });
        });

        var cloned = clone_group.clone().removeClass('hidden');
        field_groups.append(cloned);

        if ( accordion_group.length ) {
          field_groups.accordion('refresh');
          field_groups.accordion({ active: cloned.index() });
        }

        field_groups.find('input, select, textarea').each( function () {
          this.name = this.name.replace('[_nonce]', '');
        });

        // run all field plugins
        cloned.XOOAPPFramework_DEPENDENCY( 'sub' );
        cloned.XOOAPPFramework_RELOAD_PLUGINS();

        i++;

      });

      field_groups.on('click', '.xooapp-remove-group', function(e) {
        e.preventDefault();
        $(this).closest('.xooapp-group').remove();
      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework RESET CONFIRM
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_CONFIRM = function() {
    return this.each( function() {
      $(this).on('click', function( e ) {
        if ( !confirm('Are you sure?') ) {
          e.preventDefault();
        }
      });
    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework SAVE OPTIONS
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_SAVE = function() {
    return this.each( function() {

      var $this  = $(this),
          $text  = $this.data('save'),
          $value = $this.val(),
          $ajax  = $('#xooapp-save-ajax');

      $(document).on('keydown', function(event) {
        if (event.ctrlKey || event.metaKey) {
          if( String.fromCharCode(event.which).toLowerCase() === 's' ) {
            event.preventDefault();
            $this.trigger('click');
          }
        }
      });

      $this.on('click', function ( e ) {

        if( $ajax.length ) {

          if( typeof tinyMCE === 'object' ) {
            tinyMCE.triggerSave();
          }

          $this.prop('disabled', true).attr('value', $text);

          var serializedOptions = $('#XOOAPPFramework_form').serialize();

          $.post( 'options.php', serializedOptions ).error( function() {
            alert('Error, Please try again.');
          }).success( function() {
            $this.prop('disabled', false).attr('value', $value);
            $ajax.hide().fadeIn().delay(250).fadeOut();
          });

          e.preventDefault();

        } else {

          $this.addClass('disabled').attr('value', $text);

        }

      });

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework SAVE TAXONOMY CLEAR FORM ELEMENTS
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_TAXONOMY = function() {
    return this.each( function() {

      var $this   = $(this),
          $parent = $this.parent();

      // Only works in add-tag form
      if( $parent.attr('id') === 'addtag' ) {

        var $submit  = $parent.find('#submit'),
            $name    = $parent.find('#tag-name'),
            $wrap    = $parent.find('.xooapp-framework'),
            $clone   = $wrap.find('.xooapp-element').clone(),
            $list    = $('#the-list'),
            flooding = false;

        $submit.on( 'click', function() {

          if( !flooding ) {

            $list.on( 'DOMNodeInserted', function() {

              if( flooding ) {

                $wrap.empty();
                $wrap.html( $clone );
                $clone = $clone.clone();

                $wrap.XOOAPPFramework_RELOAD_PLUGINS();
                $wrap.XOOAPPFramework_DEPENDENCY();

                flooding = false;

              }

            });

          }

          flooding = true;

        });

      }

    });
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework UI DIALOG OVERLAY HELPER
  // ------------------------------------------------------
  if( typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.dialog !== 'undefined' ) {
    $.widget( 'ui.dialog', $.ui.dialog, {
        _createOverlay: function() {
          this._super();
          if ( !this.options.modal ) { return; }
          this._on(this.overlay, {click: 'close'});
        }
      }
    );
  }

  // ======================================================
  // XOOAPPFramework ICONS MANAGER
  // ------------------------------------------------------
  $.XOOAPPFramework.ICONS_MANAGER = function() {

    var base   = this,
        onload = true,
        $parent;

    base.init = function () {

      $XOOAPP_body.on('click', '.xooapp-icon-add', function( e ) {

        e.preventDefault();

        var $this   = $(this),
            $dialog = $('#xooapp-icon-dialog'),
            $load   = $dialog.find('.xooapp-dialog-load'),
            $select = $dialog.find('.xooapp-dialog-select'),
            $insert = $dialog.find('.xooapp-dialog-insert'),
            $search = $dialog.find('.xooapp-icon-search');

        // set parent
        $parent = $this.closest('.xooapp-icon-select');

        // open dialog
        $dialog.dialog({
          width: 850,
          height: 700,
          modal: true,
          resizable: false,
          closeOnEscape: true,
          position: {my: 'center', at: 'center', of: window},
          open: function() {

            // fix scrolling
            $XOOAPP_body.addClass('xooapp-icon-scrolling');

            // fix button for VC
            $('.ui-dialog-titlebar-close').addClass('ui-button');

            // set viewpoint
            $(window).on('resize', function () {

              var height      = $(window).height(),
                  load_height = Math.floor( height - 237 ),
                  set_height  = Math.floor( height - 125 );

              $dialog.dialog('option', 'height', set_height).parent().css('max-height', set_height);
              $dialog.css('overflow', 'auto');
              $load.css( 'height', load_height );

            }).resize();

          },
          close: function() {
            $XOOAPP_body.removeClass('xooapp-icon-scrolling');
          }
        });

        // load icons
        if( onload ) {

          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              action: 'xooapp-get-icons'
            },
            success: function( content ) {

              $load.html( content );
              onload = false;

              $load.on('click', 'a', function( e ) {

                e.preventDefault();

                var icon = $(this).data('xooapp-icon');

                $parent.find('i').removeAttr('class').addClass(icon);
                $parent.find('input').val(icon).trigger('change');
                $parent.find('.xooapp-icon-preview').removeClass('hidden');
                $parent.find('.xooapp-icon-remove').removeClass('hidden');
                $dialog.dialog('close');

              });

              $search.keyup( function(){

                var value  = $(this).val(),
                    $icons = $load.find('a');

                $icons.each(function() {

                  var $ico = $(this);

                  if ( $ico.data('xooapp-icon').search( new RegExp( value, 'i' ) ) < 0 ) {
                    $ico.hide();
                  } else {
                    $ico.show();
                  }

                });

              });

              $load.find('.xooapp-icon-tooltip').cstooltip({html:true, placement:'top', container:'body'});

            }
          });

        }

      });

      $XOOAPP_body.on('click', '.xooapp-icon-remove', function( e ) {

        e.preventDefault();

        var $this   = $(this),
            $parent = $this.closest('.xooapp-icon-select');

        $parent.find('.xooapp-icon-preview').addClass('hidden');
        $parent.find('input').val('').trigger('change');
        $this.addClass('hidden');

      });

    };

    // run initializer
    base.init();
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework SHORTCODE MANAGER
  // ------------------------------------------------------
  $.XOOAPPFramework.SHORTCODE_MANAGER = function() {

    var base = this, deploy_atts;

    base.init = function () {

      var $dialog          = $('#xooapp-shortcode-dialog'),
          $insert          = $dialog.find('.xooapp-dialog-insert'),
          $shortcodeload   = $dialog.find('.xooapp-dialog-load'),
          $selector        = $dialog.find('.xooapp-dialog-select'),
          shortcode_target = false,
          shortcode_name,
          shortcode_view,
          shortcode_clone,
          $shortcode_button,
          editor_id;

      $XOOAPP_body.on('click', '.xooapp-shortcode', function( e ) {

        e.preventDefault();

        // init chosen
        $selector.XOOAPPFramework_CHOSEN();

        $shortcode_button = $(this);
        shortcode_target  = $shortcode_button.hasClass('xooapp-shortcode-textarea');
        editor_id         = $shortcode_button.data('editor-id');

        $dialog.dialog({
          width: 850,
          height: 700,
          modal: true,
          resizable: false,
          closeOnEscape: true,
          position: {my: 'center', at: 'center', of: window},
          open: function() {

            // fix scrolling
            $XOOAPP_body.addClass('xooapp-shortcode-scrolling');

            // fix button for VC
            $('.ui-dialog-titlebar-close').addClass('ui-button');

            // set viewpoint
            $(window).on('resize', function () {

              var height      = $(window).height(),
                  load_height = Math.floor( height - 281 ),
                  set_height  = Math.floor( height - 125 );

              $dialog.dialog('option', 'height', set_height).parent().css('max-height', set_height);
              $dialog.css('overflow', 'auto');
              $shortcodeload.css( 'height', load_height );

            }).resize();

          },
          close: function() {
            shortcode_target = false;
            $XOOAPP_body.removeClass('xooapp-shortcode-scrolling');
          }
        });

      });

      $selector.on( 'change', function() {

        var $elem_this     = $(this);
            shortcode_name = $elem_this.val();
            shortcode_view = $elem_this.find(':selected').data('view');

        // check val
        if( shortcode_name.length ){

          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              action: 'xooapp-get-shortcode',
              shortcode: shortcode_name
            },
            success: function( content ) {

              $shortcodeload.html( content );
              $insert.parent().removeClass('hidden');

              shortcode_clone = $('.xooapp-shortcode-clone', $dialog).clone();

              $shortcodeload.XOOAPPFramework_DEPENDENCY();
              $shortcodeload.XOOAPPFramework_DEPENDENCY('sub');
              $shortcodeload.XOOAPPFramework_RELOAD_PLUGINS();

            }
          });

        } else {

          $insert.parent().addClass('hidden');
          $shortcodeload.html('');

        }

      });

      $insert.on('click', function ( e ) {

        e.preventDefault();

        var send_to_shortcode = '',
            ruleAttr          = 'data-atts',
            cloneAttr         = 'data-clone-atts',
            cloneID           = 'data-clone-id';

        switch ( shortcode_view ){

          case 'contents':

            $('[' + ruleAttr + ']', '.xooapp-dialog-load').each( function() {
              var _this = $(this), _atts = _this.data('atts');
              send_to_shortcode += '['+_atts+']';
              send_to_shortcode += _this.val();
              send_to_shortcode += '[/'+_atts+']';
            });

          break;

          case 'clone':

            send_to_shortcode += '[' + shortcode_name; // begin: main-shortcode

            // main-shortcode attributes
            $('[' + ruleAttr + ']', '.xooapp-dialog-load .xooapp-element:not(.hidden)').each( function() {
              var _this_main = $(this), _this_main_atts = _this_main.data('atts');
              send_to_shortcode += base.validate_atts( _this_main_atts, _this_main );  // validate empty atts
            });

            send_to_shortcode += ']'; // end: main-shortcode attributes

            // multiple-shortcode each
            $('[' + cloneID + ']', '.xooapp-dialog-load').each( function() {

                var _this_clone = $(this),
                    _clone_id   = _this_clone.data('clone-id');

                send_to_shortcode += '[' + _clone_id; // begin: multiple-shortcode

                // multiple-shortcode attributes
                $('[' + cloneAttr + ']', _this_clone.find('.xooapp-element').not('.hidden') ).each( function() {

                  var _this_multiple = $(this), _atts_multiple = _this_multiple.data('clone-atts');

                  // is not attr content, add shortcode attribute else write content and close shortcode tag
                  if( _atts_multiple !== 'content' ){
                    send_to_shortcode += base.validate_atts( _atts_multiple, _this_multiple ); // validate empty atts
                  }else if ( _atts_multiple === 'content' ){
                    send_to_shortcode += ']';
                    send_to_shortcode += _this_multiple.val();
                    send_to_shortcode += '[/'+_clone_id+'';
                  }
                });

                send_to_shortcode += ']'; // end: multiple-shortcode

            });

            send_to_shortcode += '[/' + shortcode_name + ']'; // end: main-shortcode

          break;

          case 'clone_duplicate':

            // multiple-shortcode each
            $('[' + cloneID + ']', '.xooapp-dialog-load').each( function() {

              var _this_clone = $(this),
                  _clone_id   = _this_clone.data('clone-id');

              send_to_shortcode += '[' + _clone_id; // begin: multiple-shortcode

              // multiple-shortcode attributes
              $('[' + cloneAttr + ']', _this_clone.find('.xooapp-element').not('.hidden') ).each( function() {

                var _this_multiple = $(this),
                    _atts_multiple = _this_multiple.data('clone-atts');


                // is not attr content, add shortcode attribute else write content and close shortcode tag
                if( _atts_multiple !== 'content' ){
                  send_to_shortcode += base.validate_atts( _atts_multiple, _this_multiple ); // validate empty atts
                }else if ( _atts_multiple === 'content' ){
                  send_to_shortcode += ']';
                  send_to_shortcode += _this_multiple.val();
                  send_to_shortcode += '[/'+_clone_id+'';
                }
              });

              send_to_shortcode += ']'; // end: multiple-shortcode

            });

          break;

          default:

            send_to_shortcode += '[' + shortcode_name;

            $('[' + ruleAttr + ']', '.xooapp-dialog-load .xooapp-element:not(.hidden)').each( function() {

              var _this = $(this), _atts = _this.data('atts');

              // is not attr content, add shortcode attribute else write content and close shortcode tag
              if( _atts !== 'content' ){
                send_to_shortcode += base.validate_atts( _atts, _this ); // validate empty atts
              }else if ( _atts === 'content' ){
                send_to_shortcode += ']';
                send_to_shortcode += _this.val();
                send_to_shortcode += '[/'+shortcode_name+'';
              }

            });

            send_to_shortcode += ']';

          break;

        }

        if( shortcode_target ) {
          var $textarea = $shortcode_button.next();
          $textarea.val( base.insertAtChars( $textarea, send_to_shortcode ) ).trigger('change');
        } else {
          base.send_to_editor( send_to_shortcode, editor_id );
        }

        deploy_atts = null;

        $dialog.dialog( 'close' );

      });

      // cloner button
      var cloned = 0;
      $dialog.on('click', '#shortcode-clone-button', function( e ) {

        e.preventDefault();

        // clone from cache
        var cloned_el = shortcode_clone.clone().hide();

        cloned_el.find('input:radio').attr('name', '_nonce_' + cloned);

        $('.xooapp-shortcode-clone:last').after( cloned_el );

        // add - remove effects
        cloned_el.slideDown(100);

        cloned_el.find('.xooapp-remove-clone').show().on('click', function( e ) {

          cloned_el.slideUp(100, function(){ cloned_el.remove(); });
          e.preventDefault();

        });

        // reloadPlugins
        cloned_el.XOOAPPFramework_DEPENDENCY('sub');
        cloned_el.XOOAPPFramework_RELOAD_PLUGINS();
        cloned++;

      });

    };

    base.validate_atts = function( _atts, _this ) {

      var el_value;

      if( _this.data('check') !== undefined && deploy_atts === _atts ) { return ''; }

      deploy_atts = _atts;

      if ( _this.closest('.pseudo-field').hasClass('hidden') === true ) { return ''; }
      if ( _this.hasClass('pseudo') === true ) { return ''; }

      if( _this.is(':checkbox') || _this.is(':radio') ) {
        el_value = _this.is(':checked') ? _this.val() : '';
      } else {
        el_value = _this.val();
      }

      if( _this.data('check') !== undefined ) {
        el_value = _this.closest('.xooapp-element').find('input:checked').map( function() {
         return $(this).val();
        }).get();
      }

      if( el_value !== null && el_value !== undefined && el_value !== '' && el_value.length !== 0 ) {
        return ' ' + _atts + '="' + el_value + '"';
      }

      return '';

    };

    base.insertAtChars = function( _this, currentValue ) {

      var obj = ( typeof _this[0].name !== 'undefined' ) ? _this[0] : _this;

      if ( obj.value.length && typeof obj.selectionStart !== 'undefined' ) {
        obj.focus();
        return obj.value.substring( 0, obj.selectionStart ) + currentValue + obj.value.substring( obj.selectionEnd, obj.value.length );
      } else {
        obj.focus();
        return currentValue;
      }

    };

    base.send_to_editor = function( html, editor_id ) {

      var tinymce_editor;

      if ( typeof tinymce !== 'undefined' ) {
        tinymce_editor = tinymce.get( editor_id );
      }

      if ( tinymce_editor && !tinymce_editor.isHidden() ) {
        tinymce_editor.execCommand( 'mceInsertContent', false, html );
      } else {
        var $editor = $('#'+editor_id);
        $editor.val( base.insertAtChars( $editor, html ) ).trigger('change');
      }

    };

    // run initializer
    base.init();
  };
  // ======================================================

  // ======================================================
  // XOOAPPFramework COLORPICKER
  // ------------------------------------------------------
  if( typeof Color === 'function' ) {

    // adding alpha support for Automattic Color.js toString function.
    Color.fn.toString = function () {

      // check for alpha
      if ( this._alpha < 1 ) {
        return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
      }

      var hex = parseInt( this._color, 10 ).toString( 16 );

      if ( this.error ) { return ''; }

      // maybe left pad it
      if ( hex.length < 6 ) {
        for (var i = 6 - hex.length - 1; i >= 0; i--) {
          hex = '0' + hex;
        }
      }

      return '#' + hex;

    };

  }

  $.XOOAPPFramework.PARSE_COLOR_VALUE = function( val ) {

    var value = val.replace(/\s+/g, ''),
        alpha = ( value.indexOf('rgba') !== -1 ) ? parseFloat( value.replace(/^.*,(.+)\)/, '$1') * 100 ) : 100,
        rgba  = ( alpha < 100 ) ? true : false;

    return { value: value, alpha: alpha, rgba: rgba };

  };

  $.fn.XOOAPPFramework_COLORPICKER = function() {

    return this.each(function() {

      var $this = $(this);

      // check for rgba enabled/disable
      if( $this.data('rgba') !== false ) {

        // parse value
        var picker = $.XOOAPPFramework.PARSE_COLOR_VALUE( $this.val() );

        // wpColorPicker core
        $this.wpColorPicker({

          // wpColorPicker: clear
          clear: function() {
            $this.trigger('keyup');
          },

          // wpColorPicker: change
          change: function( event, ui ) {

            var ui_color_value = ui.color.toString();

            // update checkerboard background color
            $this.closest('.wp-picker-container').find('.xooapp-alpha-slider-offset').css('background-color', ui_color_value);
            $this.val(ui_color_value).trigger('change');

          },

          // wpColorPicker: create
          create: function() {

            // set variables for alpha slider
            var a8cIris       = $this.data('a8cIris'),
                $container    = $this.closest('.wp-picker-container'),

                // appending alpha wrapper
                $alpha_wrap   = $('<div class="xooapp-alpha-wrap">' +
                                  '<div class="xooapp-alpha-slider"></div>' +
                                  '<div class="xooapp-alpha-slider-offset"></div>' +
                                  '<div class="xooapp-alpha-text"></div>' +
                                  '</div>').appendTo( $container.find('.wp-picker-holder') ),

                $alpha_slider = $alpha_wrap.find('.xooapp-alpha-slider'),
                $alpha_text   = $alpha_wrap.find('.xooapp-alpha-text'),
                $alpha_offset = $alpha_wrap.find('.xooapp-alpha-slider-offset');

            // alpha slider
            $alpha_slider.slider({

              // slider: slide
              slide: function( event, ui ) {

                var slide_value = parseFloat( ui.value / 100 );

                // update iris data alpha && wpColorPicker color option && alpha text
                a8cIris._color._alpha = slide_value;
                $this.wpColorPicker( 'color', a8cIris._color.toString() );
                $alpha_text.text( ( slide_value < 1 ? slide_value : '' ) );

              },

              // slider: create
              create: function() {

                var slide_value = parseFloat( picker.alpha / 100 ),
                    alpha_text_value = slide_value < 1 ? slide_value : '';

                // update alpha text && checkerboard background color
                $alpha_text.text(alpha_text_value);
                $alpha_offset.css('background-color', picker.value);

                // wpColorPicker clear for update iris data alpha && alpha text && slider color option
                $container.on('click', '.wp-picker-clear', function() {

                  a8cIris._color._alpha = 1;
                  $alpha_text.text('').trigger('change');
                  $alpha_slider.slider('option', 'value', 100).trigger('slide');

                });

                // wpColorPicker default button for update iris data alpha && alpha text && slider color option
                $container.on('click', '.wp-picker-default', function() {

                  var default_picker = $.XOOAPPFramework.PARSE_COLOR_VALUE( $this.data('default-color') ),
                      default_value  = parseFloat( default_picker.alpha / 100 ),
                      default_text   = default_value < 1 ? default_value : '';

                  a8cIris._color._alpha = default_value;
                  $alpha_text.text(default_text);
                  $alpha_slider.slider('option', 'value', default_picker.alpha).trigger('slide');

                });

                // show alpha wrapper on click color picker button
                $container.on('click', '.wp-color-result', function() {
                  $alpha_wrap.toggle();
                });

                // hide alpha wrapper on click body
                $XOOAPP_body.on( 'click.wpcolorpicker', function() {
                  $alpha_wrap.hide();
                });

              },

              // slider: options
              value: picker.alpha,
              step: 1,
              min: 1,
              max: 100

            });
          }

        });

      } else {

        // wpColorPicker default picker
        $this.wpColorPicker({
          clear: function() {
            $this.trigger('keyup');
          },
          change: function( event, ui ) {
            $this.val(ui.color.toString()).trigger('change');
          }
        });

      }

    });

  };
  // ======================================================

  // ======================================================
  // ON WIDGET-ADDED RELOAD FRAMEWORK PLUGINS
  // ------------------------------------------------------
  $.XOOAPPFramework.WIDGET_RELOAD_PLUGINS = function() {
    $(document).on('widget-added widget-updated', function( event, $widget ) {
      $widget.XOOAPPFramework_RELOAD_PLUGINS();
      $widget.XOOAPPFramework_DEPENDENCY();
    });
  };

  // ======================================================
  // TOOLTIP HELPER
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_TOOLTIP = function() {
    return this.each(function() {
      var placement = ( XOOAPP_is_rtl ) ? 'right' : 'left';
      $(this).cstooltip({html:true, placement:placement, container:'body'});
    });
  };

  // ======================================================
  // RELOAD FRAMEWORK PLUGINS
  // ------------------------------------------------------
  $.fn.XOOAPPFramework_RELOAD_PLUGINS = function() {
    return this.each(function() {
      $('.chosen', this).XOOAPPFramework_CHOSEN();
      $('.xooapp-field-image-select', this).XOOAPPFramework_IMAGE_SELECTOR();
      $('.xooapp-field-image', this).XOOAPPFramework_IMAGE_UPLOADER();
      $('.xooapp-field-gallery', this).XOOAPPFramework_IMAGE_GALLERY();
      $('.xooapp-field-sorter', this).XOOAPPFramework_SORTER();
      $('.xooapp-field-upload', this).XOOAPPFramework_UPLOADER();
      $('.xooapp-field-typography', this).XOOAPPFramework_TYPOGRAPHY();
      $('.xooapp-field-color-picker', this).XOOAPPFramework_COLORPICKER();
      $('.xooapp-help', this).XOOAPPFramework_TOOLTIP();
    });
  };

  // ======================================================
  // JQUERY DOCUMENT READY
  // ------------------------------------------------------
  $(document).ready( function() {
    $('.xooapp-framework').XOOAPPFramework_TAB_NAVIGATION();
    $('.xooapp-reset-confirm, .xooapp-import-backup').XOOAPPFramework_CONFIRM();
    $('.xooapp-content, .wp-customizer, .widget-content, .xooapp-taxonomy').XOOAPPFramework_DEPENDENCY();
    $('.xooapp-field-group').XOOAPPFramework_GROUP();
    $('.xooapp-save').XOOAPPFramework_SAVE();
    $('.xooapp-taxonomy').XOOAPPFramework_TAXONOMY();
    $('.xooapp-framework, #widgets-right').XOOAPPFramework_RELOAD_PLUGINS();
    $.XOOAPPFramework.ICONS_MANAGER();
    $.XOOAPPFramework.SHORTCODE_MANAGER();
    $.XOOAPPFramework.WIDGET_RELOAD_PLUGINS();
  });

})( jQuery, window, document );
