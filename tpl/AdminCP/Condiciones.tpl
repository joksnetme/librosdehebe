<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/condiciones/">Condiciones</a>
  </div>
  <h1>Condiciones</h1>
  <h2>Estado de Libros</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>La condici&oacute;n fue actualizada exitosamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Condicion</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="4" class="right">
          <a href="/admincp/condiciones/agregar/">Agregar Condici&oacute;n</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td class="center"><a href="/admincp/condiciones/{each.id_condiciones}/">ver</a></td>
        <td class="center"><a href="/admincp/condiciones/{each.id_condiciones}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>