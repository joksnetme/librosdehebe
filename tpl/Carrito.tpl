<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/carrito/">Carrito de Compras</a>
  </div>
  <h1>Carrito de Compras</h1>
  <h2>Sus libros por comprar.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>Los articulos del carrito fueron actualizados correctamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
<!-- BEGIN hayLibros -->
  <form action="/carrito/" method="post">
<!-- BEGIN libros -->
  <div class="book">
    <div class="left picture">
      <a href="/libros/{hayLibros.libros.url}/"><img src="{hayLibros.libros.imagen}" alt="" /></a>
    </div>
    <div class="left">
      <ul>
        <li><h3><a href="/libros/{hayLibros.libros.url}/">{hayLibros.libros.titulo}</a></h3></li>
        <li><span>Por <a href="/buscar/{hayLibros.libros.autorUri}" title="{hayLibros.libros.autor}">{hayLibros.libros.autor}</a></span></li>
        <li><span>Publicado
<!-- BEGIN anho -->
        en {hayLibros.libros.anho}
<!-- END anho -->
        por <a href="/buscar/{hayLibros.libros.editorialUri}" title="{hayLibros.libros.editorial}">{hayLibros.libros.editorial}</a></span></li>
        <li><span>
<!-- BEGIN isbn -->
        ISBN {hayLibros.libros.isbn},
<!-- END isbn -->
        {hayLibros.libros.tomos} tomo{hayLibros.libros.s}, {hayLibros.libros.paginas} p&aacute;ginas</span></li>
      </ul>
    </div>
    <div class="right delete">
      <a href="/carrito/{hayLibros.libros.id_carrito}/borrar/">
        <img src="/img/cross.gif" alt="" />
      </a>
    </div>
    <div class="right precio">
      <span class="precio big">u$s</span> {hayLibros.libros.precio}
<!-- BEGIN ofertar -->
      <br /><br /> Tu oferta<br /> <span class="precio">u$s</span> <input type="text" name="oferta[{hayLibros.libros.id_carrito}]" value="{hayLibros.libros.oferta}" size="2" />
<!-- END ofertar -->
    </div>
    <div class="right precio">
<!-- BEGIN cantidades -->
        <input type="text" name="cantidad[{hayLibros.libros.id_carrito}]" value="{hayLibros.libros.cantidad}" size="1" />
<!-- END cantidades -->
    </div>
    <div class="clear"><!-- --></div>
  </div>
<!-- END libros -->
  <div class="book">
    <div class="right total envio">
<!-- BEGIN costoDeEnvio -->
    Costos de envio <span class="precio">u$s</span> {hayLibros.costoDeEnvio.costoEnvio}
    <span class="info">Basado en el m&eacute;todo de env&iacute;o con el costo m&aacute;s bajo disponible</span>
<!-- END costoDeEnvio -->
<!-- BEGIN noHayCosto -->
     No se encontraron costos de envio.
<!-- END noHayCosto -->
<!-- BEGIN noUserData -->
     Debe completar sus <a href="/usercp/datos/">datos de envio</a>.
<!-- END noUserData -->
    </div>
    <div class="clear"><!-- --></div>
  </div>

  <div class="book">
    <div class="right total envio">
      <strong>Total</strong>
      <span class="precio">u$s</span> {hayLibros.total}
    </div>
    <div class="clear"><!-- --></div>
  </div>

  <div class="book">
    <div class="spacer">
      <div class="right end">
        <input type="submit" name="submit" class="submit" value="Finalizar Compra" />
      </div>

<!-- BEGIN actualizar -->
      <div class="right total">
        <input type="submit" class="submit" value="Actualizar" />
      </div>
<!-- END actualizar -->
      <div class="clear"><!-- --></div>
    </div>
  </div>
  </form>
<!-- END hayLibros -->
<!-- BEGIN empty -->
  <div class="alert">
    <p class="message">Su carrito de compras no contiene ning&uacute;n libro. Efect&uacute;e una <a href="/buscar/">b&uacute;squeda</a> para a&ntilde;adir libros a su carrito.</p>
  </div>
  <p></p>
<!-- END empty -->
</div>