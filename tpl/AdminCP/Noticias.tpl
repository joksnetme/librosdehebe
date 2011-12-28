<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/noticias/">Noticias</a>
  </div>
  <h1>Noticias</h1>
  <h2>Listado con las noticias actuales.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN error -->
      <li><label>No se encontro la noticia.</label></li>
<!-- END error -->
<!-- BEGIN done -->
      <li><label>Las noticias fueron actualizadas correctamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Etiquetas</th>
        <th>Fecha</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="7" class="right">
          <a href="/admincp/noticias/agregar/">Agregar Noticia</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.titulo}</td>
        <td>{each.descripcion}</td>
        <td>{each.etiquetas}</td>
        <td>{each.fecha}</td>
        <td class="center"><a href="/admincp/noticias/{each.id}/">ver</a></td>
        <td class="center"><a href="/admincp/noticias/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>