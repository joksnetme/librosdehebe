<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/faq/">Preguntas Frecuentes</a>
  </div>
  <h1>Preguntas Frecuentes</h1>
  <h2>Respuestas a preguntas frecuentes</h2>

  <div class="preguntas">
<!-- BEGIN categoria -->
    <h3 class="faq">{categoria.categoria}</h3>
    <ul class="faq">
<!-- BEGIN each -->
      <li><a href="#faq{categoria.each.id}">{categoria.each.pregunta}</a></li>
<!-- END each -->
    </ul>
<!-- END categoria -->
  </div>

<!-- BEGIN categoria -->
  <h3 class="faq">{categoria.categoria}</h3>
<!-- BEGIN each -->
  <div class="faq">
    <a name="faq{categoria.each.id}"></a>
    <div class="pregunta">{categoria.each.pregunta}</div>
    <div class="respuesta">{categoria.each.respuesta}</div>
  </div>
<!-- END each -->
<!-- END categoria -->
</div>
<div id="columnright">
{random}
</div>