<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/condiciones/">Condiciones</a> &raquo;
    <a href="/admincp/condiciones/{id_condiciones}/">{condicion}</a> &raquo;
    <a href="/admincp/condiciones/{id_condiciones}/modificar/">Modificar</a>
  </div>
  <h1>Modificar {condicion}</h1>
  <h2>Modificar Condici&oacute;n</h2>
  <form action="/admincp/condiciones/{id_condiciones}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN condicion_required -->
      <li><label for="condicion">Ingrese la condici&oacute;n.</label></li>
<!-- END condicion_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="condicion">Condici&oacute;n</label></dt>
      <dd>
        <input type="text" name="condicion" id="condicion" size="59" maxlength="160" value="{condicion}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_condiciones" id="id_condiciones" value="{id_condiciones}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/condiciones/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>