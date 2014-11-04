<label for="tipo_anuncio">Tipo de anúncio: </label>
<select name="tipo_anuncio" id="tipo_anuncio">
	<option <?= selected( esc_attr( $tipo_anuncio ), 'normal'); ?> value="normal">Normal</option>
	<option <?= selected( esc_attr( $tipo_anuncio ), 'post'); ?>value="post">Post</option>
</select>
<p><strong>Normal</strong> exibe no widget <br/><strong>Post</strong> exibe através do Shortcode dentro</p>
