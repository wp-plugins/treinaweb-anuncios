<?php

//Arquivo responsável pela criação do Widget

add_action( 'widgets_init', 'registrar_widget_anuncios' );

function registrar_widget_anuncios() {

    register_widget( 'anuncio_Widget' );

}

class anuncio_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'anuncio_Widget', 
			'Exibir Anúncios', 
			array( 'description' => 'Exibe 3 anúncios cadastrados' ) 
		);
	}

	public function form( $instance ) {

		$titulo = isset( $instance[ 'titulo' ] ) ? $instance[ 'titulo' ] : '';

		require_once('includes/widget-form.php');

	}

	public function widget( $args, $instance ) {

	 	echo $args['before_widget'];
		
		if ( ! empty( $instance['titulo'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['titulo'] ). $args['after_title'];
		}

		exibe_anuncios('normal', 3);

		echo $args['after_widget'];
	}	

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['titulo']      = ( ! empty( $new_instance['titulo'] ) ) ? strip_tags( $new_instance['titulo'] ) : '';


		return $instance;
	}

}
