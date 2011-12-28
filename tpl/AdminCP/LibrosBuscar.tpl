<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/{query}/">B&uacute;squeda</a>
  </div>
  <h1>B&uacute;squeda</h1>
  <h2>Resultado de su b&uacute;squeda "{text}".</h2>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>T&iacute;tulo</th>
        <th>Autor</th>
        <th class="center">A&ntilde;o</th>
        <th>Editorial</th>
        <th class="right">Precio</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5">&nbsp;</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{precio}</td>
        <td colspan="3">&nbsp;</td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.titulo}</td>
        <td>{each.autor} (<a href="/admincp/autores/{each.id_autores}/">&raquo;</a>)</td>
        <td class="center">{each.anho}</td>
        <td>{each.editorial} (<a href="/admincp/editoriales/{each.id_editoriales}/">&raquo;</a>)</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{each.precio}</td>
        <td class="center"><a href="/admincp/libros/{each.id}/">ver</a></td>
        <td class="center"><a href="/admincp/libros/{each.id}/tapas/">tapas</a></td>
        <td class="center"><a href="/admincp/libros/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>