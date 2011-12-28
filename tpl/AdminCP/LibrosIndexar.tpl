<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/indexar/">Indexar</a>
  </div>
  <h1>Indexar</h1>
  <h2>La indexaci&oacute;n proporciona agilidad en las b&uacute;squedas, lo que se traduce en mayor rapidez a la hora de mostrar resultados.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>Proceso por lotes finalizado con &eacute;xito.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <form action="/admincp/libros/indexar/" method="post">
    <dl>
      <dt><label for="mode-single">Modo</label></dt>
      <dd class="input">
        <ul class="checkboxs">
          <li>
            <input type="radio" class="checkbox" name="mode" id="mode-libros" value="libros" />
            <label for="mode-libros">Libros</label>
          </li>
          <li>
            <input type="radio" class="checkbox" name="mode" id="mode-single" value="single" checked="checked" />
            <label for="mode-single">Single</label>
          </li>
        </ul>
        <div class="clear"><!-- --></div>
      </dd>

      <dd>
        <p>El modo <em>Libros</em> le quita todos los caracteres invalidos y remueve si encuentra URLs, emails, etc.</p>
        <p>El modo <em>Single</em> busca las palabras comunes y las elimina de la indexaci&oacute;n. Asi los articulos, prepociciones, advervios, etc no estar&aacute;n dispoinibles para las b&uacute;squedas.</p>
      </dd>

      <dt><label>Campos</label></dt>
      <dd class="inputs">
        <ul class="list">
          <li>
            <input type="checkbox" class="checkbox" name="isbn" id="isbn" value="1" checked="checked" />
            <label for="isbn">ISBN</label>
          </li>
          <li>
            <input type="checkbox" class="checkbox" name="sinopsis" id="sinopsis" value="1" checked="checked" />
            <label for="sinopsis">Sinopsis</label>
          </li>
        </ul>
        <div class="clear"><!-- --></div>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Indexar" />
        &oacute; <a href="/admincp/libros/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>