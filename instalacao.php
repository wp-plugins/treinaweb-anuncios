<?php

register_activation_hook( ARQ_PRINCIPAL, 'criar_tabelas_log');

function criar_tabelas_log() {
	
	global $wpdb;

	$nome_tabela = $wpdb->prefix . 'anuncios_log';

	$sql = 'CREATE TABLE ' . $nome_tabela .' (
		cod_log INT NOT NULL AUTO_INCREMENT,
		name_post varchar(500) NOT NULL,
		dt_hr datetime NOT NULL,
		UNIQUE KEY (cod_log)
	);';
	
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

	update_option('versao_tab_anuncio_log', V_TAB_ANUNCIO_LOG);
}
