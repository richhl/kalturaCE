/*
 * This script is run on [[Special:Upload]].
 * It controls the invocation of the mvUploader class based on local config.
 */

var mwUploadFormSelector = '#mw-upload-form';

// Set up the upload form bindings once all DOM manipulation is done
var mwUploadHelper = {
	init: function() {
		var _this = this;
		// If wgEnableFirefogg is not boolean false, set to true
		if ( typeof wgEnableFirefogg == 'undefined' ){
			wgEnableFirefogg = true;
		}
		// NOTE: we should unify upload handler call so we don't have to call firefogg and
		// UploadHandler separately.
		if ( wgEnableFirefogg ) {
			mw.load( 'AddMedia.firefogg', function(){
				// Set up the upload handler to Firefogg. Should work with the HTTP uploads too.
				$j( '#wpUploadFile' ).firefogg( {

					// An API URL (default is getLocalApiUrl but set here for clarity )
					'apiUrl': mw.getLocalApiUrl(),

					// MediaWiki API supports chunk uploads:
					'enableChunks' : false,

					// Set the interface type
					'interface_type' : 'dialog',

					'form_selector': mwUploadFormSelector,

					// Set the select file callback:
					'selectFileCb': function( fileName ) {
						// Check if we are on upload to new version page and don't update target
						// ( bug 23069 )
						if( mw.parseUri( document.URL ).queryKey['wpDestFile'] ){
							return false;
						}
						$j( '#wpDestFile' ).val( fileName );
					}
				} );
			} )
		} else {
			// Add basic upload profile support ( http status monitoring, progress box for
			// browsers that support it, etc.)
			mw.load( 'AddMedia.UploadHandler', function(){
				$j( mwUploadFormSelector ).uploadHandler( {
					'selectFileCb': function( fileName ) {
						$j( '#wpDestFile' ).val( fileName );
						$j( '#wpDestFile' ).doDestCheck( {
							'warn_target': '#wpDestFile-warning'
						} );
					}
				});
			});
		}

		if ( wgAjaxUploadDestCheck ) {
			// Do destination check
			$j( '#wpDestFile' ).change( function() {
				$j( '#wpDestFile' ).doDestCheck( {
					'warn_target':'#wpDestFile-warning'
				} );
			} );
		}

		// Check if we have HTTP enabled & setup enable/disable toggle:
		if ( $j( '#wpUploadFileURL' ).length != 0 ) {
			// Set the initial toggleUpType
			_this.toggleUpType( true );

			$j( "input[name='wpSourceType']" ).click( function() {
				_this.toggleUpType( this.id == 'wpSourceTypeFile' );
			} );
		}

		$j( '#wpUploadFile,#wpUploadFileURL' )
		.focus( function() {
			_this.toggleUpType( this.id == 'wpUploadFile' );
		} )

		// Also setup the onChange event binding:
		.change( function() {
			if ( wgUploadAutoFill ) {
				mwUploadHelper.doDestinationFill( this );
			}
		} );
	},

	/**
	* Set the upload radio buttons
	*
	* @boolean set
	*/
	toggleUpType: function( set ) {
		$j( '#wpSourceTypeFile' ).attr( 'checked', set );
		$j( '#wpUploadFile' ).attr( 'disabled', !set );

		$j( '#wpSourceTypeURL' ).attr( 'checked', !set );
		$j( '#wpUploadFileURL' ).attr( 'disabled', set );

	},

	/**
	* Fill in a destination file-name based on a source asset name.
	* @param {Element} targetElm Target element to get destination name from
	*/
	doDestinationFill: function( targetElm ) {
		mw.log( "doDestinationFill" )
		// Remove any previously flagged errors
		$j( '#mw-upload-permitted,#mw-upload-prohibited' ).hide();

		var path = $j( targetElm ).val();
		// Find trailing part
		var slash = path.lastIndexOf( '/' );
		var backslash = path.lastIndexOf( '\\' );
		var fname;
		if ( slash == -1 && backslash == -1 ) {
			fname = path;
		} else if ( slash > backslash ) {
			fname = path.substring( slash + 1, 10000 );
		} else {
			fname = path.substring( backslash + 1, 10000 );
		}

		// URLs are less likely to have a useful extension. Don't include them in the extension check.
		if ( wgFileExtensions && $j( targetElm ).attr( 'id' ) != 'wpUploadFileURL' ) {
			var found = false;
			if ( fname.lastIndexOf( '.' ) != -1 ) {
				var ext = fname.substr( fname.lastIndexOf( '.' ) + 1 );
				for ( var i = 0; i < wgFileExtensions.length; i++ ) {
					if ( wgFileExtensions[i].toLowerCase() == ext.toLowerCase() )
					found = true;
				}
			}
			if ( !found ) {
				// Clear the upload. Set mw-upload-permitted to error.
				$j( targetElm ).val( '' );
				$j( '#mw-upload-permitted,#mw-upload-prohibited' ).show().addClass( 'error' );
				$j( '#wpDestFile' ).val( '' );
				return false;
			}
		}
		// Capitalise first letter and replace spaces by underscores
		fname = fname.charAt( 0 ).toUpperCase().concat( fname.substring( 1, 10000 ) ).replace(/ /g, '_' );
		// Output result
		$j( '#wpDestFile' ).val( fname );

		// Do a destination check
		$j( '#wpDestFile' ).doDestCheck( {
			'warn_target': '#wpDestFile-warning'
		} );
	}
}

mw.ready( function() {
	mwUploadHelper.init();
} );