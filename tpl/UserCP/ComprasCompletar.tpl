<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usercp/">Mi Cuenta</a> &raquo;
    <a href="/usercp/compras/">Compras</a>
  </div>
  <h1>Completar Comprobante de Pago</h1>
  <h2>-</h2>
  <form action="/usercp/compras/{idCompras}/completar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN comprobante_required -->
      <li><label for="comprobante">Falta el comprobante.</label></li>
<!-- END comprobante_required -->

<!-- BEGIN comprobante_rangeLength -->
      <li><label for="comprobante">El comprobante debe contener {digitos} digitos.</label></li>
<!-- END comprobante_rangeLength -->

<!-- BEGIN done -->
      <li><label>Los datos de env&iacute;o fueron actualizados correctamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="comprobante">Comprobante</label></dt>
      <dd>
        <input type="text" name="comprobante" id="comprobante" size="40" maxlength="100" value="{comprobante}" />
      </dd>
      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/usercp/compras/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>
<div id="columnright">
   <div class="details">
      <ul class="comprasSubmenu">
         <li{realizadasSelected}><a href="/usercp/compras/realizadas/">Compras Realizadas</a></li>
         <li{finalizadasSelected}><a href="/usercp/compras/finalizadas/">Compras Finalizadas</a></li>
         <li{pendientesSelected}><a href="/usercp/compras/pendientes/">Compras Pendientes</a></li>
         <li{pendientesaprobacionSelected}><a href="/usercp/compras/pendientes/aprobacion/">Compras Pendientes de Aprobaci&oacute;n</a></li>
         <li{pendientesrechazadasSelected}><a href="/usercp/compras/rechazadas/">Compras Rechazadas</a></li>
      </ul>
   </div>
</div>