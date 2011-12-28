<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/">Usuarios</a>
  </div>
  <h1>Usuarios</h1>
  <h2>Listado de miembros de Libros de Hebe</h2>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th>Correo Electr&oacute;nico</th>
        <th class="center">Libreria</th>
        <th class="center">&Uacute;ltimo ingreso</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td>{each.correo}</td>
        <td>{each.libreria}</td>
        <td class="center">{each.ultimo}</td>
        <td class="center"><a href="/usuarios/{each.id}/carrito/">carrito</a></td>
        <td class="center"><a href="/usuarios/{each.id}/">ver</a></td>
        <td class="center"><a href="/usuarios/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>