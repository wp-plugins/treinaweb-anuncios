<?php

add_action('init', 'registrar_anuncio_post_type');

function registrar_anuncio_post_type() {

	$descritivos = array(
		'name' => 'Anúncios',
		'singular_name' => 'Anúncio',
		'add_new' => 'Adicionar Novo Anúncio',
		'add_new_item' => 'Adicionar Anúncio',
		'edit_item' => 'Editar Anúncio',
		'new_item' => 'Novo Anúncio',
		'view_item' => 'Ver Anúncio',
		'search_items' => 'Procurar Anúncio',
		'not_found' =>  'Nenhum Anúncio encontrado',
		'not_found_in_trash' => 'Nenhum Anúncio na Lixeira',
		'parent_item_colon' => '',
		'menu_name' => 'Anúncios'
	);

	$args = array(
		'labels' => $descritivos,  
		'public' => true,  
		'hierarchical' => false,  
		'menu_position' => 5,  
		'supports' => array('title', 'thumbnail') 
	);
 
	register_post_type( 'anuncio' , $args );
	flush_rewrite_rules();

}

add_action( 'add_meta_boxes', 'add_metabox_tipo_anuncio' );

function add_metabox_tipo_anuncio() {
	add_meta_box( 
		'tipo_anuncio', 
		'Tipos de Anúncio', 
		'mb_tipo_anuncio_cb', 
		'anuncio', 
		'side', 
		'default' 
	);

	add_meta_box( 
		'link_anuncio', 
		'Link Anúncio', 
		'mb_link_anuncio_cb', 
		'anuncio', 
		'side', 
		'default' 
	);

}

function mb_tipo_anuncio_cb() {
	global $post;
      
    $tipo_anuncio = get_post_meta($post->ID, 'tipo_anuncio', true); 

    require_once('includes/metabox-tipo.php');
}

function mb_link_anuncio_cb() {
	global $post;
      
    $link_anuncio = get_post_meta($post->ID, 'link_anuncio', true); 

    require_once('includes/metabox-link.php');	
}

add_action('save_post', 'salvar_metas_anuncio');

function salvar_metas_anuncio(){
    global $post;  

    $tipo_anuncio = isset( $_POST['tipo_anuncio'] ) ? $_POST['tipo_anuncio'] : '';
    $link_anuncio = isset( $_POST['link_anuncio'] ) ? $_POST['link_anuncio'] : '';

    $post_id = isset( $post->ID ) ? $post->ID : '';

    update_post_meta($post_id, 'tipo_anuncio', sanitize_text_field( $tipo_anuncio ) );
    update_post_meta($post_id, 'link_anuncio', sanitize_text_field( $link_anuncio ) );
}
