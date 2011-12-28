<script type="text/javascript" src="/js/domassistant.js"></script>
<!-- BEGIN specialchars -->
<script type="text/javascript" src="/js/specialchars.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { obj = $$('sinopsis'); });/*]]>*/</script>
<!-- END specialchars -->
<!-- BEGIN ifColeccion -->
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { $$('tomos').addEvent('change', function() { var tomos = this.value; if ( !( isNaN(tomos) ) ) { if ( tomos > 1 ) $$('tomoblock').addClass('hidden'); else $$('tomoblock').removeClass('hidden'); } }); });/*]]>*/</script>
<!-- END ifColeccion -->
<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/libros/">Libros</a> &raquo;
    <a href="/admincp/libros/{id_libros}/">{titulo}</a> &raquo;
    <a href="/admincp/libros/{id_libros}/modificar/">Modificar</a>
  </div>
  <h1>{titulo}</h1>
  <h2>Modificando un libro de {autor} publicado en {anho} por {editorial}.</h2>
  <form action="/admincp/libros/{id_libros}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label><em>{titulo}</em> se actualiz&oacute; exitosamente.</label></li>
<!-- END done -->
<!-- BEGIN titulo_required -->
      <li><label for="titulo">Ingrese el t&iacute;tulo del libro. Ej: El canto del pajaro</label></li>
<!-- END titulo_required -->
<!-- BEGIN anho_required -->
      <li><label for="anho">Complete el a&ntilde;o de edici&oacute;n del libro.</label></li>
<!-- END anho_required -->
<!-- BEGIN anho_number -->
      <li><label for="anho">El a&ntilde;o de edici&oacute;n del libro debe ser un n&uacute;mero.</label></li>
<!-- END anho_number -->
<!-- BEGIN tomos_required -->
      <li><label for="tomos">Complete la cantidad de tomos del libro.</label></li>
<!-- END tomos_required -->
<!-- BEGIN tomos_number -->
      <li><label for="tomos">La cantidad de tomos debe ser un n&uacute;mero.</label></li>
<!-- END tomos_number -->
<!-- BEGIN paginas_required -->
      <li><label for="paginas">Complete la cantidad de p&aacute;ginas del libro.</label></li>
<!-- END paginas_required -->
<!-- BEGIN paginas_number -->
      <li><label for="paginas">La cantidad de p&aacute;ginas debe ser un n&uacute;mero.</label></li>
<!-- END paginas_number -->
<!-- BEGIN sinopsis_required -->
      <li><label for="sinopsis">Escriba la sinopsis del libro.</label></li>
<!-- END sinopsis_required -->
<!-- BEGIN precio_required -->
      <li><label for="precio">Complete el precio del libro en d&oacute;lares.</label></li>
<!-- END precio_required -->
<!-- BEGIN precio_number -->
      <li><label for="precio">El precio debe ser un n&uacute;mero que exprese d&oacute;lares norteamericanos.</label></li>
<!-- END precio_number -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="isbn">ISBN</label></dt>
      <dd>
        <input type="text" name="isbn" id="isbn" size="12" maxlength="12" value="{isbn}" />
        <span>Ej: 1590597273</span>
      </dd>

      <dt><label for="titulo">T&iacute;tulo</label></dt>
      <dd>
        <input type="text" name="titulo" id="titulo" size="59" maxlength="160" value="{titulo}" />
        <span>Ej: El canto del pajaro</span>
      </dd>

      <dt><label>Autor</label></dt>
      <dd>{autor} (<a href="/admincp/libros/{id_libros}/modificar/autor/">cambiar</a>, <a href="/admincp/autores/{id_autores}/modificar/">modificar</a>)</dd>

      <dt><label for="anho">A&ntilde;o</label>, <label>Editorial</label></dt>
      <dd>Publicado en <input type="text" name="anho" id="anho" size="3" maxlength="4" value="{anho}" /> por {editorial} (<a href="/admincp/libros/{id_libros}/modificar/editorial/">cambiar</a>, <a href="/admincp/editoriales/{id_editoriales}/modificar/">modificar</a>)</dd>

      <dt><label for="tomos">Cant. Tomos</label></dt>
      <dd><input type="text" name="tomos" id="tomos" size="1" maxlength="2" value="{tomos}" /></dd>

      <dt><label for="paginas">Cant. P&aacute;ginas</label></dt>
      <dd><input type="text" name="paginas" id="paginas" size="5" maxlength="6" value="{paginas}" /></dd>

      <dt><label>Idioma</label></dt>
      <dd>{idioma}</dd>

<!-- BEGIN ifColeccion -->
      <dt><label>Colecci&oacute;n</label></dt>
      <dd>{coleccion} (<a href="/admincp/libros/{id_libros}/modificar/coleccion/">cambiar</a>, <a href="/admincp/colecciones/{id_colecciones}/modificar/">modificar</a>)
        <div id="tomoblock" class="{ifColeccion.tomoblockClass}">
          tomo # <input type="text" name="tomo" id="tomo" size="5" maxlength="16" />
        </div>
      </dd>
<!-- END ifColeccion -->

      <dt><label for="sinopsis">Sinopsis</label></dt>
      <dd>
<!-- BEGIN specialchars -->
        <ul class="specialchars">
<!-- BEGIN each -->
          <li class="{specialchars.each.class}"><a href="#{specialchars.each.char}">{specialchars.each.code}</a></li>
<!-- END each -->
          <li class="toogle"><a href="#toogle" id="more">m&aacute;s</a></li>
        </ul>
        <div class="clear"><!-- --></div>
<!-- END specialchars -->
        <textarea name="sinopsis" id="sinopsis" rows="12" cols="52">{sinopsis}</textarea>
      </dd>

      <dt><label for="precio">Precio</label></dt>
      <dd><span class="precio">u$s</span><input type="text" name="precio" id="precio" size="5" maxlength="6" value="{precio}" /></dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_libros" id="id_libros" value="{id_libros}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/libros/{id_libros}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>