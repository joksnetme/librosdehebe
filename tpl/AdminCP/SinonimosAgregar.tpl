<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/sinonimos/">Sin&oacute;nimos</a> &raquo;
    <a href="/admincp/sinonimos/agregar/">Agregar</a>
  </div>
  <h1>Agregar Sin&oacute;nimo</h1>
  <h2>Complete la palabra y su sin&oacute;nimo en min&uacute;sculas.</h2>
  <form action="/admincp/sinonimos/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN palabra_required -->
      <li><label for="palabra">Ingrese la palabra. Ej: autro</label></li>
<!-- END palabra_required -->
<!-- BEGIN sinonimo_required -->
      <li><label for="sinonimo">Ingrese su sin&oacute;nimo. Ej: autor</label></li>
<!-- END sinonimo_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="palabra">Palabra</label></dt>
      <dd>
        <input type="text" name="palabra" id="palabra" size="59" maxlength="160" value="{palabra}" />
        <span>Ej: autro</span>
      </dd>
      <dt><label for="sinonimo">Sin&oacute;nimo</label></dt>
      <dd>
        <input type="text" name="sinonimo" id="sinonimo" size="59" maxlength="160" value="{sinonimo}" />
        <span>Ej: autor</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/sinonimos/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>