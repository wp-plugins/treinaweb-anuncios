<p>
	<label for="<?= $this->get_field_id( 'titulo' ); ?>">Título</label> 
	<input class="widefat" 
		id="<?= $this->get_field_id( 'titulo' ); ?>" name="<?= $this->get_field_name( 'titulo' ); ?>" 
		type="text" value="<?= esc_attr( $titulo ); ?>"
	/>
</p>
