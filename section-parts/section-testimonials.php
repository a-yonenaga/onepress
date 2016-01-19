<?php
$onepress_testimonial_id       = get_theme_mod( 'onepress_testimonial_id', __('testimonials', 'onepress') );
$onepress_testimonials_disable  = get_theme_mod( 'onepress_testimonials_disable' ) ==  1 ? true : false;
$onepress_testimonial_title    = get_theme_mod( 'onepress_testimonial_title', __('Testimonials', 'onepress' ));
$onepress_testimonial_subtitle = get_theme_mod( 'onepress_testimonial_subtitle', __('You are in good company!', 'onepress' ));
?>
<?php if ( ! $onepress_testimonials_disable  ) : ?>
<section id="<?php if ( $onepress_testimonial_id != '' ) echo $onepress_testimonial_id; ?>" class="<?php echo apply_filters( 'onepress_section_class', 'section-padding section-testimonials onepage-section section-inverse section-padding-lg', 'testimonials' ); ?>">
    <?php do_action( 'onperess_before_section_inner', 'testimonials' ); ?>
	<div class="container">

		<div class="section-title-area">
			<?php if ( $onepress_testimonial_subtitle != '' ) echo '<h5 class="section-subtitle">' . esc_html( $onepress_testimonial_subtitle ) . '</h5>'; ?>
			<?php if ( $onepress_testimonial_title != '' ) echo '<h2 class="section-title">' . esc_html( $onepress_testimonial_title ) . '</h2>'; ?>
		</div>

        <?php
        $testimonials = get_theme_mod( 'onepress_testimonial_boxes', '' );

        if ( is_string( $testimonials ) ) {
            $testimonials = json_decode( $testimonials, true );
        }

        if ( ! is_array( $testimonials ) || empty( $testimonials ) ) {
            $testimonials = array(
                array(
                    'title' 		=> __( 'Design Quality', 'onepress' ),
                    'name' 			=> __( 'Alexander Rios', 'onepress' ),
                    'subtitle' 		=> __( 'Founder & CEO', 'onepress' ),
                    'style'         => 'warning',
                    'image' 		=> array(
                        'url' => get_template_directory_uri() . '/assets/images/testimonial_1.jpg',
                        'id'  => ''
                    ),
                    'content' 		=> __( 'This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.', 'onepress' ),

                ),
                array(
                    'title' 		=> __( 'Feature Availability', 'onepress' ),
                    'name' 			=> __( 'Alexander Max', 'onepress' ),
                    'subtitle' 		=> __( 'Founder & CEO', 'onepress' ),
                    'style'         => 'success',
                    'image' 		=> array(
                        'url' => get_template_directory_uri() . '/assets/images/testimonial_2.jpg',
                        'id'  => ''
                    ),
                    'content' 		=> __( 'This card has supporting text below as a natural lead-in to additional content.', 'onepress' ),

                ),
                array(
                    'title' 		=> __( 'Customizability', 'onepress' ),
                    'name' 			=> __( 'Peter Mendez', 'onepress' ),
                    'subtitle' 		=> __( 'Example Company', 'onepress' ),
                    'style'         => 'theme-primary',
                    'image' 		=> array(
                        'url' => get_template_directory_uri() . '/assets/images/testimonial_3.jpg',
                        'id'  => ''
                    ),
                    'content' 		=> __( 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.', 'onepress' ),

                ),
            );
        }

        $rows  = array();
        $col = 3;

        ?>
        <div class="card-deck-wrapper">
            <?php
            $row_index = 0 ;
            foreach ( $testimonials as $testimonial ) {
                if ( ! isset( $rows[ $row_index ] ) ) {
                    $rows[ $row_index ] = array();
                }

                if ( count( $rows[ $row_index ] ) >=  $col ) {
                    $row_index ++ ;
                    $rows[ $row_index ] = array();
                }

                /// echo '<div class="card-deck">';

                $testimonial = wp_parse_args( $testimonial, array(
                    'title' 		=> '',
                    'name' 			=> '',
                    'subtitle' 		=> '',
                    'style'         => 'theme-primary',
                    'image' 		=> array(
                        'url' => '',
                        'id'  => ''
                    ),
                    'content' 		=> '',
                ) );

                $testimonial['image'] = wp_parse_args( $testimonial['image'], array( 'url' => '', 'id' => '' ) );
                $image = '';
                if ( $testimonial['image']['id'] != '' ){
                    $image =  wp_get_attachment_url( $testimonial['image']['id'] );
                }
                if ( $image == '' && $testimonial['image']['url'] != '' ) {
                    $image = $testimonial['image']['url'];
                }
                if ( $image == '' ){
                    $image = get_template_directory_uri().'/assets/images/testimonial_1.jpg';
                }

                $t = '';
                $t .= '<div class="card card-inverse card-'.esc_attr( $testimonial['style'] ).'">';
                    $t .= '<div class="card-block">';
                        $t .= '<div class="tes_author">';

                            if ( $image != '' ) {
                                $t .= '<img src="'.esc_url( $image ).'" alt="" />';
                            }
                            if ( $image != '' ) {
                                $t .= '<cite class="tes__name">'.esc_html( $testimonial['name'] ).'<div>'.wp_kses_post( $testimonial['subtitle'] ) .'</div></cite>';
                            }

                        $t .= ' </div>';

                        $t .='<h4 class="card-title">'.esc_html( $testimonial['title'] ).'</h4>';
                        $t .='<p class="card-text">'.wp_kses_post( $testimonial['content'] ) .'</p>';

                    $t .= ' </div>';
                $t .= ' </div>';

                $rows[ $row_index ][ ] =  $t;

            }

            foreach ( $rows as $r ) {
                echo '<div class="card-deck">';
                echo join( "\n\t", $r );
                echo '</div>';
            }

            ?>
        </div>
	</div>
    <?php do_action( 'onperess_after_section_inner', 'testimonials' ); ?>
</section>
<?php endif; ?>
