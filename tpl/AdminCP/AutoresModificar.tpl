<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/autores/">Autores</a> &raquo;
    <a href="/admincp/autores/{id_autores}/">{nombre}</a> &raquo;
    <a href="/admincp/autores/{id_autores}/modificar/">Modificar</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Modificando autor.</h2>
  <form action="/admincp/autores/{id_autores}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el nombre del autor. Ej: William Shakespeare</label></li>
<!-- END nombre_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" />
        <span>Ej: William Shakespeare</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_autores" id="id_autores" value="{id_autores}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/autores/{id_autores}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>