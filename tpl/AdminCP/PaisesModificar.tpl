<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/paises/">Paises</a> &raquo;
    <a href="/admincp/paises/{id_paises}/">{Pais}</a> &raquo;
    <a href="/admincp/paises/{id_paises}/modificar/">Modificar</a>
  </div>
  <h1>Modificar {Pais}</h1>
  <h2>Modificar Pa&iacute;s</h2>
  <form action="/admincp/paises/{id_paises}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN pais_required -->
      <li><label for="pais">Ingrese el nombre del pa&iacute;s.</label></li>
<!-- END pais_required -->

<!-- BEGIN abbr_required -->
      <li><label for="abbr">Ingrese la abreviaci&oacute;n del pa&iacute;s.</label></li>
<!-- END abbr_required -->

<!-- BEGIN codigo_required -->
      <li><label for="codigo">Ingrese el c&oacute;digo del pa&iacute;s.</label></li>
<!-- END codigo_required -->

    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="pais">Pa&iacute;s</label></dt>
      <dd><input type="text" name="pais" id="pais" size="59" maxlength="160" value="{pais}" /></dd>
      
      <dt><label for="abbr">Abreviaci&oacute;n</label></dt>
      <dd><input type="text" name="abbr" id="abbr" size="10" maxlength="3" value="{abbr}" /></dd>
      
      <dt><label for="codigo">C&oacute;digo</label></dt>
      <dd>+ <input type="text" name="codigo" id="codigo" size="10" maxlength="10" value="{codigo}" /></dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/paises/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>