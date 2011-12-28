<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a> &raquo;
    <a href="/admincp/faq/categorias/">Categorias</a> &raquo;
    <a href="/admincp/faq/categorias/{id_faq_categorias}/">{nombre}</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Listado de preguntas de la categoria {nombre}.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label><em>{nombre}</em> se actualiz&oacute; exitosamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th class="center">#</th>
        <th>Pregunta</th>
        <th class="center">Fecha</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.pregunta}</td>
        <td class="center">{each.fecha}</td>
        <td class="center"><a href="/admincp/faq/{each.id}/">ver</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
  <dl>
    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/faq/categorias/{id_faq_categorias}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/faq/categorias/{id_faq_categorias}/agregar/">Agregar Pregunta</a>
          &oacute; <a href="/admincp/faq/categorias/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>