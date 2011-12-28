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
    <a href="/admincp/libros/agregar/">Agregar</a>
  </div>
  <h1>Agregar Libro</h1>
  <h2>Utilice el <a href="/admincp/libros/">buscador</a> para saber si el libro que esta agregando no existe en el sistema</h2>
  <form action="/admincp/libros/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN done -->
      <li><label>Libro agregado exitosamente. Puede cargar uno nuevo a continuaci&oacute;n...</label></li>
<!-- END done -->
<!-- BEGIN titulo_required -->
      <li><label for="titulo">Ingrese el t&iacute;tulo del libro. Ej: El canto del pajaro</label></li>
<!-- END titulo_required -->
<!-- BEGIN autor_required -->
      <li><label for="autor">Ingrese el nombre del autor para buscarlo en la base de datos.</label></li>
<!-- END autor_required -->
<!-- BEGIN anho_required -->
      <li><label for="anho">Complete el a&ntilde;o de edici&oacute;n del libro.</label></li>
<!-- END anho_required -->
<!-- BEGIN anho_number -->
      <li><label for="anho">El a&ntilde;o de edici&oacute;n del libro debe ser un n&uacute;mero.</label></li>
<!-- END anho_number -->
<!-- BEGIN editorial_required -->
      <li><label for="editorial">Ingrese parte del nombre de la editorial para buscala.</label></li>
<!-- END editorial_required -->
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
<!-- BEGIN autor_zeroresult -->
      <li><label for="autor">No se encontraron autores para la b&uacute;squeda "{validation.autor_zeroresult.value}".</label></li>
<!-- END autor_zeroresult -->
<!-- BEGIN editorial_zeroresult -->
      <li><label for="editorial">No se encontraron editoriales para la b&uacute;squeda "{validation.editorial_zeroresult.value}".</label></li>
<!-- END editorial_zeroresult -->
<!-- BEGIN coleccion_zeroresult -->
      <li><label for="coleccion">No se encontraron colecciones para la b&uacute;squeda "{validation.coleccion_zeroresult.value}".</label></li>
<!-- END coleccion_zeroresult -->
    </ul>
<!-- END validation -->
    <dl>
<!-- BEGIN main -->
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

      <dt><label for="autor">Autor</label></dt>
      <dd>
        <input type="text" name="autor" id="autor" size="42" maxlength="96" value="{autor}" />
        <span>Ej: Anthony de Mello</span>
      </dd>

      <dt><label for="anho">A&ntilde;o</label>, <label for="editorial">Editorial</label></dt>
      <dd>Publicado en <input type="text" name="anho" id="anho" size="3" maxlength="4" value="{anho}" /> por <input type="text" name="editorial" id="editorial" size="29" maxlength="96" value="{editorial}" /></dd>

<!--
      <dt><label for="etiquetas">Etiquetas</label></dt>
      <dd>
        <input type="text" name="etiquetas" id="etiquetas" size="59" maxlength="140" value="{etiquetas}" />
        <span>Separadas por espacios. Son utilizadas como palabras claves para facilitar la b&uacute;squeda.</span>
      </dd>
  -->

      <dt><label for="tomos">Cant. Tomos</label></dt>
      <dd><input type="text" name="tomos" id="tomos" size="1" maxlength="2" value="{tomos}" /></dd>

      <dt><label for="paginas">Cant. P&aacute;ginas</label></dt>
      <dd><input type="text" name="paginas" id="paginas" size="5" maxlength="6" value="{paginas}" /></dd>

<!-- BEGIN ejemplares -->
      <dt><label for="ejemplares">Cantidad</label></dt>
      <dd>
        <input type="text" name="ejemplares" id="ejemplares" value="{ejemplares}" size="1" maxlength="6" />
        ejemplares en <strong>{main.ejemplares.libreria}</strong>.
      </dd>
<!-- END ejemplares -->

<!-- BEGIN ejemplaresLibrerias -->
      <dt><label for="ejemplares">Cantidad</label></dt>
      <dd>
        <input type="text" name="ejemplares" id="ejemplares" value="{ejemplares}" size="1" maxlength="6" />
        ejemplares en
          <select name="libreria">
<!-- BEGIN options -->
            <option value="{main.ejemplaresLibrerias.options.id_librerias}">{main.ejemplaresLibrerias.options.libreria}</option>
<!-- END options -->
          </select>
      </dd>
<!-- END ejemplaresLibrerias -->

      <dt><label>Idioma</label></dt>
      <dd class="input">
        <ul class="checkboxs">
<!-- BEGIN idioma -->
          <li>
            <input type="radio" class="checkbox"
<!-- BEGIN checked -->
             checked="checked"
<!-- END checked -->
             name="idioma" id="{main.idioma.value}" value="{main.idioma.value}" />
            <label for="{main.idioma.value}">{main.idioma.name}</label>
          </li>
<!-- END idioma -->
        </ul>
        <div class="clear"><!-- --></div>
      </dd>

<!-- BEGIN ifColeccion -->
      <dt><label for="coleccion">Colecci&oacute;n</label></dt>
      <dd>
        <input type="text" name="coleccion" id="coleccion" size="42" maxlength="96" value="{coleccion}" />
        <div id="tomoblock">
          tomo # <input type="text" name="tomo" id="tomo" size="5" maxlength="16" />
        </div>
        <span>Ej: El pozo de Siquem</span>
      </dd>
