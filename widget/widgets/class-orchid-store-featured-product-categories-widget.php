<?php
/**
 * Display Featured Product Categories Widget Class
 *
 * @package Orchid_Store
 */

if ( ! class_exists( 'Orchid_Store_Featured_Product_Categories_Widget' ) ) {
	/**
	 * Widget class - Orchid_Store_Featured_Product_Categories_Widget.
	 *
	 * @since 1.0.0
	 *
	 * @package orchit_store
	 */
	class Orchid_Store_Featured_Product_Categories_Widget extends WP_Widget {

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
				'orchid-store-featured-product-categories-widget',
				esc_html__( 'OS: Featured Product Categories', 'orchid-store' ),
				array(
					'classname'   => '',
					'description' => esc_html__( 'Displays featured product categories.', 'orchid-store' ),
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

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$product_categories = isset( $instance['product_categories'] ) ? $instance['product_categories'] : array();

			$display_products_count = isset( $instance['display_products_count'] ) ? true : false;

			if ( ! empty( $product_categories ) ) {
				?>
				<section class="cats-widget-styles cats-widget-style-1 section-spacing">
					<div class="section-inner">
						<div class="__os-container__">
							<div class="cats-widget-entry">
								<div class="os-row">
									<?php
									foreach ( $product_categories as $product_category ) {

										$category_term = '';

										if ( 'slug' === $this->value_as ) {

											$category_term = get_term_by( 'slug', $product_category, 'product_cat' );
										} else {

											$category_term = get_term_by( 'id', absint( $product_category ), 'product_cat' );
										}

										$term_img_url = '';

										if ( ! empty( $category_term ) ) {

											$thumbnail_id = get_term_meta( $category_term->term_id, 'thumbnail_id', true );
											$image_url    = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

											if ( ! empty( $image_url ) ) {

												$term_img_url = $image_url[0];

											} else {

												$term_img_url = wc_placeholder_img_src();
											}
											?>
											<div class="os-col">
												<div class="card wow osfadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
													<div class="box">
														<div class="left">
															<div class="thumb">
																<a href="<?php echo esc_url( get_term_link( $category_term->term_id, 'product_cat' ) ); ?>">
																	<img src="<?php echo esc_url( $term_img_url ); ?>" alt="<?php echo esc_attr( $category_term->name ); ?>">
																</a>
															</div><!-- // thumb -->
														</div><!-- // left -->
														<div class="right">
															<div class="title">
																<h3>
																	<a href="<?php echo esc_url( get_term_link( $category_term->term_id, 'product_cat' ) ); ?>">
																		<?php echo esc_html( $category_term->name ); ?>
																	</a>
																</h3>
															</div><!-- .title -->
															<?php
															if ( $display_products_count ) {
																?>
																<div class="product-numbers">
																	<p>
																		<?php
																		printf(
																			/* translators: %s: products count */
																			wp_kses_post( _n( '%s Product', '%s Products', $category_term->count, 'orchid-store' ) ),
																			'<span class="count">' .
																			esc_html( number_format_i18n( $category_term->count ) ) . '</span>'
																		);
																		?>
																		
																	</p>
																</div><!-- // product-numbers -->
																<?php
															}
															?>
														</div><!-- .right -->
													</div><!-- box -->
												</div><!-- // card -->
											</div><!-- .col -->
											<?php
										}
									}
									?>
								</div><!-- .row -->
							</div><!-- .cats-widget-entry -->
						</div><!-- .__os-container__ -->
					</div><!-- .section-inner -->
				</section><!-- .cats-widget-styles.cats-widget-style-1.section-spacing -->
				<?php
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

			$instance['title'] = isset( $instance['title'] ) ? $instance['title'] : '';

			$instance['product_categories'] = isset( $instance['product_categories'] ) ? $instance['product_categories'] : array();

			$instance['display_products_count'] = isset( $instance['display_products_count'] ) ? true : false;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
				>   
			</p>

			<p>
				<span class="sldr-elmnt-title">
					<strong><?php esc_html_e( 'Product Categories', 'orchid-store' ); ?></strong>
				</span>
				<span class="sldr-elmnt-desc">
					<?php esc_html_e( 'Below are the list of product categories. Check on a category to set is as a filter item.', 'orchid-store' ); ?>
				</span>

				<span class="widget_multicheck">
				<?php

				$product_categories = orchid_store_all_product_categories();

				if ( ! empty( $product_categories ) ) {

					if ( 'slug' === $this->value_as ) {
						foreach ( $product_categories as $index => $product_category ) {
							?>
							<span class="sldr-elmnt-cntnr">
								<label for="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>">
									<input
										id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>"
										name="<?php echo esc_attr( $this->get_field_name( 'product_categories' ) ); ?>[]"
										type="checkbox"
										value="<?php echo esc_attr( $product_category->slug ); ?>" 
										<?php
										if ( ! empty( $instance['product_categories'] ) ) {
											checked( in_array( $product_category->slug, $instance['product_categories'], true ), true ); }
										?>
									>
									<strong><?php echo esc_html( $product_category->name ); ?></strong>
								</label>
							</span><!-- .sldr-elmnt-cntnr -->
							<?php
						}
					} else {
						foreach ( $product_categories as $index => $product_category ) {
							?>
							<span class="sldr-elmnt-cntnr">
								<label for="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>">
									<input
										id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) . $product_category->term_id ); ?>"
										name="<?php echo esc_attr( $this->get_field_name( 'product_categories' ) ); ?>[]"
										type="checkbox"
										value="<?php echo esc_attr( $product_category->term_id ); ?>" 
										<?php
										if ( ! empty( $instance['product_categories'] ) ) {
											checked( in_array( $product_category->term_id, $instance['product_categories'], true ), true ); }
										?>
									>
									<strong><?php echo esc_html( $product_category->name ); ?></strong>
								</label>
							</span><!-- .sldr-elmnt-cntnr -->
							<?php
						}
					}
				} else {
					?>
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'product_categories' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'product_categories' ) ); ?>[]"
						type="hidden"
						value="" checked
					>
					<small>
						<?php echo esc_html__( 'There are no product categories to select.', 'orchid-store' ); ?>
					</small>
					<?php
				}
				?>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_products_count' ) ); ?>">
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'display_products_count' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'display_products_count' ) ); ?>"
						type="checkbox" <?php checked( true, $instance['display_products_count'] ); ?>
					/>
					<strong><?php esc_html_e( 'Display Products Count', 'orchid-store' ); ?></strong>
				</label>                 
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
				$instance['product_categories'] = isset( $new_instance['product_categories'] ) ? array_map( 'sanitize_text_field', $new_instance['product_categories'] ) : array();
			} else {
				$instance['product_categories'] = isset( $new_instance['product_categories'] ) ? array_map( 'absint', $new_instance['product_categories'] ) : array();
			}

			$instance['display_products_count'] = isset( $new_instance['display_products_count'] ) ? true : false;

			return $instance;
		}
	}
}
