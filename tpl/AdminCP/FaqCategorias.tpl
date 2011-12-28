<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a> &raquo;
    <a href="/admincp/faq/categorias/">Categorias</a>
  </div>
  <h1>Categorias</h1>
  <h2>... de Preguntas Frecuentes.</h2>
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN error -->
      <li><label>No se encontro la categoria de preguntas frecuentes.</label></li>
<!-- END error -->
<!-- BEGIN done -->
      <li><label>Pregunta agregada con &eacute;xito.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Pregunta</th>
        <th class="center">Preguntas</th>
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
        <td class="center">{each.preguntas}</td>
        <td class="center"><a href="/admincp/faq/categorias/{each.id}/agregar/">agregar pregunta</a></td>
        <td class="center"><a href="/admincp/faq/categorias/{each.id}/">ver</a></td>
        <td class="center"><a href="/admincp/faq/categorias/{each.id}/modificar/">modificar</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
  <dl>
    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/faq/categorias/agregar/" method="post">
        <div>
          <input type="submit" class="submit" value="Agregar" />
          &oacute; <a href="/admincp/faq/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>