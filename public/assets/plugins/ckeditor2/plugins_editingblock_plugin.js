 ﻿/*
  2 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
  3 For licensing, see LICENSE.html or http://ckeditor.com/license
  4 */

 (function()
 {
     	// This is a semaphore used to avoid recursive calls between
     	// the following data handling functions.
     	var isHandlingData;

     	CKEDITOR.plugins.add( 'editingblock',
         	{
         		init : function( editor )
         		{
             			if ( !editor.config.editingBlock )
                 				return;

             			editor.on( 'themeSpace', function( event )
             				{
                 					if ( event.data.space == 'contents' )
                     						event.data.html += '<br>';
                 				});

             			editor.on( 'themeLoaded', function()
             				{
                 					editor.fireOnce( 'editingBlockReady' );
                 				});

             			editor.on( 'uiReady', function()
             				{
                 					editor.setMode( editor.config.startupMode );
                 				});

             			editor.on( 'afterSetData', function()
             				{
                 					if ( !isHandlingData )
                     					{
                     						function setData()
                     						{
                         							isHandlingData = true;
                         							editor.getMode().loadData( editor.getData() );
                         							isHandlingData = false;
                         						}

                     						if ( editor.mode )
                         							setData();
                     						else
                     						{
                         							editor.on( 'mode', function()
                         								{
                             									if ( editor.mode )
                                 									{
                                 										setData();
                                 										editor.removeListener( 'mode', arguments.callee );
                                 									}
                             								});
                         						}
                     					}
                 				});

             			editor.on( 'beforeGetData', function()
             				{
                 					if ( !isHandlingData && editor.mode )
                     					{
                     						isHandlingData = true;
                     						editor.setData( editor.getMode().getData(), null, 1 );
                     						isHandlingData = false;
                     					}
                 				});

             			editor.on( 'getSnapshot', function( event )
             				{
                 					if ( editor.mode )
                     						event.data = editor.getMode().getSnapshotData();
                 				});

             			editor.on( 'loadSnapshot', function( event )
             				{
                 					if ( editor.mode )
                     						editor.getMode().loadSnapshotData( event.data );
                 				});

             			// For the first "mode" call, we'll also fire the "instanceReady"
             			// event.
             			editor.on( 'mode', function( event )
             				{
                 					// Do that once only.
                 					event.removeListener();

                 					// Redirect the focus into editor for webkit. (#5713)
                 					CKEDITOR.env.webkit && editor.container.on( 'focus', function()
                 						{
                     							editor.focus();
                     						});

                 					if ( editor.config.startupFocus )
                     						editor.focus();

                 					// Fire instanceReady for both the editor and CKEDITOR, but
                 					// defer this until the whole execution has completed
                 					// to guarantee the editor is fully responsible.
                 					setTimeout( function(){
                     						editor.fireOnce( 'instanceReady' );
                     						CKEDITOR.fire( 'instanceReady', null, editor );
                     					}, 0 );
                 				});

             			editor.on( 'destroy', function ()
             			{
                 				// ->		currentMode.unload( holderElement );
                 				if ( this.mode )
                     					this._.modes[ this.mode ].unload( this.getThemeSpace( 'contents' ) );
                 			});
             		}
         	});

     	/**
     124 	 * The current editing mode. An editing mode is basically a viewport for
     125 	 * editing or content viewing. By default the possible values for this
     126 	 * property are "wysiwyg" and "source".
     127 	 * @type String
     128 	 * @example
     129 	 * alert( CKEDITOR.instances.editor1.mode );  // "wysiwyg" (e.g.)
     130 	 */
     	CKEDITOR.editor.prototype.mode = '';

     	/**
     134 	 * Registers an editing mode. This function is to be used mainly by plugins.
     135 	 * @param {String} mode The mode name.
     136 	 * @param {Object} modeEditor The mode editor definition.
     137 	 * @example
     138 	 */
     	CKEDITOR.editor.prototype.addMode = function( mode, modeEditor )
     	{
         		modeEditor.name = mode;
         		( this._.modes || ( this._.modes = {} ) )[ mode ] = modeEditor;
         	};

     	/**
     146 	 * Sets the current editing mode in this editor instance.
     147 	 * @param {String} mode A registered mode name.
     148 	 * @example
     149 	 * // Switch to "source" view.
     150 	 * CKEDITOR.instances.editor1.setMode( 'source' );
     151 	 */
     	CKEDITOR.editor.prototype.setMode = function( mode )
     	{
         		this.fire( 'beforeSetMode', { newMode : mode } );

         		var data,
             			holderElement = this.getThemeSpace( 'contents' ),
             			isDirty = this.checkDirty();

         		// Unload the previous mode.
         		if ( this.mode )
             		{
             			if ( mode == this.mode )
                 				return;

             			this._.previousMode = this.mode;

             			this.fire( 'beforeModeUnload' );

             			var currentMode = this.getMode();
             			data = currentMode.getData();
             			currentMode.unload( holderElement );
             			this.mode = '';
             		}

         		holderElement.setHtml( '' );

         		// Load required mode.
         		var modeEditor = this.getMode( mode );
         		if ( !modeEditor )
             			throw '[CKEDITOR.editor.setMode] Unknown mode "' + mode + '".';

         		if ( !isDirty )
             		{
             			this.on( 'mode', function()
             				{
                 					this.resetDirty();
                 					this.removeListener( 'mode', arguments.callee );
                 				});
             		}

         		modeEditor.load( holderElement, ( typeof data ) != 'string'  ? this.getData() : data );
         	};

     	/**
     196 	 * Gets the current or any of the objects that represent the editing
     197 	 * area modes. The two most common editing modes are "wysiwyg" and "source".
     198 	 * @param {String} [mode] The mode to be retrieved. If not specified, the
     199 	 *		current one is returned.
     200 	 */
     	CKEDITOR.editor.prototype.getMode = function( mode )
     	{
         		return this._.modes && this._.modes[ mode || this.mode ];
         	};

     	/**
     207 	 * Moves the selection focus to the editing are space in the editor.
     208 	 */
     	CKEDITOR.editor.prototype.focus = function()
     	{
         		this.forceNextSelectionCheck();
         		var mode = this.getMode();
         		if ( mode )
             			mode.focus();
         	};
     })();

 /**
 219  * The mode to load at the editor startup. It depends on the plugins
 220  * loaded. By default, the "wysiwyg" and "source" modes are available.
 221  * @type String
 222  * @default 'wysiwyg'
 223  * @example
 224  * config.startupMode = 'source';
 225  */
 CKEDITOR.config.startupMode = 'wysiwyg';

 /**
 229  * Sets whether the editor should have the focus when the page loads.
 230  * @name CKEDITOR.config.startupFocus
 231  * @type Boolean
 232  * @default false
 233  * @example
 234  * config.startupFocus = true;
 235  */

 /**
 238  * Whether to render or not the editing block area in the editor interface.
 239  * @type Boolean
 240  * @default true
 241  * @example
 242  * config.editingBlock = false;
 243  */
 CKEDITOR.config.editingBlock = true;


