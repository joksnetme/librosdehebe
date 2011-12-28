<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
    DOMAssistant.DOMReady(function(){
        $('form dl.envios dt input').addEvent('click', function(){
            
            var booksPrice = parseFloat($('span#booksPrice')[0].innerHTML);
            
            var dt = this.parentNode;
            var dd = dt.nextSibling.nextSibling;
            
            var precio = dd.getElementsByTagName('span')[0].nextSibling;
                precio = parseFloat(precio.nodeValue.replace(/^\s+|\s+$/g, ''));
                
            var total = Math.round((precio + booksPrice) * 10) / 10;
            
            $('span#finalPrice')[0].innerHTML = total;
        });
    });
/*]]>*/
</script>
<div class="finalizarCarrito">
  <div class="line">
    <ul>
        <li class="first">1. Carrito</li>
        <li class="previous">2. Informaci&oacute;n</li>
        <li class="active">3. Forma de Pago y Env&iacute;o</li>
        <li class="last">4. Revisar y Realizar el Pedido</li>
    </ul>
    <div class="clear"><!-- --></div>
  </div>
</div>
<div id="columnleft">
  <form action="/carrito/finalizar/{id_compras}/2/" method="post" class="pagos">
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
    <h1 class="title">Forma de Pago</h1>
    <dl>
<!-- BEGIN pagos -->
        <dt class="center"><input type="radio" name="pago" value="{pagos.id_pagos}" id="pago{pagos.id_pagos}"{pagos.checked} /></dt>
        <dd><label for="pago{pagos.id_pagos}">{pagos.nombre}</label></dd>
<!-- END pagos -->
    </dl>
    <h1 class="title">Medios de Env&iacute;o</h1>
    <dl class="envios">
<!-- BEGIN envios -->
        <dt class="center"><input type="radio" name="envios" value="{envios.id_envios}" id="envios{envios.id_envios}"{envios.checked} /></dt>
        <dd class="option">
            <label for="envios{envios.id_envios}">{envios.nombre} ({envios.entrega} d&iacute;as laborables)</label>
            <div><span class="precio">u$s</span> {envios.precio}</div>
        </dd>
        <dd class="only clear"><!-- --></dd>
<!-- END envios -->
        <dd class="only">
            <hr />
        </dd>
        <dd class="only">
            <div class="column"><span class="precio">u$s</span> <span id="booksPrice">{booksPrice}</span></div>
            <div class="column">Total por {bookCount} libros</div>
            <div class="clear"><!-- --></div>
        </dd>
        <dd class="only">
            <hr />
        </dd>
        
        <dd class="only">
            <div class="column"><span class="precio">u$s</span> <span id="finalPrice">{finalPrice}</span></div>
            <div class="column">Final</div>
            <div class="clear"><!-- --></div>
        </dd>
        <dd class="only">
            <hr />
        </dd>
        
        <dd class="submit">
            <input type="submit" class="submit" name="submit" value="Continuar" />
        </dd>
    </dl>
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
</div>
