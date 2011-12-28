<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/editoriales/">Editoriales</a> &raquo;
    <a href="/admincp/editoriales/{id_editoriales}/">{nombre}</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Listado de libros publicados por {nombre}.</h2>
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
        <th>T&iacute;tulo</th>
        <th>Autor</th>
        <th class="center">A&ntilde;o</th>
        <th>Editorial</th>
        <th class="right">Precio</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5">&nbsp;</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{precio}</td>
        <td colspan="1">&nbsp;</td>
      </tr>
    </tfoot>
    <tbody>
<!-- BEGIN each -->
      <tr class="{each.class}">
        <td class="center">{each.pos}</td>
        <td>{each.titulo}</td>
        <td>{each.autor} (<a href="/admincp/autores/{each.id_autores}/">&raquo;</a>)</td>
        <td class="center">{each.anho}</td>
        <td>{each.editorial}</td>
        <td class="right"><span class="precio">u$s</span>&nbsp;{each.precio}</td>
        <td class="center"><a href="/admincp/libros/{each.id}/">ver</a></td>
      </tr>
<!-- END each -->
    </tbody>
  </table>
  <form action="/admincp/editoriales/{id_editoriales}/" method="post">
    <dl>
      <dd class="only"><hr /></dd>
      <dd class="only">Cambiar <b>{nombre}</b> por
        <select name="new" id="new">
<!-- BEGIN editoriales -->
          <option value="{editoriales.id_editoriales}">{editoriales.nombre}</option>
<!-- END editoriales -->
        </select>
        <input type="hidden" name="id_editoriales" id="id_editoriales" value="{id_editoriales}" />
        <input type="submit" class="submit" name="change" value="Cambiar" />
      </dd>
    </dl>
  </form>
  <dl>
    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/editoriales/{id_editoriales}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/editoriales/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>