<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/noticias/">Noticias</a> &raquo;
    <a href="/admincp/noticias/{id_noticias}/">{titulo}</a>
  </div>
  <h1>{titulo}</h1>
  <h2>Creada el {fecha}.</h2>
  <dl>
    <dt><label>Titulo</label></dt>
    <dd>{titulo}</dd>

    <dt><label>Descripcion</label></dt>
    <dd>{descripcion}</dd>

    <dt><label>Cuerpo</label></dt>
    <dd>{cuerpo}</dd>

    <dt><label>Etiquetas</label></dt>
    <dd>{etiquetas}</dd>

    <dd class="only"><hr /></dd>
    <dd>
      <form action="/admincp/noticias/{id_noticias}/modificar/" method="post">
        <div>
          <input type="submit" class="submit" value="Modificar" />
          &oacute; <a href="/admincp/noticias/">Cancelar</a>
        </div>
      </form>
    </dd>
  </dl>
</div>