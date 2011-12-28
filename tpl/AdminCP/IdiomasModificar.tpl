<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/idiomas/">Idiomas</a> &raquo;
    <a href="/admincp/idiomas/{id_idiomas}/">{idioma}</a> &raquo;
    <a href="/admincp/idiomas/{id_idiomas}/modificar/">Modificar</a>
  </div>
  <h1>{idioma}</h1>
  <h2>Modificando idioma</h2>
  <form action="/admincp/idiomas/{id_idiomas}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN idioma_required -->
      <li><label for="idioma">Ingrese el idioma.</label></li>
<!-- END idioma_required -->
<!-- BEGIN abbr_required -->
      <li><label for="abbr">Ingrese la abreviaci&oacute;n del idioma.</label></li>
<!-- END abbr_required -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="idioma">Idioma</label></dt>
      <dd>
        <input type="text" name="idioma" id="idioma" size="59" maxlength="160" value="{idioma}" />
      </dd>

      <dt><label for="abbr">Abreviaci&oacute;n</label></dt>
      <dd>
        <input type="text" name="abbr" id="abbr" size="10" maxlength="3" value="{abbr}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_idiomas" id="id_idiomas" value="{id_idiomas}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/idiomas/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>