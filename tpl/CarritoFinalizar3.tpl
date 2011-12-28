<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
  
/*]]>*/
</script>
<div class="finalizarCarrito">
  <div class="line">
    <ul>
        <li class="first">1. Carrito</li>
        <li>2. Informaci&oacute;n</li>
        <li class="previous">3. Forma de Pago y Env&iacute;o</li>
        <li class="active">4. Revisar y Realizar el Pedido</li>
    </ul>
    <div class="clear"><!-- --></div>
  </div>
</div>
<div id="columnleft">
  <form action="/carrito/finalizar/{id_compras}/3/" method="post" class="pagos">
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN pago_required -->
    <li><label>Seleccoine una forma de pago.</label></li>
<!-- END pago_required -->
<!-- BEGIN envios_required -->
    <li><label>Seleccione un metodo de envio.</label></li>
<!-- END envios_required -->
  </ul>
<!-- END validation -->
  <h1 class="title">Confirmar Compra</h1>
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
    <div class="right precio cantidadOferta">
      <span class="cantidad big">{libros.cantidad}</span> x <span class="precio big">u$s</span> {libros.precio}
    </div>
    <div class="clear"><!-- --></div>
  </div>
<!-- END libros -->
  <div class="book">
    <div class="right total envio">
        Costo de env&iacute;o <span class="precio">u$s</span> {costoEnvio}
    </div>
    <div class="clear"><!-- --></div>
  </div>
  <div class="book">
    <div class="right total envio">
        Final <span class="precio">u$s</span> <strong>{costoFinal}</strong>
    </div>
    <div class="clear"><!-- --></div>
  </div>
  <div class="book">
    <div class="right total envio">
        <input type="submit" name="submit" value="Comprar" class="submit" />
    </div>
    <div class="clear"><!-- --></div>
  </div>
  </form>
</div>
<div id="columnright">
    <div class="details finalizar">
        <h2>Datos de Env&iacute;o</h2>
        <dl>
            <dt>Pa&iacute;s</dt>
            <dd>{pais}</dd>
            <dt>Provincia</dt>
            <dd>{estado}</dd>
            <dt>Ciudad</dt>
            <dd>{ciudad}</dd>
            <dt>Nombre</dt>
            <dd>{nombre}</dd>
            <dt>Direcci&oacute;n</dt>
            <dd>{direccion1}</dd>
            <dd>{direccion2}</dd>
            <dt>C&oacute;digo de Area</dt>
            <dd>{codigo_area}</dd>
            <dt>Tel&eacute;fono</dt>
            <dd>{telefono}</dd>
            <dt>C&oacute;digo Postal</dt>
            <dd>{cp}</dd>
            <dd class="only change"><a href="/carrito/finalizar/{id_compras}/">Cambiar</a></dd>
        </dl>
    </div>
    <div class="details finalizar">
        <h2>Forma de Pago y Env&iacute;o</h2>
        <dl>
            <dt>Forma de Pago</dt>
            <dd>{pago}</dd>
            <dt>Medio de env&iacute;o</dt>
            <dd>{envio}<span class="precio">u$s</span>{envioPrecio}</dd>
            <dd>{entrega} d&iacute;as laborales</dd>
            <dd class="only change"><a href="/carrito/finalizar/{id_compras}/2/">Cambiar</a></dd>
        </dl>
    </div>
</div>
