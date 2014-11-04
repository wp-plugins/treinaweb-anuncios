<?php

function exibe_anuncios($tipo_entrada, $quantidade){

		global $wpdb;
		$nome_tabela = $wpdb->prefix . 'anuncios_log';
		$agora = date("Y-m-d h:i:s");
		$i = 0;

		$anuncios = new WP_Query( 
			array( 
				'post_type' => 'anuncio',
				'orderby' => 'rand'
			 )
		); 

		while ( $anuncios->have_posts() ) : $anuncios->the_post(); 

			$tipo_anuncio = get_post_meta($anuncios->post->ID, 'tipo_anuncio', true);
			$link_anuncio = get_post_meta($anuncios->post->ID, 'link_anuncio', true);

			if (!empty($link_anuncio) && $tipo_anuncio == $tipo_entrada && $i < $quantidade) {
				$imagem_id = get_post_thumbnail_id();

				$imagem_url = wp_get_attachment_url( $imagem_id );

				echo '<a href="' . $link_anuncio .'" target="_blank">';
				echo '<img src="' . $imagem_url . '" style="margin-top: 5px;" />';
				echo '</a>';


				$wpdb->insert( 
					$nome_tabela, 
					array(
						'name_post' => $anuncios->post->post_title,
						'dt_hr' => $agora,
						),
					array( 
						'%s',
						'%s'
					)
				);					
				
				$i++;
			}

		endwhile;

}
