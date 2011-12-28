<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/condiciones/">Condiciones</a> &raquo;
    <a href="/admincp/condiciones/agregar/">Agregar</a>
  </div>
  <h1>Agregar Condici&oacute;n</h1>
  <h2>Agregar Condici&oacute;n</h2>
  <form action="/admincp/condiciones/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN condicion_required -->
      <li><label for="condicion">Ingrese la condici&oacute;n.</label></li>
<!-- END condicion_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="condicion">Condici&oacute;n</label></dt>
      <dd><input type="text" name="condicion" id="condicion" size="59" maxlength="160" value="{condicion}" /></dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Agregar" />
        &oacute; <a href="/admincp/condiciones/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>