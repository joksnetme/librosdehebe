<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/sinonimos/">Sin&oacute;nimos</a>
  </div>
  <h1>Sin&oacute;nimos</h1>
  <h2>Utilizados en la b&uacute;squeda.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>Sin&oacute;nimo creado con &eacute;xito.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Palabra</th>
        <th>Sin&oacute;nimo</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="4" class="right">
          <a href="/admincp/sinonimos/agregar/">Agregar</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.palabra}</td>
        <td>{each.sinonimo}</td>
        <td class="center">
          <a href="/admincp/sinonimos/{each.id}/modificar/">modificar</a>
        </td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>