<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/contacto/">Mensajes</a> &raquo;
    <a href="/admincp/contacto/{id_contacto}/">{asunto}</a>
  </div>
  <h1>{asunto}</h1>
  <h2>Mensaje enviado por {nombre} el {fecha}.</h2>
  <dl>
    <dt><label>Enviado por</label></dt>
    <dd>{nombre}
<!-- BEGIN userLink -->
      (<a href="/usuarios/{userLink.id_usuarios}/">&raquo;</a>)
<!-- END userLink -->
    </dd>

    <dt><label>Correo</label></dt>
    <dd>{email}</dd>

    <dt><label>Fecha</label></dt>
    <dd>{fecha}</dd>

    <dd class="only"><hr /></dd>

    <dt><label>Asunto</label></dt>
    <dd>{asunto}</dd>

    <dt><label>Mensaje</label></dt>
    <dd>{mensaje}</dd>

    <dd class="only"><hr /></dd>

    <dt><label>IP</label></dt>
    <dd>{client_ip}</dd>

    <dt><label>User Agent</label></dt>
    <dd>{user_agent}</dd>

    <dd class="only"><hr /></dd>
      <dd>
        <form action="/admincp/contacto/{id_contacto}/" method="post">
          <input type="hidden" name="id_contacto" id="id_contacto" value="{id_contacto}" />
<!-- BEGIN read -->
          <input type="submit" class="submit" name="read" value="Marcar Como Le&iacute;do" />
<!-- END read -->
<!-- BEGIN unread -->
          <input type="submit" class="submit" name="unread" value="Marcar Como No Le&iacute;do" />
<!-- END unread -->
          &oacute; <a href="/admincp/contacto/">Cancelar</a>
        </form>
      </dd>
  </dl>
</div>