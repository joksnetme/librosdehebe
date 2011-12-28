<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/amigos/">Amigos</a> &raquo;
    <a href="/admincp/amigos/{id_amigos}/">{de_nombre} a {para_nombre}</a>
  </div>
  <h1>Amigos</h1>
  <h2>Ver mensaje de recomendaci&oacute;n de {de_nombre} para {para_nombre}.</h2>
  <dl>
    <dt><label>De</label></dt>
<!-- BEGIN is_usuario -->
    <dd>{de} (<a href="/usuarios/{id_usuarios}/">&raquo;</a>)</dd>
<!-- END is_usuario -->
<!-- BEGIN is_not_usuario -->
    <dd>{de}</dd>
<!-- END is_not_usuario -->

    <dt><label>Para</label></dt>
    <dd>{para}</dd>

    <dt><label>Libro</label></dt>
    <dd>{libro} (<a href="/admincp/libros/{id_libros}/">&raquo;</a>)</dd>

    <dt><label>Mensaje</label></dt>
    <dd>{mensaje}</dd>

    <dt><label>Fecha</label></dt>
    <dd>{fecha}</dd>
  </dl>
</div>