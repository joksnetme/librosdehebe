<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/librerias/">Librerias</a> &raquo;
    <a href="/admincp/librerias/{id_librerias}/">{nombre}</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Viendo libreria.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>La libreria fu&eacute; modificada exitosamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <dl>
    <dt><label>Nombre</label></dt>
    <dd>{nombre}</dd>

    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/librerias/{id_librerias}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/librerias/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>