<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/envios/">Formas de Env&iacute;o</a>
  </div>
  <h1>Formas de Env&iacute;o</h1>
  <h2>Ver y modificar las formas de env&iacute;o</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>Las formas de env&iacute;o fueron actualizados correctamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Nombre</th>
        <th class="center">Local</th>
        <th>Cantidad</th>
        <th>Entrega</th>
        <th class="center">Precio</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="8" class="right">
          <a href="/admincp/envios/agregar/">Agregar Forma de Env&iacute;o</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.nombre}</td>
        <td class="center">{each.local}</td>
        <td>{each.cantidad} ejemplares</td>
        <td>{each.entrega} d&iacute;as laborables</td>
        <td class="center"><span class="precio">u$s</span> {each.precio}</td>
        <td class="center"><a href="/admincp/envios/{each.id_envios}/modificar/">modificar</a></td>
        <td class="center"><a href="/admincp/envios/{each.id_envios}/borrar/" onclick="return confirm('Realmente borrar este envio?')">borrar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>