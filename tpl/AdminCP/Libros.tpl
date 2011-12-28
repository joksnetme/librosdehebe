<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a>
  </div>
  <h1>Libros</h1>
  <h2>Agregar y modificar libros</h2>
  <form action="/admincp/libros/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN error -->
      <li><label>La b&uacute;squeda realizada no gener&oacute; resultados.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
    <dl>
      <dd class="only"><input type="text" name="query" id="query" size="60" /></dd>
      <dd class="only">
        <input type="submit" class="submit" value="Obtener Libro" />
        &oacute; <a href="/admincp/libros/all/">Listar Todos</a>
        &oacute; <a href="/admincp/libros/agregar/">Agregar</a>
      </dd>
    </dl>
  </form>
</div>
<div id="columnright">
  <h2>Informes</h2>
  <ul>
    <li><a href="/admincp/libros/sinprecios/">Libros sin Precios</a></li>
    <li><a href="/admincp/libros/sintapas/">Libros sin Tapas</a></li>
    <li><a href="/admincp/libros/sinanho/">Libros sin A&ntilde;o</a></li>
<!--BEGIN ifColeccion -->
    <li><a href="/admincp/libros/sincoleccion/">Libros sin Colecc&oacute;n</a></li>
<!--END ifColeccion -->
  </ul>
</div>