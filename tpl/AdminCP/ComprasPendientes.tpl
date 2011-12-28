<div class="admin-compras">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/compras/">Compras</a>
  </div>
  <h1>Compras Pendientes</h1>
  <h2>-</h2>

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
 </tbody>
 </table>
</div>