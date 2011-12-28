<!-- BEGIN specialchars -->
<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript" src="/js/specialchars.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { obj = $$('respuesta'); });/*]]>*/</script>
<!-- END specialchars -->
<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/faq/">Preguntas Frecuentes</a> &raquo;
    <a href="/admincp/faq/categorias/">Categorias</a> &raquo;
    <a href="/admincp/faq/categorias/{id_faq_categorias}/">{nombre}</a> &raquo;
    <a href="/admincp/faq/categorias/{id_faq_categorias}/agregar/">Agregar Pregunta</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Agregar pregunta frecuente a la categoria {nombre}.</h2>
  <form action="/admincp/faq/categorias/{id_faq_categorias}/agregar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN pregunta_required -->
      <li><label for="pregunta">Ingrese la pregunta.</label></li>
<!-- END pregunta_required -->
<!-- BEGIN respuesta_required -->
      <li><label for="respuesta">Ingrese la respuesta.</label></li>
<!-- END respuesta_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="pregunta">Pregunta</label></dt>
      <dd>
        <input type="text" name="pregunta" id="pregunta" size="59" maxlength="255" value="{pregunta}" />
      </dd>

      <dt><label for="respuesta">Respuesta</label></dt>
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
        <textarea name="respuesta" id="respuesta" rows="12" cols="52">{respuesta}</textarea>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_faq_categorias" id="id_faq_categorias" value="{id_faq_categorias}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/faq/categorias/{id_faq_categorias}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>