<!-- END ifColeccion -->

      <dt><label for="sinopsis">Sinopsis</label></dt>
      <dd>
<!-- BEGIN specialchars -->
        <ul class="specialchars">
<!-- BEGIN each -->
          <li class="{main.specialchars.each.class}"><a href="#{main.specialchars.each.char}">{main.specialchars.each.code}</a></li>
<!-- END each -->
          <li class="toogle"><a href="#toogle" id="more">m&aacute;s</a></li>
        </ul>
        <div class="clear"><!-- --></div>
<!-- END specialchars -->
        <textarea name="sinopsis" id="sinopsis" rows="12" cols="52">{sinopsis}</textarea>
      </dd>

      <dt><label for="precio">Precio</label></dt>
      <dd>
        <span class="precio">u$s</span>
        <input type="text" name="precio" id="precio" size="5" maxlength="6" value="{precio}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/libros/">Cancelar</a>
      </dd>
<!-- END main -->

<!-- BEGIN try -->
<!-- BEGIN autores -->
      <dt><label>Autores</label></dt>
      <dd class="input">
        <ul class="checkboxs">
<!-- BEGIN autor -->
          <li>
            <input type="radio" class="checkbox" name="autor" id="a{try.autores.autor.value}" value="{try.autores.autor.value}" />
            <label for="a{try.autores.autor.value}">{try.autores.autor.name}</label>
          </li>
<!-- END autor -->
        </ul>
        <div class="clear"><!-- --></div>
      </dd>
<!-- END autores -->

      <dd>
        <input type="radio" class="checkbox" name="autor" id="autor" value="new" checked="checked" />
        <label for="autor">Agregar</label>
        <input type="text" name="autorNombre" id="autorNombre" value="{try.autor}" size="36" maxlength="96" />
         como Autor
      </dd>

<!-- BEGIN editoriales -->
      <dt><label>Editoriales</label></dt>
      <dd class="input">
        <ul class="checkboxs">
<!-- BEGIN editorial -->
          <li>
            <input type="radio" class="checkbox" name="editorial" id="e{try.editoriales.editorial.value}" value="{try.editoriales.editorial.value}" />
            <label for="e{try.editoriales.editorial.value}">{try.editoriales.editorial.name}</label>
          </li>
<!-- END editorial -->
        </ul>
        <div class="clear"><!-- --></div>
      </dd>
<!-- END editoriales -->

      <dd>
        <input type="radio" class="checkbox" name="editorial" id="editorial" value="new" checked="checked" />
        <label for="editorial">Agregar</label>
        <input type="text" name="editorialNombre" id="editorialNombre" value="{try.editorial}" size="36" maxlength="96" />
         como Editorial
      </dd>

<!-- BEGIN colecciones -->
      <dt><label>Colecciones</label></dt>
      <dd class="input">
        <ul class="checkboxs">
<!-- BEGIN coleccion -->
          <li>
            <input type="radio" class="checkbox" name="coleccion" id="c{try.colecciones.coleccion.value}" value="{try.colecciones.coleccion.value}" />
            <label for="c{try.colecciones.coleccion.value}">{try.colecciones.coleccion.name}</label>
          </li>
<!-- END coleccion -->
        </ul>
        <div class="clear"><!-- --></div>
      </dd>
<!-- END colecciones -->

<!-- BEGIN ifColeccion -->
      <dd>
        <input type="radio" class="checkbox" name="coleccion" id="coleccion" value="new" checked="checked" />
        <label for="coleccion">Agregar</label>
        <input type="text" name="coleccionNombre" id="coleccionNombre" value="{try.coleccion}" size="36" maxlength="96" />
         como Colecci&oacute;n
      </dd>
<!-- END ifColeccion -->

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="isbn" id="isbn" value="{try.isbn}" />
        <input type="hidden" name="titulo" id="titulo" value="{try.titulo}" />
        <input type="hidden" name="anho" id="anho" value="{try.anho}" />
        <input type="hidden" name="categoria" id="categoria" value="{try.categoria}" />
        <input type="hidden" name="tomos" id="tomos" value="{try.tomos}" />
        <input type="hidden" name="paginas" id="paginas" value="{try.paginas}" />

        <input type="hidden" name="ejemplares" id="ejemplares" value="{try.ejemplares}" />
        <input type="hidden" name="libreria" id="libreria" value="{try.libreria}" />

        <input type="hidden" name="idioma" id="idioma" value="{try.idioma}" />
        <!-- input type="hidden" name="sinopsis" id="sinopsis" value="{-try.sinopsis-}" / -->
        <textarea name="sinopsis" id="sinopsis" rows="12" cols="52" style="display: none;">{try.sinopsis}</textarea>
        <input type="hidden" name="tomo" id="tomo" value="{try.tomo}" />
        <input type="hidden" name="precio" id="precio" value="{try.precio}" />

        <input type="submit" class="submit" name="save2" value="Guardar" />
         &oacute; <a href="/admincp/libros/">Cancelar</a>
      </dd>
<!-- END try -->
    </dl>
  </form>
</div>