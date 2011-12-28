<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/blog/">Blog</a>
<!-- BEGIN tag -->
    &raquo; <a href="/blog/{tag.etiqueta}/">{tag.etiqueta}</a>
<!-- END tag -->
  </div>
<!-- BEGIN post -->
  <div class="post">
    <span class="date">{post.mes}<br />{post.dia}</span>
    <h1><a href="/blog/{post.url}/">{post.titulo}</a></h1>
    <h2>{post.descripcion}</h2>
    {post.cuerpo}
    <div class="meta">
      <p><strong>Tags</strong>:
<!-- BEGIN tags -->
        <a href="/blog/{post.tags.etiqueta}/" title="{post.tags.etiqueta}">{post.tags.etiqueta}</a>
<!-- END tags -->
        <strong>Comentarios</strong>: <a href="/blog/{post.comentariosUrl}">{post.comentarios}</a>
      </p>
    </div>
  </div>
<!-- END post -->
</div>
<div id="columnright">
{random}
{cloud}
</div>