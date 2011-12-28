<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/colecciones/">Colecciones</a> &raquo;
    <a href="/admincp/colecciones/{id_colecciones}/">{nombre}</a> &raquo;
    <a href="/admincp/colecciones/{id_colecciones}/modificar/">Modificar</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Modificando colecci&oacute;n.</h2>
  <form action="/admincp/colecciones/{id_colecciones}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el nombre de la colecci&oacute;n. Ej: El pozo de Siquem</label></li>
<!-- END nombre_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" />
        <span>Ej: El pozo de Siquem</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_colecciones" id="id_colecciones" value="{id_colecciones}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/colecciones/{id_colecciones}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>