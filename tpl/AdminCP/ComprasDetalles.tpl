<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/compras/">Compras</a> &raquo;
    <a href="/usercp/compras/{id_compras}/detalles/">Detalles</a>
  </div>
  <h1>Detalles de la Compra</h1>
  <h2>-</h2>
  <div class="right bold compraFecha">{fecha}</div>
  <dl class="compras compras-adm">
    <dd class="only comprasDetalles">
      <p>{nombre}</p>
      <p>{direccion1} {direccion2}</p>
      <p>{cp} {ciudad}, {estado}, {pais}</p>
      <p>Tel: +{codigo_area} {telefono}</p>
    </dd>
    <dd class="only"><hr /></dd>
    <dt><label>Estado</label></dt>
    <dd>{estadoCompra}</dd>
    <dt><label>Forma de pago</label></dt>
    <dd>{pago}</dd>
    <dt><label>Medio de envio</label></dt>
    <dd class="comprasPrecios">
      <div class="right"><span class="precio">u$s</span> {precioEnvio}</div>
      {envio}
      <div class="clear"><!-- --></div>
    </dd>
    <dd class="only"><hr /></dd>
    <dd class="only">
      <h3 class="libros">Libros</h3>
<!-- BEGIN libros -->
  <div class="book">
    <div class="left picture">
      <a href="/libros/{libros.url}/"><img src="{libros.imagen}" alt="" /></a>
    </div>
    <div class="left">
      <ul>
        <li><h3><a href="/libros/{libros.url}/">{libros.titulo}</a></h3></li>
        <li><span>Por <a href="/buscar/{libros.autorUri}" title="{libros.autor}">{libros.autor}</a></span></li>
        <li><span>Publicado
<!-- BEGIN anho -->
        en {libros.anho}
<!-- END anho -->
        por <a href="/buscar/{libros.editorialUri}" title="{libros.editorial}">{libros.editorial}</a></span></li>
        <li><span>
<!-- BEGIN isbn -->
        ISBN {libros.isbn},
<!-- END isbn -->
        {libros.tomos} tomo{libros.s}, {libros.paginas} p&aacute;ginas</span></li>
      </ul>
    </div>
    <div class="right precio">
      <big>{libros.cantidad}</big> x <span class="precio big">u$s</span> {libros.precio}
<!-- BEGIN precioOferta -->
        <br />(original {libros.precioOferta.precioOriginal})
<!-- END precioOferta -->
    </div>
    <div class="clear"><!-- --></div>
  </div>
<!-- END libros -->
      <div class="right precio bold">
        Total <span class="precio">u$s</span> {precioTotal}
      </div>
      <div class="clear"><!-- --></div>
    </dd>
    <dd class="only"><hr /></dd>
    <dd class="submit">
    <form action="/admincp/compras/{id_compras}/detalles/" method="post">
      <div class="right">
<!-- BEGIN aprobarRechazar -->
        <input type="submit" name="aprobar" class="submit" value="Aprobar" />
        <input type="submit" name="rechazar" class="submit" value="Rechazar" />
<!-- END aprobarRechazar -->
<!-- BEGIN enviar -->
        <input type="submit" name="enviar" class="submit" value="Enviar" />
<!-- END enviar -->
      </div>
    </form>
    </dd>
  </dl>
</div>