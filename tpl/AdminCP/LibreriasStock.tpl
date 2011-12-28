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

    $('table tbody tr td a.cambiar').addEvent('click', function()
    {
        if ( last !== null )
            last.removeClass('cambiarSelected');

        var pos = getAbsolutePos(this);
            pos.x -= 308;

        if ( window.ActiveXObject )
            pos.x += 8;

        $(this).addClass('cambiarSelected');

        var td = this.parentNode;
        var tr = td.parentNode;

        tdCantidad = tr.cells[ ( td.cellIndex - 1 ) ];

        var input = $('div#floatBox input#cantidad');
            input[0].value = tdCantidad.innerHTML;

        var box = $('div#floatBox');
            box.removeClass('hidden');
            box.setStyle({top: pos.y + 'px', left: pos.x + 'px'});

        $('div#floatBox form')[0].setAttribute('action', this.getAttribute('href'));

        last = $(this);

        return false;
    });

    $('div#floatBox form dl dd input.submit').addEvent('click', function()
    {
        var form     = this.parentNode.parentNode.parentNode;
        var action   = form.getAttribute('action');
        var cantidad = form.cantidad.value;

        DOMAssistant.AJAX.post(action + '?cantidad=' + cantidad, function()
        {
            closeBox();
            tdCantidad.innerHTML = cantidad;
        });

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
<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/librerias/">Librerias</a> &raquo;
    <a href="/admincp/librerias/{id_librerias}/">{nombre}</a> &raquo;
    <a href="/admincp/librerias/{id_librerias}/stock/">Stock</a>
  </div>
  <h1>Stock de Libros</h1>
  <h2></h2>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Cantidad</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.titulo}</td>
        <td>{each.autor}</td>
        <td class="center">{each.cantidad}</td>
        <td class="center"><a href="/admincp/librerias/{each.id_librerias}/stock/{each.id_libros}/cambiar/" class="cambiar">cambiar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
  <div id="floatBox" class="hidden">
    <h3>Cambiar Stock<a href="#">X</a></h3>
    <form action="" method="post">
      <dl>
        <dt><label for="cantidad">Nueva Cantidad</label></dt>
        <dd><input type="text" name="cantidad" id="cantidad" size="3" /> <input type="submit" name="submitStock" value="Cambiar" class="submit" /></dd>
      </dl>
    </form>
  </div>
</div>