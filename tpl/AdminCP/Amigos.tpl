<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/amigos/">Amigos</a>
  </div>
  <h1>Amigos</h1>
  <h2>Listado con las recomendaciones a amigos.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>La colecci&oacute;n fu&eacute; modificada exitosamente.</label></li>
<!-- END done -->
<!-- BEGIN error -->
      <li><label>Colecci&oacute;n inexistente.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>De</th>
        <th>Para</th>
        <th>Libro</th>
        <th>Fecha</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
<!-- BEGIN is_usuario -->
        <td>{each.de} (<a href="/usuarios/{each.id_usuarios}/">&raquo;</a>)</td>
<!-- END is_usuario -->
<!-- BEGIN is_not_usuario -->
        <td>{each.de}</td>
<!-- END is_not_usuario -->
        <td>{each.para}</td>
        <td>{each.libro} (<a href="/admincp/libros/{each.id_libros}/">&raquo;</a>)</td>
        <td>{each.fecha}</td>
        <td class="center"><a href="/admincp/amigos/{each.id_amigos}/">ver</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>