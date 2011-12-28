<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/librerias/">Librerias</a> &raquo;
    <a href="/admincp/librerias/agregar/">Agregar</a>
  </div>
  <h1>Agregar Libreria</h1>
  <h2>Agregar Libreria.</h2>
  <form action="/admincp/librerias/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el nombre de la libreria.</label></li>
<!-- END nombre_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" />
        <span>Ej: Libros de Hebe</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Agregar" />
        &oacute; <a href="/admincp/librerias/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>