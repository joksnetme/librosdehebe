<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/paises/">Paises</a>
  </div>
  <h1>Paises</h1>
  <h2>Listado con los paises disponibles.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>El pa&iacute;s fue actualizado exitosamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Pa&iacute;s</th>
        <th>Abreviaci&oacute;n</th>
        <th>C&oacute;digo</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="6" class="right">
          <a href="/admincp/paises/agregar/">Agregar Pa&iacute;s</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.pais}</td>
        <td>{each.abbr}</td>
        <td>+ {each.codigo}</td>
        <td class="center"><a href="/admincp/paises/{each.id_paises}/">ver</a></td>
        <td class="center"><a href="/admincp/paises/{each.id_paises}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>