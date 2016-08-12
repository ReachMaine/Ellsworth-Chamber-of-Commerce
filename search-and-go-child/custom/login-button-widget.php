<?php
/**
 * Example Widget Class
 */
class zlogin_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function zlogin_widget() {
        parent::WP_Widget(false, $name = 'zigs Login Button Widget');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    /* when widget is displayed on front end. */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>


          <?php global $user_ID;
            global $current_user;
            get_currentuserinfo();
            if('' == $user_ID){   
              //echo "Not Logged in";
              echo do_shortcode('[eltd_button size="medium" type="outline" text="Sign In" custom_class="" icon_pack="font_awesome" fa_icon="" link="'.wp_login_url().'" target="_self" ]');
              /* echo '<a href="'.get_bloginfo('url').'/wp-admin/" class="eltd-mobile-login-icon eltd-login-opener">' . search_and_go_elated_icon_collections()->renderIcon( 'lnr-users', 'linear_icons' ).'</a>'; */
            } else { ?>
              <div class="eltd-logged-in-user">
                <span>
                <?php 
                //echo $current_user->display_name;
                 echo do_shortcode('[eltd_button size="medium" type="outline" text="'.$current_user->display_name.'" custom_class="" icon_pack="font_awesome" fa_icon="" link="'.(wp_logout_url( $_SERVER["REQUEST_URI"] )).'" target="_self" ]');
                  ?>
                </span>
              </div>
            <?php } ?>

          <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    /*  backend form */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Simple Message'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>
        <?php 
    }
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("zlogin_widget");'));
?>