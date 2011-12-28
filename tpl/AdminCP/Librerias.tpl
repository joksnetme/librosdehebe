<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/librerias/">Librerias</a>
  </div>
  <h1>Librerias</h1>
  <h2>Listado con las librerias actuales.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>La libreria fu&eacute; actualizada exitosamente.</label></li>
<!-- END done -->
<!-- BEGIN error -->
      <li><label>Libreria inexistente.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5" class="right">
          <a href="/admincp/librerias/agregar/">Agregar Libreria</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td class="center"><a href="/admincp/librerias/{each.id_librerias}/">ver</a></td>
        <td class="center"><a href="/admincp/librerias/{each.id_librerias}/modificar/">modificar</a></td>
        <td class="center"><a href="/admincp/librerias/{each.id_librerias}/stock/">stock</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>