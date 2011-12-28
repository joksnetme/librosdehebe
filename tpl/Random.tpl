<!-- BEGIN random -->
  <div class="details">
    <h2>{random.titulo}</h2>
    <ul>
      <li><span>Por <a href="{random.autorUri}" title="{random.autor}">{random.autor}</a></span></li>
      <li><span>Publicado
<!-- BEGIN anho -->
      en {random.anho}
<!-- END anho -->
      por <a href="{random.editorialUri}" title="{random.editorial}">{random.editorial}</a></span></li>
      <li><span>
<!-- BEGIN isbn -->
      ISBN {random.isbn},
<!-- END isbn -->
      {random.tomos} tomo{random.s}, {random.paginas} p&aacute;ginas</span></li>
    </ul>
    <div class="img">
      <a href="/libros/{random.id_libros}+{random.url}/" title="{random.titulo}">
        <img src="/upl/libros/{random.id_libros}/190x255/i.jpg" alt="{random.titulo}" />
      </a>
    </div>
    <h3><span class="precio">u$s</span> {random.precio}</h3>
  </div>
<!-- END random -->