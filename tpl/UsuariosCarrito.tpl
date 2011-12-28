<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/">Usuarios</a> &raquo;
    <a href="/usuarios/{id_usuarios}/">{nombre}</a> &raquo;
    <a href="/usuarios/{id_usuarios}/carrito/">Carrito de Compras</a>
  </div>
  <h1>Carrito de {nombre}</h1>
  <h2>Libros que {nombre} agrego al carrito.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>El libro fue agregado a la lista correctamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
<!-- BEGIN carrito -->
  <div class="book">
    <div class="left picture">
      <a href="/libros/{carrito.url}/"><img src="{carrito.imagen}" alt="" /></a>
    </div>
    <div class="left">
      <ul>
        <li><h3><a href="/libros/{carrito.url}/">{carrito.titulo}</a></h3></li>
        <li><span>Por <a href="/buscar/{carrito.autorUri}" title="{carrito.autor}">{carrito.autor}</a></span></li>
        <li><span>Publicado
<!-- BEGIN anho -->
        en {carrito.anho}
<!-- END anho -->
        por <a href="/buscar/{carrito.editorialUri}" title="{carrito.editorial}">{carrito.editorial}</a></span></li>
        <li><span>
<!-- BEGIN isbn -->
        ISBN {carrito.isbn},
<!-- END isbn -->
        {carrito.tomos} tomo{carrito.s}, {carrito.paginas} p&aacute;ginas</span></li>
      </ul>
    </div>
    <div class="clear"><!-- --></div>
  </div>
<!-- END carrito -->

<!-- BEGIN empty -->
  <div class="alert">
    <p class="message">{nombre} no tiene ning&uacute;n libro en el carrito.</p>
  </div>
<!-- END empty -->
</div>
<div id="columnright">
{random}
</div>