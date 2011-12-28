<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a> &raquo;
    <a href="/admincp/faq/{id_faq}/">{pregunta}</a>
  </div>
  <h1>{pregunta}</h1>
  <h2>Creada el {fecha}.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label><em>{pregunta}</em> se actualiz&oacute; exitosamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <dl>
    <dt><label>Pregunta</label></dt>
    <dd>{pregunta}</dd>

    <dt><label>Respuesta</label></dt>
    <dd>{respuesta}</dd>

    <dt><label>Categoria</label></dt>
    <dd>{categoria}</dd>

    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/faq/{id_faq}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/faq/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>