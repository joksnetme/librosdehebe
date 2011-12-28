<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
var getAbsolutePos = function( el )
{
    var SL = 0, ST = 0;
    var is_div = /^div$/i.test(el.tagName);

    if ( is_div && el.scrollLeft )
        SL = el.scrollLeft;
    if ( is_div && el.scrollTop )
        ST = el.scrollTop;

    var r = { x: el.offsetLeft - SL, y: el.offsetTop - ST };

    if ( el.offsetParent )
    {
        var tmp = getAbsolutePos(el.offsetParent);

        r.x += tmp.x;
        r.y += tmp.y;
    }

    return r;
}

DOMAssistant.DOMReady(function()
{
    var last = null;
    var tdCantidad;

    var values  = { };
    
    $('table tbody tr td a.cambiar').addEvent('click', function()
    {
        if ( last !== null )
            last.removeClass('cambiarSelected');

        var pos = getAbsolutePos(this);
            pos.x -= 348;

        if ( window.ActiveXObject )
            pos.x += 8;

        $(this).addClass('cambiarSelected');

        var box = $('div#floatBox');
            box.removeClass('hidden');
            box.setStyle({top: pos.y + 'px', left: pos.x + 'px'});

        var action = this.getAttribute('href');
        var form   = $('div#floatBox form')[0];
            form.setAttribute('action', action);

        last = $(this);
        
        if ( !last.hasClass('ingresar') )
        {
            if ( action in values )
                form.comprobante.value = values[action];
            else
            {
                DOMAssistant.AJAX.get(action + 'ajax/comprobante/', function( response )
                {
                    values[action] = form.comprobante.value = response;
                });
            }
        }
        
        form.comprobante.focus();

        return false;
    });

    var digitos = { };
    
    $('div#floatBox form dl dd input.submit').addEvent('click', function()
    {
        var form        = this.parentNode.parentNode.parentNode;
        var action      = form.getAttribute('action');
        var comprobante = form.comprobante.value;
        
        if ( action in digitos && digitos[action] != comprobante.length )
            alert("El comprobante debe tener " + digitos[action] + " digitos");

        else
        {
            DOMAssistant.AJAX.post(action + 'ajax/?comprobante=' + comprobante, function( response )
            {
                if ( response != 'ok' )
                {
                    digitos[action] = response;
                    alert("El comprobante debe tener " + response + " digitos");
                    form.comprobante.focus();
                }
                else
                {
                    values[action] = comprobante;
                    closeBox();
                    
                    if ( last.hasClass('ingresar') )
                        last.addClass('hidden');
                }
            });
        }

        return false;
    });

    var closeBox = function()
    {
        if ( last !== null )
            last.removeClass('cambiarSelected');

        $('div#floatBox').addClass('hidden');

        return false;
    };

    $('div#floatBox h3 a').addEvent('click', closeBox);
});
/*]]>*/
</script>

<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usercp/">Mi Cuenta</a> &raquo;
    <a href="/usercp/compras/">Compras</a>
  </div>
  <h1>Compras</h1>
  <h2>-</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>La compra fue generada correctamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->

 <table cellspacing="0" cellpadding="0">
 <thead>
   <tr>
      <th>Libros</th>
      <th>Precio</th>
      <th style="width: 120px;">Fecha</th>
      <th class="center" style="width: 60px;">
<!-- BEGIN cambiarComprobante -->
        Comp.
<!-- END cambiarComprobante -->
      </th>
      <th style="width: 20px;"></th>
   </tr>
 </thead>
 <tbody>
<!-- BEGIN compras -->
   <tr class="{compras.class}">
      <td>
        <ul>
<!-- BEGIN libros -->
            <li><a href="/libros/{compras.libros.url}/">{compras.libros.titulo}</a></li>
<!-- END libros -->
        </ul>
      </td>
      <td><span class="precio">u$s</span> {compras.precio}</td>
      <td>{compras.fecha}</td>
      <td>
<!-- BEGIN pendiente -->
        <a class="cambiar ingresar" href="/usercp/compras/{compras.id_compras}/completar/">completar</a>
<!-- END pendiente -->
<!-- BEGIN cambiarComprobante -->
        <a class="cambiar" href="/usercp/compras/{compras.id_compras}/completar/">cambiar</a>
<!-- END cambiarComprobante -->
      </td>
      <td><a href="/usercp/compras/{compras.id_compras}/detalles/">ver</a></td>
   </tr>
<!-- END compras -->
 </tbody>
 </table>
 <div id="floatBox" class="hidden large">
    <h3>Ingresar Comprobante de Pago<a href="#">X</a></h3>
    <form action="" method="post" class="comprasDigitos">
      <dl>
        <dt><label for="comprobante">Comprobante #</label></dt>
        <dd><input type="text" name="comprobante" id="comprobante" size="11" /> <input type="submit" name="submit" value="Guardar" class="submit" /></dd>
      </dl>
    </form>
  </div>
</div>
<div id="columnright">
   <div class="details">
      <ul class="comprasSubmenu">
         <li{realizadasSelected}><a href="/usercp/compras/realizadas/">Compras Realizadas ({RealizadasNum})</a></li>
         <li{finalizadasSelected}><a href="/usercp/compras/finalizadas/">Compras Finalizadas ({FinalizadasNum})</a></li>
         <li{pendientesSelected}><a href="/usercp/compras/pendientes/">Compras Pendientes ({PendientesNum})</a></li>
         <li{pendientesaprobacionSelected}><a href="/usercp/compras/pendientes/aprobacion/">Compras Pendientes de Aprobaci&oacute;n ({PendientesdeAprobacionNum})</a></li>
         <li{rechazadasSelected}><a href="/usercp/compras/rechazadas/">Compras Rechazadas ({RechazadasNum})</a></li>
      </ul>
   </div>
</div>