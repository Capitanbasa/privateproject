<?php

class bt_bb_latest_posts extends BT_BB_Element {
	function native_resize($url, $width, $height = null, $crop = null, $single = true) {
		//validate inputs
		if (!$url OR !$width)
			return false;
		//define upload path & dir
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];
		//check if $img_url is local
		if (strpos($url, $upload_url) === false)
			return false;
		//define path of image
		$rel_path = str_replace($upload_url, '', $url);
		$img_path = $upload_dir . $rel_path;
		//check if img path exists, and is an image indeed
		if (!file_exists($img_path) OR !getimagesize($img_path))
			return false;
		//get image info
		$info = pathinfo($img_path);
		$ext = $info['extension'];
		list($orig_w, $orig_h) = getimagesize($img_path);
		//get image size after cropping
		$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
		$dst_w = $dims[4];
		$dst_h = $dims[5];
		//use this to check if cropped image already exists, so we can return that instead
		$suffix = "{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace('.' . $ext, '', $rel_path);
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
		if (!$dst_h) {
		//can't resize, so return original url
			$img_url = $url;
			$dst_w = $orig_w;
			$dst_h = $orig_h;
		}
		//else check if cache exists
		elseif (file_exists($destfilename) && getimagesize($destfilename)) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		}
		//else, we resize the image and return the new resized image url
		else {
		// Note: pre-3.5 fallback check
			if (function_exists('wp_get_image_editor')) {
				$editor = wp_get_image_editor($img_path);
				if (is_wp_error($editor) || is_wp_error($editor->resize($width, $height, $crop)))
					return false;
				$resized_file = $editor->save();
				if (!is_wp_error($resized_file)) {
					$resized_rel_path = str_replace($upload_dir, '', $resized_file['path']);
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return false;
				}
			} else {
				$resized_img_path = image_resize($img_path, $width, $height, $crop);
				if (!is_wp_error($resized_img_path)) {
					$resized_rel_path = str_replace($upload_dir, '', $resized_img_path);
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return false;
				}
			}
		}
		//return the output
		if ($single) {
		//str return
			$image = $img_url;
		} else {
		//array return
			$image = array(
				0 => $img_url,
				1 => $dst_w,
				2 => $dst_h
			);
		}
		return $image;
	}

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'rows'            => '',
			'columns'         => '',
			'gap'             => '',
			'category'        => '',
			'target'          => '',
			'image_shape'     => '',
			'show_category'   => '',
			'show_date'       => '',
			'show_author'     => '',
			'show_comments'   => '',
			'show_excerpt'    => ''
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}	
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . $el_id . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . $el_style . '"';
		}
		
		if ( $columns != '' ) {
			$class[] = $this->prefix . 'columns' . '_' . $columns;
		}
		
		if ( $gap != '' ) {
			$class[] = $this->prefix . 'gap' . '_' . $gap;
		}
		
		if ( $image_shape != '' ) {
			$class[] = $this->prefix . 'image_shape' . '_' . $image_shape;
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$number = $rows * $columns;
		
		$posts = bt_bb_get_posts( $number, 0, $category );
		
		$output = '';

		foreach( $posts as $post_item ) {

			$output .= '<div class="' . $this->shortcode . '_item">';
				$post_thumbnail_id = get_post_thumbnail_id( $post_item['ID'] );

				if ( $post_thumbnail_id != '' ) {
					$img = wp_get_attachment_image_src( $post_thumbnail_id, $size = 'medium' );
					$img_src = $img[0];
					$img_src_native = $this->native_resize($img[0],300,300, true ,true);
					$output .= '<div class="' . $this->shortcode . '_item_image"><img src="' . $img_src_native . '" alt="' . $post_item['title'] . '" title="' . $post_item['title'] . '"></div>';
				}

				$output .= '<div class="' . $this->shortcode . '_item_content">';
				
					if ( $show_category == 'show_category' ) {
						$output .= '<div class="' . $this->shortcode . '_item_category">';
							$output .= $post_item['category_list'];
						$output .= '</div>';
					}

					if ( $show_date == 'show_date' || $show_author == 'show_author' || $show_author == 'show_comments' ) {
				
						$meta_output = '<div class="' . $this->shortcode . '_item_meta">';

							if ( $show_date == 'show_date' ) {
								$meta_output .= '<span class="' . $this->shortcode . '_item_date">';
									$meta_output .= get_the_date( '', $post_item['ID'] );
								$meta_output .= '</span>';
							}

							if ( $show_author == 'show_author' ) {
								$meta_output .= '<span class="' . $this->shortcode . '_item_author">';
									$meta_output .= esc_html__( 'by', 'bold-builder' ) . ' ' . $post_item['author'];
								$meta_output .= '</span>';
							}

							if ( $show_comments == 'show_comments' && $post_item['comments'] != '' ) {
								$meta_output .= '<span class="' . $this->shortcode . '_item_comments">';
									$meta_output .= $post_item['comments'];
								$meta_output .= '</span>';
							}
				
						$meta_output .= '</div>';
		
						$output .= $meta_output;
		
					}

					$output .= '<h5 class="' . $this->shortcode . '_item_title">';
						$output .= '<a href="' . $post_item['permalink'] . '" target="' . $target . '">' . $post_item['title'] . '</a>';
					$output .= '</h5>';
					
					if ( $show_excerpt == 'show_excerpt' ) {
						$output .= '<div class="' . $this->shortcode . '_item_excerpt">';
							$output .= $post_item['excerpt'];
						$output .= '</div>';
					}
				$output .= '</div>';
				
			$output .= '</div>';
		}

		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Latest Posts', 'bold-builder' ), 'description' => esc_html__( 'List of latest posts', 'bold-builder' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'rows', 'type' => 'textfield', 'value' => '1', 'heading' => esc_html__( 'Rows', 'bold-builder' ), 'preview' => true ),
				array( 'param_name' => 'columns', 'type' => 'dropdown', 'value' => '3', 'heading' => esc_html__( 'Columns', 'bold-builder' ), 'preview' => true,
					'value' => array(
						__( '1', 'bold-builder' ) => '1',
						__( '2', 'bold-builder' ) => '2',
						__( '3', 'bold-builder' ) => '3',
						__( '4', 'bold-builder' ) => '4',
						__( '6', 'bold-builder' ) => '6'
					)
				),
				array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'bold-builder' ), 'preview' => true,
					'value' => array(
						__( 'Normal', 'bold-builder' ) => 'normal',
						__( 'No gap', 'bold-builder' ) => 'no_gap',
						__( 'Small', 'bold-builder' ) => 'small',
						__( 'Large', 'bold-builder' ) => 'large'
					)
				),				
				array( 'param_name' => 'category', 'type' => 'textfield', 'heading' => esc_html__( 'Category', 'bold-builder' ), 'description' => esc_html__( 'Enter category slug or leave empty to show all', 'bold-builder' ), 'preview' => true ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'bold-builder' ),
					'value' => array(
						__( 'Self (open in same tab)', 'bold-builder' ) => '_self',
						__( 'Blank (open in new tab)', 'bold-builder' ) => '_blank',
					)
				),
				array( 'param_name' => 'image_shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Image shape', 'bold-builder' ),
					'value' => array(
						__( 'Square', 'bold-builder' ) => 'square',
						__( 'Rounded', 'bold-builder' ) => 'rounded',
						__( 'Round', 'bold-builder' ) => 'round'
					)
				),
				array( 'param_name' => 'show_category', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bold-builder' ) => 'show_category' ), 'heading' => esc_html__( 'Show category', 'bold-builder' ), 'preview' => true
				),
				array( 'param_name' => 'show_date', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bold-builder' ) => 'show_date' ), 'heading' => esc_html__( 'Show date', 'bold-builder' ), 'preview' => true
				),
				array( 'param_name' => 'show_author', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bold-builder' ) => 'show_author' ), 'heading' => esc_html__( 'Show author', 'bold-builder' ), 'preview' => true
				),
				array( 'param_name' => 'show_comments', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bold-builder' ) => 'show_comments' ), 'heading' => esc_html__( 'Show number of comments', 'bold-builder' ), 'preview' => true
				),
				array( 'param_name' => 'show_excerpt', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'bold-builder' ) => 'show_excerpt' ), 'heading' => esc_html__( 'Show excerpt', 'bold-builder' ), 'preview' => true
				)
			)
		) );
	} 
}