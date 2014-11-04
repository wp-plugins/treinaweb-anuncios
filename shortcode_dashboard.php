<?php

add_action( 'wp_dashboard_setup', 'anuncios_dashboard_cb' );

function anuncios_dashboard_cb() {

	wp_add_dashboard_widget(
		'anuncios_dashboard',         
		'Exibição de Anúncios',         
		'mostra_anuncios_dashboard_cb' 
    );	

}


function mostra_anuncios_dashboard_cb() {

	global $wpdb;

	$nome_tabela = $wpdb->prefix . 'anuncios_log';

	$anuncios = $wpdb->get_results("SELECT name_post, count(*) as t_cada FROM {$nome_tabela} group by name_post order by t_cada desc");
	
	echo "<table>";
	foreach ($anuncios as $anuncio) {
		echo "<tr>";
	 	echo "<td>{$anuncio->name_post}: </td><td><strong>{$anuncio->t_cada}</strong></td>";
	 	echo "</tr>";
	 } 					 

	 $anuncios = $wpdb->get_row("SELECT count(*) as total FROM {$nome_tabela}");

	 echo "<tr><td><strong>Total: </strong></td> <td><strong>{$anuncios->total}</strong></td> </tr>";

	 echo "</table>";
}

add_shortcode( 'tw_anuncios', 'tw_anuncios_cb' );

function tw_anuncios_cb( $atts, $content, $tag ){

	exibe_anuncios('post', 1);

}
