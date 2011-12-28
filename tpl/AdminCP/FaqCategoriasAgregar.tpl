<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a> &raquo;
    <a href="/admincp/faq/categorias/">Categorias</a> &raquo;
    <a href="/admincp/faq/categorias/agregar/">Agregar</a>
  </div>
  <h1>Agregar Categoria</h1>
  <h2>...de Preguntas Frecuentes.</h2>
  <form action="/admincp/faq/categorias/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el nombre de la categoria.</label></li>
<!-- END nombre_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/faq/categorias/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>