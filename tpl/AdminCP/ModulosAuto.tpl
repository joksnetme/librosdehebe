<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/modulos/">M&oacute;dulos</a>
  </div>
  <h1>M&oacute;dulos</h1>
  <h2>Listado con todos los modulos disponibles.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>Estado de m&oacute;dulos actualizados.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <form action="/admincp/modulos/" method="post">
    <ul class="big list">
<!-- BEGIN each -->
      <li>
        <input type="checkbox" class="checkbox"
<!-- BEGIN checked -->
         checked="checked"
<!-- END checked -->
         name="{each.nombre}" id="{each.nombre}" value="1" />
        <label for="{each.nombre}">{each.label}</label>
      </li>
<!-- END each -->
    </ul>
    <dl>
      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" value="Guardar" />
        &oacute; <a href="/admincp/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>