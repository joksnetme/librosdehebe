<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a>
  </div>
  <h1>Preguntas Frecuentes</h1>
  <h2>{count} pregunta{s} frecuentes en {countCat} categoria{sc}.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN error -->
      <li><label>No se encontro la pregunta.</label></li>
<!-- END error -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Pregunta</th>
        <th class="center">Categoria</th>
        <th class="center">Fecha</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="6" class="right">
          <a href="/admincp/faq/categorias/">Listar Categorias</a> &oacute;
          <a href="/admincp/faq/categorias/agregar/">Agregar Categoria</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.pregunta}</td>
        <td class="center">{each.categoria} (<a href="/admincp/faq/categorias/{each.id_faq_categorias}/">&raquo;</a>)</td>
        <td class="center">{each.fecha}</td>
        <td class="center"><a href="/admincp/faq/{each.id}/">ver</a></td>
        <td class="center"><a href="/admincp/faq/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
</div>