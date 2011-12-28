<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/condiciones/">Condiciones</a> &raquo;
    <a href="/admincp/condiciones/{id_condiciones}/">{condicion}</a>
  </div>
  <h1>{condicion}</h1>
  <h2>Viendo condici&oacute;n</h2>
    <dl>
      <dt><label>Condici&oacute;n</label></dt>
      <dd>{condicion}</dd>

      <dd class="only"><hr /></dd>
      <dd>
         <form action="/admincp/condiciones/{id_condiciones}/modificar/" method="post">
          <input type="submit" class="submit" name="submit" value="Modificar" />
          &oacute; <a href="/admincp/condiciones/">Cancelar</a>
        </form>
      </dd>
    </dl>
</div>