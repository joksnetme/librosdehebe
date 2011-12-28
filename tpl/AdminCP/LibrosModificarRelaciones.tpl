<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/{id_libros}/">{titulo}</a> &raquo;
    <a href="/admincp/libros/{id_libros}/modificar/">Modificar</a> &raquo;
    <a href="/admincp/libros/{id_libros}/modificar/{relacionUri}/">{relacionNombre}</a>
  </div>
  <h1>{titulo}</h1>
  <h2>Modificando un libro de {autor} publicado en {anho} por {editorial}.</h2>
  <form action="/admincp/libros/{id_libros}/modificar/{relacionUri}/" method="post">
    <dl>
<!-- BEGIN relaciones -->
      <dt><label>{relacionNombrePrural}</label></dt>
      <dd class="input">
        <ul class="checkboxs">
<!-- BEGIN relacion -->
          <li>
            <input type="radio" class="checkbox"
<!-- BEGIN checked -->
             checked="checked"
<!-- END checked -->
             name="relacion" id="r{relaciones.relacion.value}" value="{relaciones.relacion.value}" />
            <label for="r{relaciones.relacion.value}">{relaciones.relacion.name}</label>
          </li>
<!-- END relacion -->
        </ul>
        <div class="clear"><!-- --></div>
      </dd>
<!-- END relaciones -->

      <dd>
        <input type="radio" class="checkbox" name="relacion" id="relacion" value="new" />
        <label for="relacion">Agregar</label>
        <input type="text" name="relacionNombre" id="relacionNombre" value="" size="36" maxlength="96" />
         como {relacionNombre}
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_libros" id="id_libros" value="{id_libros}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/libros/{id_libros}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>