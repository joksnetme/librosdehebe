<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usercp/">Mi Cuenta</a> &raquo;
    <a href="/usercp/compras/">Compras</a> &raquo;
    <a href="/usercp/compras/{id_compras}/detalles/">Detalles</a>
  </div>
  <h1>Detalles de la Compra</h1>
  <h2>-</h2>
  <div class="right bold compraFecha">{fecha}</div>
  <dl class="compras">
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
  </dl>
</div>
<div id="columnright">
   <div class="details">
      <ul class="comprasSubmenu">
         <li><a href="/usercp/compras/realizadas/">Compras Realizadas ({RealizadasNum})</a></li>
         <li><a href="/usercp/compras/finalizadas/">Compras Finalizadas ({FinalizadasNum})</a></li>
         <li><a href="/usercp/compras/pendientes/">Compras Pendientes ({PendientesNum})</a></li>
         <li><a href="/usercp/compras/pendientes/aprobacion/">Compras Pendientes de Aprobaci&oacute;n ({PendientesdeAprobacionNum})</a></li>
         <li><a href="/usercp/compras/rechazadas/">Compras Rechazadas ({RechazadasNum})</a></li>
      </ul>
   </div>
</div>