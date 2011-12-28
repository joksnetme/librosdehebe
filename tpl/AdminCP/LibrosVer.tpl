<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/{id_libros}/">{titulo}</a>
  </div>
  <h1>{titulo}</h1>
  <h2>Viendo un libro de {autor} publicado en {anho} por {editorial}.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label><em>{titulo}</em> se actualiz&oacute; exitosamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <img src="/upl/libros/{id_libros}/250x330/i.jpg" alt="{titulo}" class="right" />
  <dl>
    <dt><label>ISBN</label></dt>
    <dd>{isbn}</dd>

    <dt><label>T&iacute;tulo</label></dt>
    <dd>{titulo}</dd>

    <dt><label>Autor</label></dt>
    <dd>{autor} (<a href="/admincp/autores/{id_autores}/">&raquo;</a>)</dd>

    <dt><label>A&ntilde;o</label></dt>
    <dd>{anho}</dd>

    <dt><label>Editorial</label></dt>
    <dd>{editorial} (<a href="/admincp/editoriales/{id_editoriales}/">&raquo;</a>)</dd>

    <dt><label>Tomos</label></dt>
    <dd>{tomos}</dd>

    <dt><label>P&aacute;ginas</label></dt>
    <dd>{paginas}</dd>

    <dt><label>Idioma</label></dt>
    <dd>{idioma}</dd>

<!-- BEGIN ifColeccion -->
      <dt><label>Colecci&oacute;n</label></dt>
<!-- BEGIN empty -->
      <dd>(sin colecci&oacute;n)</dd>
<!-- END empty -->
<!-- BEGIN full -->
      <dd>{coleccion} (<a href="/admincp/colecciones/{id_colecciones}/">&raquo;</a>)</dd>
<!-- END full -->
<!-- END ifColeccion -->

    <dt><label>Sinopsis</label></dt>
    <dd>{sinopsis}</dd>

    <dt><label>Precio</label></dt>
    <dd><span class="precio">u$s</span>{precio}</dd>

<!-- BEGIN controls -->
    <dd class="only"><hr /></dd>
<!-- END controls -->
  </dl>
<!-- BEGIN controls -->
  <div id="controls">
<!-- BEGIN prev -->
    <a href="/admincp/libros/{controls.prev.id_libros}/" id="prev">&laquo; {controls.prev.titulo}</a>
<!-- END prev -->
<!-- BEGIN next -->
    <a href="/admincp/libros/{controls.next.id_libros}/" id="next">{controls.next.titulo} &raquo;</a>
<!-- END next -->
  </div>
  <div class="clear"><!-- --></div>
<!-- END controls -->
  <dl>
    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/libros/{id_libros}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/libros/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>