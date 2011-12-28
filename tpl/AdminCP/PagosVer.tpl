<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/pagos/">Pagos</a> &raquo;
    <a href="/admincp/pagos/{id_pagos}/">{nombre}</a>
  </div>
  <h1>Pagos</h1>
  <h2>Pagos</h2>
  <dl>
    <dt><label>Nombre</label></dt>
    <dd>{nombre}</dd>
    
    <dt><label>Digitos</label></dt>
    <dd>{digitos}</dd>
    
<!-- BEGIN meta -->
    <dt><label>{meta.metaName}</label></dt>
    <dd>{meta.metaValue}</dd>
<!-- END meta -->
    <dd class="only"><hr /></dd>
    <dd>
        <form action="/admincp/pagos/{id_pagos}/modificar/" method="post">
          <div>
            <input type="hidden" name="id_pagos"  value="{id_pagos}" />
            <input type="submit" class="submit" value="Modificar" />
            &oacute; <a href="/admincp/pagos/">Cancelar</a>
        </div>
        </form>
    </dd>
  </dl>
</div>