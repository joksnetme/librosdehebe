<div class="admin-compras">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/compras/">Compras</a>
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
      <th>Comprobante</th>
      <th style="width: 120px;">Fecha</th>
      <th>Usuario</th>
      <th>Pais</th>
      <th style="width: 20px;"></th>
   </tr>
 </thead>
 <tbody>
<!-- BEGIN TituloPendientes -->
 <tr>
   <td colspan="7"><h1 class="title">Pendientes</h1></td>
 </tr>
<!-- END TituloPendientes -->
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
      <td>{compras.comprobante}</td>
      <td>{compras.fecha}</td>
      <td><a href="/usuarios/{compras.id_usuarios}/">{compras.usuario}</a></td>
      <td>{compras.pais}</td>
      <td><a href="/admincp/compras/{compras.id_compras}/detalles/">ver</a></td>
   </tr>
<!-- END compras -->
<!-- BEGIN TituloPendientesEnvio -->
    <tr>
      <td colspan="7"><h1 class="title">Pendientes de Env&iacute;o</h1></td>
    </tr>
<!-- END TituloPendientesEnvio -->
<!-- BEGIN compras3 -->
   <tr class="{compras3.class}">
      <td>
        <ul>
<!-- BEGIN libros -->
            <li><a href="/libros/{compras3.libros.url}/">{compras3.libros.titulo}</a></li>
<!-- END libros -->
        </ul>
      </td>
      <td><span class="precio">u$s</span> {compras3.precio}</td>
      <td>{compras3.comprobante}</td>
      <td>{compras3.fecha}</td>
      <td><a href="/usuarios/{compras3.id_usuarios}/">{compras3.usuario}</a></td>
      <td>{compras3.pais}</td>
      <td><a href="/admincp/compras/{compras3.id_compras}/detalles/">ver</a></td>
   </tr>
<!-- END compras3 -->
<!-- BEGIN TituloPendientesAprobacion -->
    <tr>
      <td colspan="7"><h1 class="title">Pendientes de Aprobaci&oacute;n</h1></td>
    </tr>
<!-- END TituloPendientesAprobacion -->
<!-- BEGIN compras2 -->
   <tr class="{compras2.class}">
      <td>
        <ul>
<!-- BEGIN libros -->
            <li><a href="/libros/{compras2.libros.url}/">{compras2.libros.titulo}</a></li>
<!-- END libros -->
        </ul>
      </td>
      <td><span class="precio">u$s</span> {compras2.precio}</td>
      <td>{compras2.comprobante}</td>
      <td>{compras2.fecha}</td>
      <td><a href="/usuarios/{compras2.id_usuarios}/">{compras2.usuario}</a></td>
      <td>{compras2.pais}</td>
      <td><a href="/admincp/compras/{compras2.id_compras}/detalles/">ver</a></td>
   </tr>
<!-- END compras2 -->
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