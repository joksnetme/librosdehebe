<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/editoriales/">Editoriales</a> &raquo;
    <a href="/admincp/editoriales/{id_editoriales}/">{nombre}</a> &raquo;
    <a href="/admincp/editoriales/{id_editoriales}/modificar/">Modificar</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Modificando editorial.</h2>
  <form action="/admincp/editoriales/{id_editoriales}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el nombre de la editorial. Ej: Editorial Universitaria de Buenos Aires</label></li>
<!-- END nombre_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" />
        <span>Ej: Editorial Universitaria de Buenos Aires</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_editoriales" id="id_editoriales" value="{id_editoriales}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/editoriales/{id_editoriales}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>