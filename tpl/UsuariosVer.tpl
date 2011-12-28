<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/">Usuarios</a> &raquo;
    <a href="/usuarios/{id_usuarios}/">{nombre}</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Perfil de usuario.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label><em>{nombre}</em> se actualiz&oacute; exitosamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <dl>
    <dt><label>Nombre</label></dt>
    <dd>{nombre}</dd>

    <dt><label>&Uacute;ltimo ingreso</label></dt>
    <dd>{ultimo}</dd>

<!-- BEGIN datos -->
    <dd class="only"><hr /></dd>

    <dd class="only">
      <p>Nota: Los siguientes datos son solo visibles por usted.</p>
    </dd>

    <!--
    <dd class="only">
      <h1 class="title">Datos de Env&iacute;o</h1>
    </dd>
      -->

    <dt><label>Pa&iacute;s</label></dt>
    <dd>{datos.pais}</dd>

    <dt><label>Estado/Provincia</label></dt>
    <dd>{datos.estado}</dd>

    <dt><label>Ciudad/Localidad</label></dt>
    <dd>{datos.ciudad}</dd>

    <dt><label>Direcci&oacute;n</label></dt>
    <dd>{datos.direccion}</dd>

    <dt><label>Tel&eacute;fono</label></dt>
    <dd>{datos.telefono}</dd>

    <dt><label>C&oacute;digo Postal</label></dt>
    <dd>{datos.cp}</dd>
<!-- END datos -->

<!-- BEGIN editable -->
    <dd class="only"><hr /></dd>
    <dd>
      <form action="/usuarios/{id_usuarios}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/usuarios/">Cancelar</a>
        </div>
      </form>
    </dd>
<!-- END editable -->
  </dl>
</div>
<div id="columnright">
{random}
</div>