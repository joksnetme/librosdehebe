<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript" src="/js/search.js"></script>
<div class="search-bar">
  <ul class="search-nav">
<!-- BEGIN searchNav -->
    <li>
        <a href="/buscar/{searchNav.other}" class="other"><img src="/img/bullet-cross.gif" alt="" /></a>
        <a href="/buscar/{searchNav.uri}">{searchNav.value}</a>
    </li>
<!-- END searchNav -->
  </ul>

  <div class="clear"><!-- --></div>

<!-- BEGIN try -->
  <div class="try-another">
    <form action="/buscar/" method="post">
      <ul>
        <li>
            <select name="key">
<!-- BEGIN keys -->
                <option value="{try.keys.id}">{try.keys.name}</option>
<!-- END keys -->
            </select>
        </li>
        <li>
          <div id="titulo" class="hidden">
            <input type="text" name="titulo" size="42" maxlength="96" value="{titulo}" />
          </div>
          <div id="autor" class="hidden">
            <input type="text" name="autor" size="42" maxlength="96" value="{autor}" />
          </div>
          <div id="anho" class="hidden">
<!-- BEGIN buscar_rangoanho -->
            <span>Publicado desde</span>
            <input type="text" name="anho_d" size="3" maxlength="4" value="{anho_d}" />
            <span>hasta</span>
            <input type="text" name="anho_h" size="3" maxlength="4" value="{anho_h}" />
<!-- END buscar_rangoanho -->
<!-- BEGIN no_buscar_rangoanho -->
            <input type="text" name="anho" size="3" maxlength="4" value="{anho}" />
<!-- END no_buscar_rangoanho -->
          </div>
          <div id="editorial" class="hidden">
            <input type="text" name="editorial" size="29" maxlength="96" value="{editorial}" />
          </div>
          <div id="keywords" class="hidden">
            <input type="text" name="keywords" size="42" maxlength="96" value="{keywords}" />
          </div>
        </li>
        <li>
          <input type="submit" name="submit" class="submit" value="Buscar" />
        </li>
      </ul>
      <div class="clear"><!-- --></div>
    </form>
  </div>
<!-- END try -->
</div>
<div id="columnleft">
  <ul class="libros">
<!-- BEGIN each -->
    <li>
      <a href="/libros/{each.id_libros}+{each.url}/" id="libro{each.id_libros}" class="{each.class}">
        <img src="/upl/libros/{each.id_libros}/120x160/i.jpg" alt="{each.titulo}" />
        <span>{each.titulo}</span>
      </a>
  <div class="details hidden">
    <h2>{each.titulo}</h2>
    <ul>
      <li><span>Por <a href="{each.autorUri}" title="{each.autor}">{each.autor}</a></span></li>
      <li><span>Publicado
<!-- BEGIN anho -->
      en {each.anho}
<!-- END anho -->
      por <a href="{each.editorialUri}" title="{each.editorial}">{each.editorial}</a></span></li>
      <li><span>
<!-- BEGIN isbn -->
      ISBN {each.isbn},
<!-- END isbn -->
      {each.tomos} tomo{each.s}, {each.paginas} p&aacute;ginas</span></li>
    </ul>
    <div class="img">
      <a href="/libros/{each.id_libros}+{each.url}/" title="{each.titulo}">
        <img src="/upl/libros/{each.id_libros}/190x255/i.jpg" alt="{each.titulo}" />
      </a>
    </div>
    <h3><span class="precio">u$s</span> {each.precio}</h3>
  </div>
    </li>
<!-- END each -->
  </ul>
</div>