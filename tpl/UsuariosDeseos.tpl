<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/">Usuarios</a> &raquo;
    <a href="/usuarios/{id_usuarios}/">{nombre}</a> &raquo;
    <a href="/usuarios/{id_usuarios}/deseos/">Lista de Deseos</a>
  </div>
  <h1>Lista de Deseos de {nombre}</h1>
  <h2>Libros que {nombre} desea comprar. Puedes relgarle uno.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>El libro fue agregado a la lista correctamente.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
<!-- BEGIN deseos -->
  <div class="book">
    <div class="left picture">
      <a href="/libros/{deseos.url}/"><img src="{deseos.imagen}" alt="" /></a>
    </div>
    <div class="left">
      <ul>
        <li><h3><a href="/libros/{deseos.url}/">{deseos.titulo}</a></h3></li>
        <li><span>Por <a href="/buscar/{deseos.autorUri}" title="{deseos.autor}">{deseos.autor}</a></span></li>
        <li><span>Publicado
<!-- BEGIN anho -->
        en {deseos.anho}
<!-- END anho -->
        por <a href="/buscar/{deseos.editorialUri}" title="{deseos.editorial}">{deseos.editorial}</a></span></li>
        <li><span>
<!-- BEGIN isbn -->
        ISBN {deseos.isbn},
<!-- END isbn -->
        {deseos.tomos} tomo{deseos.s}, {deseos.paginas} p&aacute;ginas</span></li>
      </ul>
    </div>
<!-- BEGIN del -->
    <div class="right delete">
      <a href="/usuarios/{deseos.id_usuarios}/deseos/{deseos.id_deseos}/borrar/">
        <img src="/img/cross.gif" alt="" />
      </a>
    </div>
<!-- END del -->
    <div class="clear"><!-- --></div>
  </div>
<!-- END deseo -->

<!-- BEGIN empty -->
  <div class="alert">
    <div>{nombre} no tiene ning&uacute;n libro que desee.</div>
  </div>
<!-- END empty -->

</div>
<div id="columnright">
{random}
</div>