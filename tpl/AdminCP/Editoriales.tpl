<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/editoriales/">Editoriales</a>
  </div>
  <h1>Editoriales</h1>
  <h2>Listado con las editoriales actuales.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>La editorial fu&eacute; modificada exitosamente.</label></li>
<!-- END done -->
<!-- BEGIN error -->
      <li><label>Editorial inexistente.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th class="center">Libros</th>
        <th class="right">Precio</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{precio}</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td class="center">{each.libros}</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{each.precio}</td>
        <td class="center"><a href="/admincp/editoriales/{each.id}/">ver</a></td>
        <td class="center"><a href="/admincp/editoriales/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>