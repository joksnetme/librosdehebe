<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/blog/">Blog</a> &raquo;
    <a href="/blog/{furl}/">{titulo}</a>
  </div>
  <div class="post">
    <span class="date">{mes}<br />{dia}</span>
    <h1>{titulo}</h1>
    <h2>{descripcion}</h2>
    {cuerpo}
    <div class="meta">
      <p><strong>Tags</strong>:
<!-- BEGIN tags -->
        <a href="/blog/{tags.etiqueta}/" title="{tags.etiqueta}">{tags.etiqueta}</a>
<!-- END tags -->
      </p>
    </div>
    <div class="comments">
      <a name="comentarios"><!-- --></a>
      <h1 class="title">{comentarios} Comentarios</h1>
<!-- BEGIN comments -->
      <div class="comment">
        <p class="autor">
<!-- BEGIN ifUrl -->
          <a href="{comments.url}"><strong>{comments.nombre}</strong></a>
<!-- END ifUrl -->
<!-- BEGIN notUrl -->
          <strong>{comments.nombre}</strong>
<!-- END notUrl -->
        el {comments.fecha} coment&oacute;:</p>
        {comments.comentario}
      </div>
<!-- END comments -->
      <form action="/blog/{furl}/" method="post">
<!-- BEGIN validation -->
    <ul class="validation validComments">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese su nombre completo.</label></li>
<!-- END nombre_required -->
<!-- BEGIN email_required -->
      <li><label for="email">Ingrese su correo electr&oacute;nico.</label></li>
<!-- END email_required -->
<!-- BEGIN email_email -->
      <li><label for="email">El correo electr&oacute;nico debe ser v&aacute;lido.</label></li>
<!-- END email_email -->
<!-- BEGIN url_url -->
      <li><label for="url">La URL ingresada debe ser v&aacute;lida.</label></li>
<!-- END url_url -->
<!-- BEGIN comentario_required -->
      <li><label for="comentario">Ingrese su comentario.</label></li>
<!-- END comentario_required -->
    </ul>
<!-- END validation -->
        <dl>
          <dt><label for="nombre">Nombre</label></dt>
          <dd>
            <input type="text" name="nombre" id="nombre" value="{nombre}" maxlength="32" size="40" />
          </dd>

          <dt><label for="email">Email</label></dt>
          <dd>
            <input type="text" name="email" id="email" value="{email}" maxlength="64" size="40" />
          </dd>

          <dt><label for="url">Url</label></dt>
          <dd>
            <input type="text" name="url" id="url" value="{url}" maxlength="96" size="40" />
          </dd>

          <dt><label for="comentario">Comentario</label></dt>
          <dd>
            <textarea name="comentario" id="comentario" rows="6" cols="40">{comentario}</textarea>
          </dd>

          <dd class="only"><hr /></dd>
          <dd>
            <input type="submit" class="submit" value="Comentar" />
          </dd>
        </dl>
      </form>
    </div>
  </div>
</div>
<div id="columnright">
{random}
{cloud}
</div>

