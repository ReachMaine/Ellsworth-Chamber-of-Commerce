<?php 
/* languages customizations 
*/
	if ( !function_exists('eai_change_theme_text') ){
		function eai_change_theme_text( $translated_text, $text, $domain ) {
			 /* if ( is_singular() ) { */
			    switch ( $translated_text ) {

		            case 'Category' :
		                //$translated_text = __( '',  $domain  );
		                break;
		            case 'Previous post':
		            	$translated_text = __( 'Previous',  $domain  );
		            	break;
		            case 'Next post':
		            	$translated_text = __( 'Next',  $domain  );
		            	break;
		            /* case 'Share this post:':
		            	$translated_text = __('Share', ' $domain );
		            	break; */
		        }
		    /* } */

	    	return $translated_text;
		}
		add_filter( 'gettext', 'eai_change_theme_text', 20, 3 );
	}

?>