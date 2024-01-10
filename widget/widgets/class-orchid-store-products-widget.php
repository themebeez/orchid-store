<?php
/**
 * Products Widget Class
 *
 * @package Orchid_Store
 */

if ( ! class_exists( 'Orchid_Store_Products_Widget' ) ) {
	/**
	 * Widget class - Orchid_Store_Products_Widget.
	 *
	 * @since 1.0.0
	 *
	 * @package orchit_store
	 */
	class Orchid_Store_Products_Widget extends WP_Widget {

		/**
		 * Slug or id.
		 *
		 * @var string
		 */
		public $value_as;


		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'orchid-store-products-widget',
				esc_html__( 'OS: Products', 'orchid-store' ),
				array(
					'classname'   => '',
					'description' => esc_html__( 'Displays products.', 'orchid-store' ),
				)
			);

			$this->value_as = orchid_store_get_option( 'value_as' );
		}


		/**
		 * Renders widget at the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Provides the HTML you can use to display the widget title class and widget content class.
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function widget( $args, $instance ) {

			$title            = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$product_category = isset( $instance['product_category'] ) ? $instance['product_category'] : '';
			$no_of_products   = isset( $instance['no_of_products'] ) ? $instance['no_of_products'] : 4;
			$products_by      = isset( $instance['products_by'] ) ? $instance['products_by'] : 'default';
			$display_layout   = isset( $instance['display_layout'] ) ? $instance['display_layout'] : 'slider';

			$hide_out_of_stock_products = isset( $instance['hide_out_of_stock_products'] ) ? $instance['hide_out_of_stock_products'] : false;

			$order = isset( $instance['order'] ) ? $instance['order'] : 'DESC';

			$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'ID';

			$product_query_args = array(
				'post_type' => 'product',
				'order'     => $order,
				'orderby'   => $orderby,
			);

			if ( $no_of_products > 0 ) {
				$product_query_args['posts_per_page'] = $no_of_products;
			} else {
				$product_query_args['posts_per_page'] = 4;
			}

			if ( '0' !== $product_category ) {
				if ( 'slug' === $this->value_as ) {
					$product_query_args['tax_query'] = array( // phpcs:ignore
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $product_category,
						),
					);
				} else {
					$product_query_args['tax_query'] = array( // phpcs:ignore
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => $product_category,
						),
					);
				}
			}

			switch ( $products_by ) {

				case 'rated':
					$product_query_args['meta_key']   = '_wc_average_rating'; // phpcs:ignore
					$product_query_args['orderby']    = 'meta_value_num';
					$product_query_args['meta_query'] = WC()->query->get_meta_query(); // phpcs:ignore

					break;

				case 'featured':
					$product_query_args['tax_query'][] = array(

						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'AND',
					);

					break;

				case 'onsale':
					$product_query_args['meta_key']     = '_sale_price'; // phpcs:ignore
					$product_query_args['meta_value']   = '0'; // phpcs:ignore
					$product_query_args['meta_compare'] = '>='; // phpcs:ignore

					break;

				default:
					break;
			}

			if ( $hide_out_of_stock_products ) {

				$product_query_args['meta_query'][] = array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => '!=',
				);
			}

			$product_query = new WP_Query( $product_query_args );

			if ( $product_query->have_posts() ) {

				$mobile_cols_no = get_theme_mod( 'orchid_store_field_product_cols_in_mobile', 1 );

				$mobile_col_class = 'os-mobile-col-' . $mobile_cols_no;

				if ( 'grid' === $display_layout ) {
					?>
					<section class="product-widget product-widget-style-1 section-spacing">
						<div class="section-inner">
							<div class="__os-container__">
								<div class="widget-entry">
									<?php
									if ( ! empty( $title ) ) {
										?>
										<div class="section-title">
											<h2><?php echo esc_html( $title ); ?></h2>
										</div><!-- .section-title -->
										<?php
									}
									?>
									<div class="product-entry">
										<div class="woocommerce columns-4 <?php echo esc_attr( $mobile_col_class ); ?>">
											<ul class="products">
												<?php
												while ( $product_query->have_posts() ) {

													$product_query->the_post();

													wc_get_template_part( 'content', 'product' );
												}

												woocommerce_reset_loop();

												wp_reset_postdata();
												?>
											</ul>
										</div><!-- .woocommerce.columns-4 -->
									</div><!-- .product-entry -->
								</div><!-- .widget-entry -->
							</div><!-- .__os-container__ -->
						</div><!-- .section-inner -->
					</section><!-- .product-widget.product-widget-style-1.section-spacing -->
					<?php
				}

				if ( 'slider' === $display_layout ) {
					?>
					<section class="product-widget product-widget-style-3 section-spacing">
						<div class="section-inner">
							<div class="__os-container__">
								<?php
								if ( ! empty( $title ) ) {
									?>
									<div class="section-title">
										<h2><?php echo esc_html( $title ); ?></h2>
									</div>
									<?php
								}
								?>
								<div class="product-entry">
									<div class="owl-carousel owl-carousel-2">
										<?php
										while ( $product_query->have_posts() ) {

											$product_query->the_post();
											?>
											<div class="item">
												<div class="woocommerce columns-1 <?php echo esc_attr( $mobile_col_class ); ?>">
													<ul class="products">
														<?php wc_get_template_part( 'content', 'product' ); ?>
													</ul>
												</div><!-- .woocommerce.columns-1 -->
											</div>
											<?php
										}
										woocommerce_reset_loop();

										wp_reset_postdata();
										?>
									</div><!-- .owl-carousel -->
								</div><!-- .product-entry -->
							</div><!-- .__os-container__ -->
						</div><!-- .section-inner -->
					</section><!-- .product-widget -->
					<?php
				}
			}
		}


		/**
		 * Adds setting fields to the widget and renders them in the form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function form( $instance ) {

			$defaults = array(
				'title'                      => '',
				'product_category'           => '',
				'no_of_products'             => 4,
				'products_by'                => 'default',
				'display_layout'             => 'slider',
				'hide_out_of_stock_products' => false,
				'order'                      => 'DESC',
				'orderby'                    => 'ID',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'product_category' ) ); ?>">
					<strong><?php esc_html_e( 'Product Category', 'orchid-store' ); ?></strong>
				</label>
				<?php
				$dropdown_args = array(
					'taxonomy'        => 'product_cat',
					'show_option_all' => esc_html__( 'Select Category', 'orchid-store' ),
					'name'            => $this->get_field_name( 'product_category' ),
					'id'              => $this->get_field_id( 'product_category' ),
					'class'           => 'widefat',
					'hide_empty'      => 1,
					'selected'        => isset( $instance['product_category'] ) ? $instance['product_category'] : '',
				);

				if ( 'slug' === $this->value_as ) {
					$dropdown_args['value_field'] = 'slug';
				} else {
					$dropdown_args['value_field'] = 'term_id';
				}

				wp_dropdown_categories( $dropdown_args );
				?>
				<span class="sldr-elmnt-desc"><?php esc_html_e( 'If no category is selected, then latest products are displayed.', 'orchid-store' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_products' ) ); ?>">
					<strong><?php esc_html_e( 'No of Products', 'orchid-store' ); ?></strong>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_products' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_of_products' ) ); ?>" type="number" value="<?php echo esc_attr( absint( $instance['no_of_products'] ) ); ?>" />   
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'products_by' ) ); ?>">
					<strong><?php esc_html_e( 'Products By', 'orchid-store' ); ?></strong>
				</label>
				<?php
				$product_types = array(
					'default'  => esc_html__( 'None', 'orchid-store' ),
					'rated'    => esc_html__( 'Rated', 'orchid-store' ),
					'featured' => esc_html__( 'Featured', 'orchid-store' ),
					'onsale'   => esc_html__( 'On Sale', 'orchid-store' ),
				);
				?>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'products_by' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'products_by' ) ); ?>">
					<?php
					foreach ( $product_types as $key => $value ) {
						?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $instance['products_by'] ); ?>><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'hide_out_of_stock_products' ) ); ?>">
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'hide_out_of_stock_products' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'hide_out_of_stock_products' ) ); ?>"
						type="checkbox" <?php checked( true, $instance['hide_out_of_stock_products'] ); ?>
					/>  
					<strong><?php esc_html_e( 'Hide Products Out of Stock', 'orchid-store' ); ?></strong>
				</label>                 
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php echo esc_html__( 'Order', 'orchid-store' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
					<?php foreach ( $this->get_order_options() as $value => $label ) { ?>
						<option 
							value="<?php echo esc_attr( $value ); ?>"
							<?php selected( $value, $instance['order'] ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php } ?>
				</select>                 
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php echo esc_html__( 'Order By', 'orchid-store' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="widefat">
					<?php foreach ( $this->get_orderby_options() as $value => $label ) { ?>
						<option 
							value="<?php echo esc_attr( $value ); ?>"
							<?php selected( $value, $instance['orderby'] ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php } ?>
				</select>                 
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_layout' ) ); ?>">
					<strong><?php esc_html_e( 'Display Layout', 'orchid-store' ); ?></strong>
				</label>
				<?php
				$product_types = array(
					'slider' => esc_html__( 'Slider', 'orchid-store' ),
					'grid'   => esc_html__( 'Grid', 'orchid-store' ),
				);
				?>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'display_layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_layout' ) ); ?>">
					<?php
					foreach ( $product_types as $key => $value ) {
						?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $instance['display_layout'] ); ?>><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<?php
		}


		/**
		 * Sanitizes and saves the instance of the widget.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance The settings for the new instance of the widget.
		 * @param array $old_instance The settings for the old instance of the widget.
		 * @return array Sanitized instance of the widget.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';

			if ( 'slug' === $this->value_as ) {
				$instance['product_category'] = isset( $new_instance['product_category'] ) ? sanitize_text_field( $new_instance['product_category'] ) : '';
			} else {
				$instance['product_category'] = isset( $new_instance['product_category'] ) ? absint( $new_instance['product_category'] ) : '';
			}

			$instance['no_of_products'] = isset( $new_instance['no_of_products'] ) ? absint( $new_instance['no_of_products'] ) : 4;

			$instance['products_by'] = isset( $new_instance['products_by'] ) ? sanitize_text_field( $new_instance['products_by'] ) : 'default';

			$instance['display_layout'] = isset( $new_instance['display_layout'] ) ? sanitize_text_field( $new_instance['display_layout'] ) : 'slider';

			$instance['hide_out_of_stock_products'] = isset( $new_instance['hide_out_of_stock_products'] ) ? true : false;

			$instance['order'] = ( isset( $new_instance['order'] ) && array_key_exists( $new_instance['order'], $this->get_order_options() ) ) ? sanitize_text_field( $new_instance['order'] ) : 'DESC';

			$instance['orderby'] = ( isset( $new_instance['orderby'] ) && array_key_exists( $new_instance['orderby'], $this->get_orderby_options() ) ) ? sanitize_text_field( $new_instance['orderby'] ) : 'ID';

			return $instance;
		}


		/**
		 * Function to get order options
		 *
		 * @return array.
		 */
		public function get_order_options() {

			return array(
				'ASC'  => esc_html__( 'ASC', 'orchid-store' ),
				'DESC' => esc_html__( 'DESC', 'orchid-store' ),
			);
		}


		/**
		 * Function to get orderby options
		 *
		 * @return array.
		 */
		public function get_orderby_options() {

			return array(
				'none'       => esc_html__( 'None', 'orchid-store' ),
				'ID'         => esc_html__( 'ID', 'orchid-store' ),
				'title'      => esc_html__( 'Title', 'orchid-store' ),
				'name'       => esc_html__( 'Name', 'orchid-store' ),
				'date'       => esc_html__( 'Date', 'orchid-store' ),
				'menu_order' => esc_html__( 'Menu Order', 'orchid-store' ),
				'rand'       => esc_html__( 'Random', 'orchid-store' ),
			);
		}
	}
}
