<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/idiomas/">Idiomas</a> &raquo;
    <a href="/admincp/idiomas/{id_idiomas}/">{idioma}</a>
  </div>
  <h1>{idioma}</h1>
  <h2>Viendo idioma</h2>
    <dl>
      <dt><label>Idioma</label></dt>
      <dd>{idioma}</dd>

      <dt><label>Abreviaci&oacute;n</label></dt>
      <dd>{abbr}</dd>

      <dd class="only"><hr /></dd>
      <dd>
         <form action="/admincp/idiomas/{id_idiomas}/modificar/" method="post">
          <input type="submit" class="submit" name="submit" value="Modificar" />
          &oacute; <a href="/admincp/idiomas/">Cancelar</a>
        </form>
      </dd>
    </dl>
</div>