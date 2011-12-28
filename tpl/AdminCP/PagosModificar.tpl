<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/pagos/">Pagos</a> &raquo;
    <a href="/admincp/pagos/{id_pagos}/">{nombre}</a>
    <a href="/admincp/pagos/{id_pagos}/modificar/">Modificar</a>
  </div>
  <h1>Modificar Pago</h1>
  <h2>Modificar Pago</h2>
  <form action="/admincp/pagos/{id_pagos}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese el Nombre.</label></li>
<!-- END nombre_required -->
<!-- BEGIN digitos_required -->
      <li><label for="digitos">Ingrese la cantidad de Digitos.</label></li>
<!-- END digitos_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd><input type="text" name="nombre" id="nombre" size="59" maxlength="160" value="{nombre}" /></dd>
      
      <dt><label for="digitos">Digitos</label></dt>
      <dd><input type="text" name="digitos" id="digitos" size="5" maxlength="3" value="{digitos}" /></dd>

      <dd class="only"><hr /></dd>
      
<!-- BEGIN meta -->
      <dt><input type="text" name="metaName[{meta.i}]" value="{meta.name}" class="metaName" size="12" /></dt>
      <dd>
        <input type="text" name="metaValue[{meta.i}]" value="{meta.value}" size="30" />
        <input type="image" name="delMeta[{meta.i}]" src="/img/cross.gif" class="delMeta" />
      </dd>
<!-- END meta -->

      <dt><label for="addMeta">Meta</label></dt>
      <dd><input type="submit" name="addMeta" id="addMeta" value="Agregar" /></dd>
      
      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/pagos/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>