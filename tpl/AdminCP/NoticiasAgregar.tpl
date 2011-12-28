<!-- BEGIN specialchars -->
<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript" src="/js/specialchars.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { obj = $$('cuerpo'); });/*]]>*/</script>
<!-- END specialchars -->
<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/noticias/">Noticias</a> &raquo;
    <a href="/admincp/noticias/agregar/">Agregar</a>
  </div>
  <h1>Agregar Noticia</h1>
  <h2>Agregar una nueva noticia, esta aparecer&aacute; en su blog.</h2>
  <form action="/admincp/noticias/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN titulo_required -->
      <li><label for="titulo">Falta el t&iacute;tulo.</label></li>
<!-- END titulo_required -->
<!-- BEGIN descripcion_required -->
      <li><label for="descripcion">Falta la descripci&oacute;n.</label></li>
<!-- END descripcion_required -->
<!-- BEGIN cuerpo_required -->
      <li><label for="cuerpo">Falta el cuerpo del mensaje.</label></li>
<!-- END cuerpo_required -->
<!-- BEGIN etiquetas_required -->
      <li><label for="etiquetas">Falta al menos una etiqueta.</label></li>
<!-- END etiquetas_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="titulo">Titulo</label></dt>
      <dd>
        <input type="text" name="titulo" id="titulo" size="40" maxlength="96" value="{titulo}" />
        <span>Ej: Lanzamos!</span>
      </dd>

      <dt><label for="descripcion">Descripcion</label></dt>
      <dd>
        <input type="text" name="descripcion" id="descripcion" size="50" maxlength="255" value="{descripcion}" />
        <span>Una peque&ntilde;a descripci&oacute;n sobre lo que estas escribiendo.</span>
      </dd>

      <dt><label for="cuerpo">Cuerpo</label></dt>
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
  <div class="sintaxis">
    <h2>Sintaxis</h2>
    <p>
      <span>= T&iacute;tulo 1 =</span>
      <span>== T&iacute;tulo 2 ==</span>
      <span>=== T&iacute;tulo 3 ===</span>
    </p>
    <p>
      <span>*Negrita*</span>
      <span>/Cursiva/</span>
      <span>_Subrayado_</span>
    </p>
    <p>
      <span>+Grande+</span>
      <span>-Chico-</span>
    </p>
    <p>
      <span>[http://dominio/pagina]</span>
      <span>[http://dominio/pagina|Etiqueta]</span>
      <span>[http://imagen]</span>
      <span>[http://dominio/pagina|http://imagen]</span>
    </p>
  </div>
        <textarea name="cuerpo" id="cuerpo" rows="12" cols="70">{cuerpo}</textarea>
      </dd>

      <dt><label for="etiquetas">Etiquetas</label></dt>
      <dd>
        <input type="text" name="etiquetas" id="etiquetas" size="40" maxlength="255" value="{etiquetas}" />
        <span>Separadas por espacios.</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/noticias/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>