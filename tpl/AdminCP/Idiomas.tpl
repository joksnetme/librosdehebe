<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/idiomas/">Idiomas</a>
  </div>
  <h1>Idiomas</h1>
  <h2>Listado con los idiomas disponibles.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>El idioma fue actualizado exitosamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Idioma</th>
        <th>Abreviaci&oacute;n</th>
        <th class="center">Libros</th>
        <th class="right">Precio</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="4">&nbsp;</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{precio}</td>
        <td colspan="2" class="right">
          <a href="/admincp/idiomas/agregar/">Agregar Idioma</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.idioma}</td>
        <td>{each.abbr}</td>
        <td class="center">{each.libros}</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{each.precio}</td>
        <td class="center"><a href="/admincp/idiomas/{each.id_idiomas}/">ver</a></td>
        <td class="center"><a href="/admincp/idiomas/{each.id_idiomas}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>