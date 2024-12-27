(function ($) {
	"use strict";

	function random_id() {
		var id = 'h' + Math.random().toString(36).substr(3, 9);
		return id;
	}

	// CSS Pseudo Selected
	function pseudoStyle( selector, inline_css ) {
		var style  = document.querySelector('style[id="pseudo-css"]') || document.createElement('style');
		style.id   = 'pseudo-css';
		style.type = 'text/css';

		var css = selector + inline_css ;
		if (style.styleSheet){
			style.styleSheet.cssText = css;
		} else {
			style.appendChild(document.createTextNode(css));
		}
		document.querySelector('body').appendChild(style);
	}

	// Insert CSS
	function insert_css(data, css, style, regex) {
		if( data.search(style) == -1 && data.search('-' . style) !== -1 ) {
			data = data.replace('}', css + '}');
		}else{
			data = data.replace(regex, css);
		}
		return data;
	}

	$('.header-builder .hb-drop span').draggable({
		revert: 'invalid',
		revertDuration: 300,
		cursor: 'move',
		helper: 'clone',
		scroll: false
	});

	function sortable_element() {
		$('.uxper-header-builder .column-wrap').sortable({
			cursor: 'move',
			scroll: false,
			tolerance: 'pointer',
			forcePlaceholderSize: true,
			connectWith: '.uxper-header-builder .column-wrap',
			placeholder: 'ui-state-highlight',
			cancel: '.builder-table-control',
			stop: function( event, ui ) {
				if( $(this).find('.ux-element').length == 0 ) {
					if( $(this).find('.hb-empty-column').length == 0 ) {
						$(this).append('<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>');
					}
				}else{
					$(this).find('.hb-empty-column').remove();
				}
			},
			receive: function( event, ui ) {
				if( $(this).find('.ux-element').length == 0 ) {
					if( $(this).find('.hb-empty-column').length == 0 ) {
						$(this).append('<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>');
					}
				}else{
					$(this).find('.hb-empty-column').remove();
				}
			},
			deactivate: function( event, ui ) {
				if( $(this).find('.ux-element').length == 0 ) {
					if( $(this).find('.hb-empty-column').length == 0 ) {
						$(this).append('<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>');
					}
				}else{
					$(this).find('.hb-empty-column').remove();
				}
			},
			change: function( event, ui ) {
				$(this).find('.hb-empty-column').remove();
			},
		}).disableSelection();
	}

	function sortable_column() {
		$('.uxper-header-builder .row').sortable({
			cursor: 'move',
			scroll: false,
			forcePlaceholderSize: true,
			connectWith: '.uxper-header-builder .row',
			placeholder: 'ui-state-highlight',
			cancel: '.builder-row-control',
			stop: function( event, ui ) {
				check_column_header('sort', $(this));
			},
			receive: function( event, ui ) {
				check_column_header('sort', $(this));
			},
		}).disableSelection();
	}

	drop_element();
	function drop_element() {
		$('.sala-builder .column-wrap').droppable({
			accept: '.header-builder .hb-drop span',
			classes: {
				'ui-droppable-active': 'ui-state-highlight'
			},
			drop: function( event, ui ) {
				var html_clone = '';
				$('.hb-list-content .ux-element').each( function (){
					if( $(this).attr('data-id') == ui.draggable.data('id') ) {
						add_control_element($(this));
						html_clone = $(this).first().clone();
					}
				});
				var html = $('<div>').append(html_clone).html();
				if( 'column' !== ui.draggable.data('id') && 'row' !== ui.draggable.data('id') ) {
					$(this).find('.hb-empty-column').remove();
				}
				if( 'column' == ui.draggable.data('id') ) {
					check_column_header('add', $(this).parent());
				}
				$(this).append( html );

				sortable_element();
			},
		});
	}

	drop_column();
	function drop_column() {
		$('.sala-builder>.row').droppable({
			accept: '.header-builder .hb-drop .column',
			classes: {
				'ui-droppable-active': 'ui-state-highlight'
			},
			drop: function( event, ui ) {
				var html_clone = '',
					id = '';
				if( 'column' == ui.draggable.data('id') ) {
					add_control_table($('.hb-list-content .column'));
					check_column_header('add', $(this));
					$('.hb-list-content .column').attr('id', random_id());
					id = $('.hb-list-content .column').attr('id');
					// Check if we already have a <style> in the <head> referencing this control.
					if ( null === document.getElementById( 'sala-custom-' + id ) || 'undefined' === typeof document.getElementById( 'sala-custom-' + id ) ) {
						// Append the <style> to the <head>.
						$( 'head' ).append( '<style id="sala-custom-'+ id +'">#'+ id +'{}</style>' );
					}
					html_clone = $('.hb-list-content .column').first().clone();
				}
				var html = $('<div>').append(html_clone).html();
				$(this).append( html );

				sortable_element();
				sortable_column();
				drop_element();
			}
		});
	}

	drop_row();
	function drop_row() {
		$('.sala-builder').droppable({
			accept: '.header-builder .hb-drop .row',
			classes: {
				'ui-droppable-active': 'ui-state-highlight'
			},
			drop: function( event, ui ) {
				var html_clone = '';
				if( 'row' == ui.draggable.data('id') ) {
					add_control_row($('.hb-list-content .row'));
					$('.hb-list-content .row').attr('id', random_id());
					$('.hb-list-content .row .column-wrap,.hb-list-content .row .column-wrap').attr('id', random_id());
					var id = $('.hb-list-content .row').attr('id');
					// Check if we already have a <style> in the <head> referencing this control.
					if ( null === document.getElementById( 'sala-custom-' + id ) || 'undefined' === typeof document.getElementById( 'sala-custom-' + id ) ) {
						// Append the <style> to the <head>.
						$( 'head' ).append( '<style id="sala-custom-'+ id +'">#'+ id +'{}</style>' );
					}
					html_clone = $('.hb-list-content .row').first().clone();
				}
				var html = $('<div>').append(html_clone).html();
				$(this).append( html );

				$('.sala-builder').sortable({
					cursor: 'move',
					scroll: false,
					forcePlaceholderSize: true,
					connectWith: '.sala-builder',
					placeholder: 'ui-state-highlight',
				});
				$('.sala-builder').disableSelection();

				sortable_element();
				drop_element();
				drop_column();
			}
		});
	}

	$('.header-builder').on('click', '.hb-action a', function (e){
		e.preventDefault();
		$(this).closest('.header-builder').addClass('active');
		$('header.site-header,.site-topbar').addClass('uxper-header-builder');
		$('.uxper-header-builder .column-wrap').sortable({
			cursor: 'move',
			scroll: false,
			forcePlaceholderSize: true,
			connectWith: '.uxper-header-builder .column-wrap',
			placeholder: 'ui-state-highlight',
			cancel: '.builder-table-control'
		}).disableSelection();
		$('.uxper-header-builder .column-wrap').sortable('option','disabled',false);
		sortable_column();
	});

	$('.header-builder').on('click', '.header-close-button', function (e){
		e.preventDefault();
		$(this).closest('.header-builder').removeClass('active');
		$('header.site-header,.site-topbar').removeClass('uxper-header-builder');
		$('.uxper-header-builder .column-wrap').sortable('option','disabled',true);
		$('.uxper-header-builder .column-wrap').enableSelection();
		$('.uxper-header-builder .row').sortable('option','disabled',true);
		$('.uxper-header-builder .row').enableSelection();
	});

	$('.sala-builder .ux-element').each( function (){
		add_control_element($(this));
	});

	$('.sala-builder>.row').each( function (){
		var id = $(this).attr('id');
		if( typeof id == 'undefined' ) {
			$(this).attr('id', random_id());
			id = $(this).attr('id');
		}
		// Check if we already have a <style> in the <head> referencing this control.
		if ( null === document.getElementById( 'sala-custom-' + id ) || 'undefined' === typeof document.getElementById( 'sala-custom-' + id ) ) {
			// Append the <style> to the <head>.
			$( 'head' ).append( '<style id="sala-custom-'+ id +'">#'+ id +'{}</style>' );
		}
		add_control_row($(this));
	});

	$('.sala-builder .column-wrap').each( function (){
		var id = $(this).attr('id');
		if( typeof id == 'undefined' ) {
			$(this).attr('id', random_id());
			id = $(this).attr('id');
		}
		// Check if we already have a <style> in the <head> referencing this control.
		if ( null === document.getElementById( 'sala-custom-' + id ) || 'undefined' === typeof document.getElementById( 'sala-custom-' + id ) ) {
			// Append the <style> to the <head>.
			$( 'head' ).append( '<style type="text/css" id="sala-custom-'+ id +'">#'+ id +'{}</style>' );
		}
		if( $(this).find('.ux-element').length == 0 ) {
			if( $(this).find('.hb-empty-column').length == 0 ) {
				$(this).append('<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>');
			}
		}else{
			$(this).find('.hb-empty-column').remove();
		}
		add_control_table($(this));
	});

	function add_control_element(ele) {
		var control = '<div class="builder-element-control"><span class="btn-control btn-edit"></span><span class="btn-control btn-delete"></span></div>';
		if( ele.find('.builder-element-control').length == 0 ) {
			ele.append(control);
		}
	}

	function add_control_table(ele) {
		var control = '<div class="builder-table-control"><span class="btn-control btn-edit"></span><span class="btn-control btn-delete"></span></div>';
		if( ele.find('.builder-table-control').length == 0 ) {
			ele.append(control);
		}
	}

	function add_control_row(ele) {
		var control = '<div class="builder-row-control"><span class="btn-control btn-edit"></span><span class="btn-control btn-delete"></span></div>';
		if( ele.find('.builder-row-control').length == 0 ) {
			ele.append(control);
		}
	}

	function check_column_header(action, parent) {
		var column = parent.find('.column-wrap').length;
		parent.find('.column-wrap').each( function() {
			var width = parseFloat(100 / column).toFixed(0);
			$(this).attr('data-col', Math.floor(width));
			$('.hb-list-content .column-wrap').attr('data-col', Math.floor(width));
		});
	}

	$('body').on('click', '.ux-element .btn-delete', function (e){
		e.stopPropagation();
		var current = $(this).closest('.ux-element');
		var parent = $(this).closest('.column-wrap');
		current.remove();
		if( parent.find('.ux-element').length == 0 ) {
			if( $(this).find('.hb-empty-column').length == 0 ) {
				parent.append('<div class="hb-empty-column"><div class="inner"><i class="fal fa-plus"></i></div></div>');
			}
		}
	});

	$('body').on('click', '.builder-table-control .btn-delete', function (e){
		e.stopPropagation();
		var current = $(this).closest('.column-wrap');
		var parent = $(this).closest('.row');
		if( parent.find('.column-wrap').length == 1 ) {
			var parent_id = parent.attr('id');
			$('#sala-custom-' + parent_id).remove();
			parent.remove();
		}else{
			var current_id = current.attr('id');
			$('#sala-custom-' + current_id).remove();
			current.remove();
		}
		check_column_header('remove', parent);
	});

	$('body').on('click', '.builder-row-control .btn-delete', function (e){
		e.stopPropagation();
		var current = $(this).closest('.row');
		var current_id = current.attr('id');
		$('#sala-custom-' + current_id).remove();
		current.remove();
	});

	$('body').on('click', '.column-wrap .btn-edit,.column-wrap .btn-edit', function (e){
		e.stopPropagation();
		var id = $(this).closest('.column-wrap').attr('id');
		$('.uxper-header-builder .column-wrap').removeClass('active');
		$(this).closest('.column-wrap').addClass('active');
	});

	$('body').on('click', '.builder-row-control .btn-edit', function (e){
		e.stopPropagation();
		var id = $(this).closest('.row').attr('id');
		$('.uxper-header-builder .row').removeClass('active');
		$(this).closest('.row').addClass('active');
	});

	function header_builder() {
		var html_clone, css;
		var header = $('header.site-header').attr('data-section');
		var html_clone = $( 'body #wrapper header.site-header' ).first().clone();
		html_clone.find('.customize-partial-edit-shortcut').remove();
		html_clone.find('.builder-element-control').remove();
		html_clone.find('.builder-table-control').remove();
		html_clone.find('.builder-row-control').remove();
		html_clone.find('form>input').remove();
		html_clone.find('.sala-builder>.row,.column-wrap').removeClass('active');
		html_clone.find('div').removeClass('ui-sortable-handle ui-droppable ui-sortable ui-sortable-disabled').removeAttr('style');
		html_clone.removeClass('uxper-header-builder').removeAttr('title');

		var header_obj = {};
		html_clone.find('>div').each( function(){
			var inner_obj = {};
			var ele_class = $(this).attr('class');
			var ele_id = $(this).attr('id');
			inner_obj.class = ele_class;
			inner_obj.id = ele_id;

			var row_arr = [];
			$(this).find('>div.row').each( function(){
				var row_obj = {};
				var ele_class = $(this).attr('class');
				var ele_id = $(this).attr('id');
				row_obj.class = ele_class;
				row_obj.id = ele_id;

				var wrap_arr = [];
				$(this).find('>div.column-wrap').each( function(){
					var wrap_obj = {};
					var ele_class = $(this).attr('class');
					var ele_id = $(this).attr('id');
					var ele_col = $(this).attr('data-col');
					var ele_md_col = $(this).attr('data-md-col');
					var ele_sm_col = $(this).attr('data-sm-col');
					wrap_obj.class = ele_class;
					wrap_obj.id = ele_id;
					wrap_obj.col = ele_col;
					wrap_obj.md_col = ele_md_col;
					wrap_obj.sm_col = ele_sm_col;

					var item_arr = [];
					$(this).find('>div.ux-element').each( function(){
						var item_obj = {};
						var ele_class = $(this).attr('class');
						var ele_id = $(this).attr('id');
						var ele_data_id = $(this).attr('data-id');
						item_obj.class = ele_class;
						item_obj.id = ele_id;
						item_obj.data_id = ele_data_id;
						item_arr.push(item_obj);
					});

					wrap_obj.child = item_arr;
					wrap_arr.push(wrap_obj);
				});

				row_obj.child = wrap_arr;
				row_arr.push(row_obj);
			});

			inner_obj.child = row_arr;
			header_obj.header = inner_obj;
		});

		var css = $('[id^="sala-custom-"]').text();

		$.ajax({
			url: customize_preview.ajax_url,
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'sala_header_builder',
				header: header,
				header_obj: header_obj,
				css: css,
			},
			beforeSend: function () {
				$('.header-builder .header-save-button').text('Saving...');
			},
			success: function(data) {
				if(data) {
					$('.header-builder .header-save-button').text('Save');
				}else{
					$('.header-builder .header-save-button').text('Error');
				}
			}
		});
	}

	function header_delete_builder() {
		var header = $('header.site-header').attr('data-section');

		if (!header) return;

		var r = confirm(customize_preview.delete);

		if (!r) return;

		$.ajax({
			url: customize_preview.ajax_url,
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'sala_header_delete_builder',
				header: header,
			},
			beforeSend: function () {

			},
			success: function(data) {
				if(data) {
					$('.header-builder .header-delete-button').text('Delete');
				}else{
					$('.header-builder .header-delete-button').text('Error');
				}
				window.location.reload();
			}
		});
	}

	function topbar_builder() {
		var html_clone, css;
		var topbar = $('.site-topbar').attr('data-section');
		var html_clone = $( 'body #wrapper .site-topbar' ).first().clone();
		html_clone.find('.customize-partial-edit-shortcut').remove();
		html_clone.find('.builder-element-control').remove();
		html_clone.find('.builder-table-control').remove();
		html_clone.find('.builder-row-control').remove();
		html_clone.find('form>input').remove();
		html_clone.find('.sala-builder>.row,.column-wrap').removeClass('active');
		html_clone.find('div').removeClass('ui-sortable-handle ui-droppable ui-sortable ui-sortable-disabled').removeAttr('style');
		html_clone.removeClass('uxper-header-builder').removeAttr('title');

		var topbar_obj = {};
		html_clone.find('>div').each( function(){
			var inner_obj = {};
			var ele_class = $(this).attr('class');
			var ele_id = $(this).attr('id');
			inner_obj.class = ele_class;
			inner_obj.id = ele_id;

			var row_arr = [];
			$(this).find('>div.row').each( function(){
				var row_obj = {};
				var ele_class = $(this).attr('class');
				var ele_id = $(this).attr('id');
				row_obj.class = ele_class;
				row_obj.id = ele_id;

				var wrap_arr = [];
				$(this).find('>div.column-wrap').each( function(){
					var wrap_obj = {};
					var ele_class = $(this).attr('class');
					var ele_id = $(this).attr('id');
					var ele_col = $(this).attr('data-col');
					var ele_md_col = $(this).attr('data-md-col');
					var ele_sm_col = $(this).attr('data-sm-col');
					wrap_obj.class = ele_class;
					wrap_obj.id = ele_id;
					wrap_obj.col = ele_col;
					wrap_obj.md_col = ele_md_col;
					wrap_obj.sm_col = ele_sm_col;

					var item_arr = [];
					$(this).find('>div.ux-element').each( function(){
						var item_obj = {};
						var ele_class = $(this).attr('class');
						var ele_id = $(this).attr('id');
						var ele_data_id = $(this).attr('data-id');
						item_obj.class = ele_class;
						item_obj.id = ele_id;
						item_obj.data_id = ele_data_id;
						item_arr.push(item_obj);
					});

					wrap_obj.child = item_arr;
					wrap_arr.push(wrap_obj);
				});

				row_obj.child = wrap_arr;
				row_arr.push(row_obj);
			});

			inner_obj.child = row_arr;
			topbar_obj.topbar = inner_obj;
		});

		var css = $('[id^="sala-custom-"]').text();

		$.ajax({
			url: customize_preview.ajax_url,
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'sala_topbar_builder',
				topbar: topbar,
				topbar_obj: topbar_obj,
				css: css,
			},
			beforeSend: function () {
				$('.header-builder .header-save-button').text('Saving...');
			},
			success: function(data) {
				if(data) {
					$('.header-builder .header-save-button').text('Save');
				}else{
					$('.header-builder .header-save-button').text('Error');
				}
			}
		});
	}

	function topbar_delete_builder() {
		var topbar = $('.site-topbar').attr('data-section');

		if (!topbar) return;

		var r = confirm(customize_preview.delete);

		if (!r) return;

		$.ajax({
			url: customize_preview.ajax_url,
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'sala_topbar_delete_builder',
				topbar: topbar,
			},
			beforeSend: function () {

			},
			success: function(data) {
				if(data) {
					$('.header-builder .header-delete-button').text('Delete');
				}else{
					$('.header-builder .header-delete-button').text('Error');
				}
				window.location.reload();
			}
		});
	}

	$('.header-builder .header-save-button').on('click', function (){
		header_builder();
		topbar_builder();
	});

	$('.header-builder .header-delete-button').on('click', function (){
		header_delete_builder();
		topbar_delete_builder();
	});

	wp.customize.bind( 'saved', function( d ){
		header_builder();
	});

	// Send and listen data
	wp.customize.bind( 'preview-ready', function() {
		// Listen data from control
		wp.customize.preview.bind( 'device', function( data ) {
			$('.header-builder .change-device a').removeClass('active');
			$('.header-builder .change-device .enable-' + data).addClass('active');
		} );
		// Send data to control
		wp.customize.preview.bind( 'active', function() {
			$('.header-builder .change-device a').on('click', function (){
				$('.header-builder .change-device a').removeClass('active');
				$(this).addClass('active');
				var device = $(this).attr('data-device');
				wp.customize.preview.send( 'device', device );
			});

			$('body').on('click', '.builder-table-control .btn-edit', function (){
				wp.customize.preview.send( 'header_column', 'header_column' );
			});

			$('body').on('click', '.builder-row-control .btn-edit', function (){
				wp.customize.preview.send( 'header_row', 'header_row' );
			});

			$('body').on('click', '.builder-element-control .btn-edit',function (){
				var control = $(this).closest('.ux-element').attr('data-id');
				if( control ) {
					control = control.replace(/-/g, '_');
					wp.customize.preview.send( 'header_control', control );
				}
			});
		} );
	} );

	// Column Width
	wp.customize( 'hb_column_width', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.column-wrap.active,.column-wrap.active').attr( 'data-col', newval );
			}
		} );
	});

	// Column Width Mobile
	wp.customize( 'hb_column_width_tablet', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.column-wrap.active,.column-wrap.active').attr( 'data-md-col', newval );
			}
		} );
	});

	// Column Width Mobile
	wp.customize( 'hb_column_width_mobile', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.column-wrap.active,.column-wrap.active').attr( 'data-sm-col', newval );
			}
		} );
	});

	wp.customize( 'hb_column_horizontal_align', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'justify-content:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /justify-content.*?;/;
				var data = insert_css(all_css, css, 'justify-content', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_column_bg_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'background-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /background-color.*?;/;
				var data = insert_css(all_css, css, 'background-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_column_border', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'border-style:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-style.*?;/;
				var data = insert_css(all_css, css, 'border-style', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_column_border_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'border-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-color.*?;/;
				var data = insert_css(all_css, css, 'border-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_column_border_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'border-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-color.*?;/;
				var data = insert_css(all_css, css, 'border-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_column_border_width', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			var top = '0px',
				right = '0px',
				bottom = '0px',
				left = '0px';

			if( newval.top ) {
				top = newval.top;
			}
			if( newval.right ) {
				right = newval.right;
			}
			if( newval.bottom ) {
				bottom = newval.bottom;
			}
			if( newval.left ) {
				left = newval.left;
			}
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'border-width:' + top + ' ' + right + ' ' + bottom + ' ' + left + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-width.*?;/;
				var data = insert_css(all_css, css, 'border-width', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Column Padding Top
	wp.customize( 'hb_column_padding_top', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'padding-top:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-top.*?;/;
				var data = insert_css(all_css, css, 'padding-top', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Column Padding Bottom
	wp.customize( 'hb_column_padding_bottom', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'padding-bottom:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-bottom.*?;/;
				var data = insert_css(all_css, css, 'padding-bottom', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Column Padding Right
	wp.customize( 'hb_column_padding_right', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'padding-right:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-right.*?;/;
				var data = insert_css(all_css, css, 'padding-right', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Column Padding Left
	wp.customize( 'hb_column_padding_left', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.column-wrap.active,.column-wrap.active').attr('id');
				var css = 'padding-left:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-left.*?;/;
				var data = insert_css(all_css, css, 'padding-left', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Row
	wp.customize( 'hb_row_width', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.uxper-header-builder .row.active').removeClass( 'container container-fluid' );
				$('.uxper-header-builder .row.active').addClass( newval );
			}
		} );
	});

	// Row Padding Top
	wp.customize( 'hb_row_padding_top', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'padding-top:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-top.*?;/;
				var data = insert_css(all_css, css, 'padding-top', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Row Padding Bottom
	wp.customize( 'hb_row_padding_bottom', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'padding-bottom:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-bottom.*?;/;
				var data = insert_css(all_css, css, 'padding-bottom', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Row Padding Right
	wp.customize( 'hb_row_padding_right', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'padding-right:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-right.*?;/;
				var data = insert_css(all_css, css, 'padding-right', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Row Padding Left
	wp.customize( 'hb_row_padding_left', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'padding-left:' + newval + 'px;';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /padding-left.*?;/;
				var data = insert_css(all_css, css, 'padding-left', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_horizontal_align', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'justify-content:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /justify-content.*?;/;
				var data = insert_css(all_css, css, 'justify-content', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_bg_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'background-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /background-color.*?;/;
				var data = insert_css(all_css, css, 'background-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_border', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'border-style:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-style.*?;/;
				var data = insert_css(all_css, css, 'border-style', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_border_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'border-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-color.*?;/;
				var data = insert_css(all_css, css, 'border-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_border_color', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'border-color:' + newval + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-color.*?;/;
				var data = insert_css(all_css, css, 'border-color', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	wp.customize( 'hb_row_border_width', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			var top = '0px',
				right = '0px',
				bottom = '0px',
				left = '0px';

			if( newval.top ) {
				top = newval.top;
			}
			if( newval.right ) {
				right = newval.right;
			}
			if( newval.bottom ) {
				bottom = newval.bottom;
			}
			if( newval.left ) {
				left = newval.left;
			}
			if (newval) {
				var id = $('.uxper-header-builder .row.active').attr('id');
				var css = 'border-width:' + top + ' ' + right + ' ' + bottom + ' ' + left + ';';
				var all_css = $( '#sala-custom-' + id ).text();
				var reg = /border-width.*?;/;
				var data = insert_css(all_css, css, 'border-width', reg);

				// Add the CSS to the <style> and append.
				$( '#sala-custom-' + id ).text( data );
			}
		} );
	});

	// Header Button
	wp.customize( 'header_button_text', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$( '.header-button a' ).text( newval );
			}
		} );
	});
	wp.customize( 'header_button_link', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$( '.header-button a' ).attr( 'href', newval );
			}
		} );
	});
	wp.customize( 'header_button_border_width', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			var top = '0px',
				right = '0px',
				bottom = '0px',
				left = '0px';

			if( newval.top ) {
				top = newval.top;
			}
			if( newval.right ) {
				right = newval.right;
			}
			if( newval.bottom ) {
				bottom = newval.bottom;
			}
			if( newval.left ) {
				left = newval.left;
			}
			if (newval) {
				$( '.header-button a' ).css( 'border-width', top + ' ' + right + ' ' + bottom + ' ' + left );
			}
		} );
	});

	// Header Main Menu
	wp.customize( 'main_menu_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.main-menu').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.main-menu').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'main_menu_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.main-menu').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.main-menu').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'main_menu_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.main-menu').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.main-menu').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Canvas Menu
	wp.customize( 'canvas_menu_sidebar_position', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-menu').removeClass( 'canvas-left canvas-center canvas-right' );
				$('.ux-element.canvas-menu').addClass( newval );
			}
		} );
	});
	wp.customize( 'canvas_menu_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-menu').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.canvas-menu').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'canvas_menu_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-menu').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.canvas-menu').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'canvas_menu_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-menu').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.canvas-menu').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Canvas Mobile Menu
	wp.customize( 'canvas_mb_menu_sidebar_position', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-mb-menu').removeClass( 'canvas-left canvas-center canvas-right' );
				$('.ux-element.canvas-mb-menu').addClass( newval );
			}
		} );
	});
	wp.customize( 'canvas_mb_menu_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-mb-menu').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.canvas-mb-menu').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'canvas_mb_menu_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-mb-menu').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.canvas-mb-menu').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'canvas_mb_menu_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.canvas-mb-menu').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.canvas-mb-menu').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Contact
	wp.customize( 'header_contact_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-contact').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.header-contact').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'header_contact_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-contact').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.header-contact').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'header_contact_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-contact').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.header-contact').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Language
	wp.customize( 'header_lang_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-lang').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.header-lang').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'header_lang_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-lang').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.header-lang').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'header_lang_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-lang').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.header-lang').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Search Icon
	wp.customize( 'header_search_icon_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-icon').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.header-search-icon').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'header_search_icon_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-icon').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.header-search-icon').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'header_search_icon_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-icon').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.header-search-icon').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Search Input
	wp.customize( 'header_search_input_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-input').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.header-search-input').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'header_search_input_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-input').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.header-search-input').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'header_search_input_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-search-input').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.header-search-input').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Header Device
	wp.customize( 'header_device_desktop_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-device').addClass( 'hidden-on-desktop' );
			}else{
				$('.ux-element.header-device').removeClass( 'hidden-on-desktop' );
			}
		} );
	});
	wp.customize( 'header_device_tablet_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-device').addClass( 'hidden-on-tablet' );
			}else{
				$('.ux-element.header-device').removeClass( 'hidden-on-tablet' );
			}
		} );
	});
	wp.customize( 'header_device_mobile_hidden', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			if (newval) {
				$('.ux-element.header-device').addClass( 'hidden-on-mobile' );
			}else{
				$('.ux-element.header-device').removeClass( 'hidden-on-mobile' );
			}
		} );
	});

	// Layout
	wp.customize( 'layout_content', function( value ) {
		// When the value changes.
		value.bind( function( newval ) {
			$( 'body' ).removeClass('boxed');
			$( 'body' ).addClass( newval );
			$( 'body' ).css( 'max-width', 'auto' );
		} );
	} );

} )( jQuery );
