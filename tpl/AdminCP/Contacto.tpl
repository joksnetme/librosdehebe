<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/contacto/">Mensajes</a>
  </div>
  <h1>Mensajes
<!-- BEGIN read -->
      Le&iacute;dos
<!-- END read -->
<!-- BEGIN unread -->
      No Le&iacute;dos
<!-- END unread -->
  </h1>
  <h2>Listado de mensajes recibidos desde el formulario de contacto</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN error -->
      <li><label>Mensaje inexistente.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th>Asunto</th>
        <th class="center">Fecha</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5" class="right">
          <a href="/admincp/contacto/">Todos</a> &oacute;
          <a href="/admincp/contacto/read/">Le&iacute;dos</a> &oacute;
          <a href="/admincp/contacto/unread/">No Le&iacute;dos</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}
<!-- BEGIN userLink -->
          (<a href="/usuarios/{each.userLink.id_usuarios}/">&raquo;</a>)
<!-- END userLink -->
        </td>
        <td>{each.asunto}</td>
        <td class="center">{each.fecha}</td>
        <td class="center"><a href="/admincp/contacto/{each.id}/">ver</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>