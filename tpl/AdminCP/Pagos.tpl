<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/pagos/">Pagos</a>
  </div>
  <h1>Pagos</h1>
  <h2>Pagos</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>El pago fue actualizado exitosamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th class="center">Digitos</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5" class="right">
          <a href="/admincp/pagos/agregar/">Agregar Pago</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td class="center">{each.digitos}</td>
        <td class="center"><a href="/admincp/pagos/{each.id_pagos}/">ver</a></td>
        <td class="center"><a href="/admincp/pagos/{each.id_pagos}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>