<?php
/**
* Liquid Social Followers Widget
*
* @package Ave
*/
 
class Liquid_Social_Followers_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'ld_widget_social_icons', 'description' => esc_html__( "Display socials sites links", 'landinghub-core' ) );
		parent::__construct( 'social-followers', esc_html__( 'LiquidThemes: Social Site Links', 'landinghub-core' ), $widget_ops);

		$this-> alt_option_name = 'widget_social_followers';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget( $args, $instance ) {

		global $post;

		$cache = wp_cache_get('widget_social_followers', 'widget');

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		$social_one      = ! empty( $instance['social_one'] ) ? $instance['social_one'] : '';
		$social_one_link = ! empty( $instance['social_one_link'] ) ? $instance['social_one_link'] : '#';
		
		$social_two      = ! empty( $instance['social_two'] ) ? $instance['social_two'] : '';
		$social_two_link = ! empty( $instance['social_two_link'] ) ? $instance['social_two_link'] : '#';
		
		$social_three      = ! empty( $instance['social_three'] ) ? $instance['social_three'] : '';
		$social_three_link = ! empty( $instance['social_three_link'] ) ? $instance['social_three_link'] : '#';
		
		$social_four      = ! empty( $instance['social_four'] ) ? $instance['social_four'] : '';
		$social_four_link = ! empty( $instance['social_four_link'] ) ? $instance['social_four_link'] : '#';
		
		$social_five      = ! empty( $instance['social_five'] ) ? $instance['social_five'] : '';
		$social_five_link = ! empty( $instance['social_five_link'] ) ? $instance['social_five_link'] : '';


		ob_start();
		extract( $args );

		echo $before_widget; 
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	
	?>
	
	<?php if( !empty( $title ) ) { ?>
		<?php echo $before_title . esc_html( $title ) . $after_title;  ?>
	<?php } ?>
	
	<ul class="social-icon branded social-icon-shaped social-icon-circle social-icon-sm">
	
	<?php 
		if( !empty( $social_one ) ) {
		$icon = liquid_get_network_class( $social_one );
		$i_class = $icon['icon'];
		
	?>	
		<li>
			<a target="_blank" href="<?php echo esc_url( $social_one_link ) ?>">
				<i class="<?php echo $i_class ?>"></i>
			</a>
		</li>

	<?php 
		}
		if( !empty( $social_two ) ) {
		$icon = liquid_get_network_class( $social_two );
		$i_class = $icon['icon'];
		
	?>
		<li>
			<a target="_blank" href="<?php echo esc_url( $social_two_link ) ?>">
				<i class="<?php echo $i_class ?>"></i>
			</a>
		</li>
	
	<?php 
		}
		if( !empty( $social_three ) ) {
		$icon = liquid_get_network_class( $social_three );
		$i_class = $icon['icon'];
		
	?>
		<li>
			<a target="_blank" href="<?php echo esc_url( $social_three_link ) ?>">
				<i class="<?php echo $i_class ?>"></i>
			</a>
		</li>
		
	<?php 
		}
		if( !empty( $social_four ) ) {
		$icon = liquid_get_network_class( $social_four );
		$i_class = $icon['icon'];
		
	?>
		<li>
			<a target="_blank" href="<?php echo esc_url( $social_four_link ) ?>">
				<i class="<?php echo $i_class ?>"></i>
			</a>
		</li>
		
	<?php 
		}
		if( !empty( $social_five ) ) {
		$icon = liquid_get_network_class( $social_five );
		$i_class = $icon['icon'];
		
	?>
		<li>
			<a target="_blank" href="<?php echo esc_url( $social_five_link ) ?>">
				<i class="<?php echo $i_class ?>"></i>
			</a>
		</li>
	<?php } ?>
	</ul>

	<?php
		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_social_followers', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['social_one']      = strip_tags( $new_instance['social_one'] );
		$instance['social_one_link'] = strip_tags( $new_instance['social_one_link'] );
		
		$instance['social_two']      = strip_tags( $new_instance['social_two'] );
		$instance['social_two_link'] = strip_tags( $new_instance['social_two_link'] );
		
		$instance['social_three']      = strip_tags( $new_instance['social_three'] );
		$instance['social_three_link'] = strip_tags( $new_instance['social_three_link'] );
		
		$instance['social_four']      = strip_tags( $new_instance['social_four'] );
		$instance['social_four_link'] = strip_tags( $new_instance['social_four_link'] );
		
		$instance['social_five']      = strip_tags( $new_instance['social_five'] );
		$instance['social_five_link'] = strip_tags( $new_instance['social_five_link'] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_social_followers'] ) ) {

			delete_option('widget_social_followers');

		}
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_social_followers', 'widget' );
	}

	function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, array( 'social_one' => '', 'social_one_link' => '', 'social_two' => '', 'social_two_link' => '', 'social_three' => '', 'social_three_link' => '', 'social_four' => '', 'social_four_link' => '', 'social_five' => '', 'social_five_link' => '' ) );
		
		$socials = array(
			esc_html__( 'None', 'landinghub-core' )   => '',
			esc_html__( 'Behance', 'landinghub-core' )         => 'fa-behance',
			esc_html__( 'Behance Square', 'landinghub-core' )  => 'fa-behance-square',
			esc_html__( 'Codepen', 'landinghub-core' )         => 'fa-codepen',
			esc_html__( 'Deviantart', 'landinghub-core' )      => 'fa-deviantart',
			esc_html__( 'Digg', 'landinghub-core' )            => 'fa-digg',
			esc_html__( 'Dribbble', 'landinghub-core' )        => 'fa-dribbble',
			esc_html__( 'Facebook', 'landinghub-core' )        => 'fa-facebook',
			esc_html__( 'Facebook Square', 'landinghub-core' ) => 'fa-facebook-square',
			esc_html__( 'Flickr', 'landinghub-core' )          => 'fa-flickr',
			esc_html__( 'Github', 'landinghub-core' )         => 'fa-github',
			esc_html__( 'Google', 'landinghub-core' )         => 'fa-google',
			esc_html__( 'Google Plus', 'landinghub-core' )    => 'fa-google-plus',
			esc_html__( 'Instagram', 'landinghub-core' )      => 'fa-instagram',
			esc_html__( 'Jsfiddle', 'landinghub-core' )       => 'fa-jsfiddle',
			esc_html__( 'Line', 'landinghub-core' )       		=> 'fa-line',
			esc_html__( 'Linkedin', 'landinghub-core' )       => 'fa-linkedin',
			esc_html__( 'Medium', 'landinghub-core' )         => 'fa-medium',
			esc_html__( 'Paypal', 'landinghub-core' )         => 'fa-paypal',
			esc_html__( 'Pinterest', 'landinghub-core' )      => 'fa-pinterest',
			esc_html__( 'Pinterest P', 'landinghub-core' )    => 'fa-pinterest-p',
			esc_html__( 'Reddit', 'landinghub-core' )         => 'fa-reddit',
			esc_html__( 'Reddit Square', 'landinghub-core' )  => 'fa-reddit-square',
			esc_html__( 'Skype', 'landinghub-core' )          => 'fa-skype',
			esc_html__( 'Slack', 'landinghub-core' )          => 'fa-slack',
			esc_html__( 'Snapchat', 'landinghub-core' )       => 'fa-snapchat',
			esc_html__( 'Sound Cloud', 'landinghub-core' )    => 'fa-soundcloud',
			esc_html__( 'Spotify', 'landinghub-core' )        => 'fa-spotify',
			esc_html__( 'Stack Overflow', 'landinghub-core' ) => 'fa-stack-overflow',
			esc_html__( 'Telegram', 'landinghub-core' )       => 'fa-telegram',
			esc_html__( 'Trello', 'landinghub-core' )         => 'fa-trello',
			esc_html__( 'Tumblr', 'landinghub-core' )         => 'fa-tumblr',
			esc_html__( 'Twitch', 'landinghub-core' )         => 'fa-twitch',
			esc_html__( 'Twitter', 'landinghub-core' )        => 'fa-twitter',
			esc_html__( 'Twitter Square', 'landinghub-core' ) => 'fa-twitter-square',
			esc_html__( 'Vimeo', 'landinghub-core' )          => 'fa-vimeo',
			esc_html__( 'WhatsApp', 'landinghub-core' )      	=> 'fa-whatsapp',
			esc_html__( 'Wordpress', 'landinghub-core' )      => 'fa-wordpress',
			esc_html__( 'Youtube Play', 'landinghub-core' )   => 'fa-youtube-play',
		);
		
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';

		$social_one       = isset( $instance['social_one'] ) ? $instance['social_one'] : '';
		$social_one_link  = isset( $instance['social_one_link'] ) ? $instance['social_one_link'] : '#';

		$social_two       = isset( $instance['social_two'] ) ? $instance['social_two'] : '';
		$social_two_link  = isset( $instance['social_two_link'] ) ? $instance['social_two_link'] : '#';
		
		$social_three       = isset( $instance['social_three'] ) ? $instance['social_three'] : '';
		$social_three_link  = isset( $instance['social_three_link'] ) ? $instance['social_three_link'] : '#';
		
		$social_four       = isset( $instance['social_four'] ) ? $instance['social_four'] : '';
		$social_four_link  = isset( $instance['social_four_link'] ) ? $instance['social_four_link'] : '#';
		
		$social_five       = isset( $instance['social_five'] ) ? $instance['social_five'] : '';
		$social_five_link  = isset( $instance['social_five_link'] ) ? $instance['social_five_link'] : '#';
		

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'landinghub-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>"><?php esc_html_e( 'Social Site:', 'landinghub-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_one' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_one'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>"><?php esc_html_e( 'Social URL:', 'landinghub-core' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_one_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_one_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_one_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Site Link', 'landinghub-core' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two' ) ); ?>"><?php esc_html_e( 'Social Site - 2:', 'landinghub-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_two' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_two'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>"><?php esc_html_e( 'Social URL - 2:', 'landinghub-core' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_two_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_two_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_two_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Two Site Link', 'landinghub-core' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three' ) ); ?>"><?php esc_html_e( 'Social Site - 3:', 'landinghub-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_three' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_three'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>"><?php esc_html_e( 'Social URL - 3:', 'landinghub-core' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_three_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_three_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_three_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Three Site Link', 'landinghub-core' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_four' ) ); ?>"><?php esc_html_e( 'Social Site - 4:', 'landinghub-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_four' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_four' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_four'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_four_link' ) ); ?>"><?php esc_html_e( 'Social URL - 4:', 'landinghub-core' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_four_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_four_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_four_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Four Site Link', 'landinghub-core' ); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_five' ) ); ?>"><?php esc_html_e( 'Social Site - 5:', 'landinghub-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'social_five' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_five' ) ); ?>" class="widefat">
			<?php foreach( $socials as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $instance['social_five'], $value ); ?>><?php esc_html_e( $key ); ?></option>
			<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_five_link' ) ); ?>"><?php esc_html_e( 'Social URL - 5:', 'landinghub-core' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $instance['social_five_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_five_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'social_five_link' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Add Social Five Site Link', 'landinghub-core' ); ?></small>
		</p>

		<?php
	}
}