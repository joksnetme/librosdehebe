<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/{id_libros}/">{titulo}</a> &raquo;
    <a href="/admincp/libros/{id_libros}/tapas/">Tapas</a>
  </div>
  <h1>{titulo}</h1>
  <h2>Modificando las tapas del libro {titulo}.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>Tapas actualizadas correctamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <ul class="tapas">
<!-- BEGIN tapas -->
    <li>
        <a href="/admincp/libros/{id_libros}/tapas/{tapas.rom}/borrar/" onclick="return confirm('Esta seguro que desea borrar esta tapa?');">
          <img src="{tapas.src}" alt="" />
          <span class="center">Borrar</span>
        </a>
    </li>
<!-- END tapas -->
  </ul>
  <div class="clear"><!-- --></div>
  <form action="/admincp/libros/{id_libros}/tapas/" method="post" enctype="multipart/form-data">
    <dl>
      <dt><label for="tapa">Tapa</label></dt>
      <dd>
        <input type="file" name="tapa" id="tapa" size="60" />
      </dd>
      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_libros" id="id_libros" value="{id_libros}" />
        <input type="submit" class="submit" name="save" value="Subir Tapas" />
        &oacute; <a href="/admincp/libros/{id_libros}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>