<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/tapas/">Tapas</a>
  </div>
  <h1>Tapas</h1>
  <h2>Subir todas las tapas a la vez.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>Proceso por lotes finalizado con &eacute;xito.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <form action="/admincp/libros/tapas/" method="post">
    <dl>
      <dd>
        <p>Recordar que en la carpeta deben haber imagenes <acronym title="Joint Photographic Experts Group">JPG</acronym> que el nombre de archivo sea el <abbr title="Identification">ID</abbr> de Libro. Si lleva m&aacute;s de una imagen deben tener al final del nombre la posici&oacute;n en n&uacute;meros romanos minusculas.</p>
        <span>Ej: 1.jpg, 2.jpg, 3i.jpg, 3ii.jpg, 3iii.jpg, 4.jpg, 5.jpg</span>
      </dd>

      <dt><label for="delete">Eliminar archivos</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="delete" id="delete" value="1" />
      </dd>

      <dt><label for="path">Ruta</label></dt>
      <dd>
        <input type="text" name="path" id="path" size="59" maxlength="160" value="/upl/batch/" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Subir Tapas" />
        &oacute; <a href="/admincp/libros/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>