<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { $('select#pais').addEvent('change', function() { $$('codigoPais').innerHTML = "+" + this.options[ this.selectedIndex ].getAttribute('class').replace(/\D/g, ''); }); });/*]]>*/</script>
<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usercp/">Mi Cuenta</a> &raquo;
    <a href="/usercp/datos/">Datos de Env&iacute;o</a>
  </div>
  <h1>Datos de Env&iacute;o</h1>
  <h2>Sin estos datos no podremos enviarle sus libros. Podr&aacute; modificarlos durante el proceso de compra.</h2>
  <form action="/usercp/datos/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN pais_required -->
      <li><label for="pais">Falta el pa&iacute;s.</label></li>
<!-- END pais_required -->
<!-- BEGIN estado_required -->
      <li><label for="estado">Falta el estado.</label></li>
<!-- END estado_required -->
<!-- BEGIN ciudad_required -->
      <li><label for="ciudad">Falta la ciudad.</label></li>
<!-- END ciudad_required -->
<!-- BEGIN direccion1_required -->
      <li><label for="direccion1">Falta la direcci&oacute;n.</label></li>
<!-- END direccion1_required -->
<!-- BEGIN codigoArea_required -->
      <li><label for="codigoArea">Falta el c&oacute;digo de &aacute;rea.</label></li>
<!-- END codigoArea_required -->
<!-- BEGIN telefono_required -->
      <li><label for="telefono">Falta el tel&eacute;fono.</label></li>
<!-- END telefono_required -->
<!-- BEGIN cp_required -->
      <li><label for="cp">Falta el c&oacute;digo postal.</label></li>
<!-- END cp_required -->
<!-- BEGIN done -->
      <li><label>Los datos de env&iacute;o fueron actualizados correctamente.</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="pais">Pa&iacute;s</label></dt>
      <dd>
        <select name="pais" id="pais" >
          <option value="" class="">Seleccionar</option>
<!-- BEGIN paises -->
          <option value="{paises.id_paises}" class="c{paises.codigo}"{paises.selected}>{paises.pais}</option>
<!-- END paises -->
        </select>
      </dd>

      <dt><label for="estado">Estado/Provincia</label></dt>
      <dd>
        <input type="text" name="estado" id="estado" size="40" maxlength="100" value="{estado}" />
        <span>Ej: Capital Federal</span>
      </dd>

      <dt><label for="ciudad">Ciudad/Localidad</label></dt>
      <dd>
        <input type="text" name="ciudad" id="ciudad" size="40" maxlength="100" value="{ciudad}" />
        <span>Ej: Congreso</span>
      </dd>

      <dt><label for="direccion1">Direcci&oacute;n</label></dt>
      <dd>
        <input type="text" name="direccion1" id="direccion1" size="50" maxlength="100" value="{direccion1}" />
      </dd>
      <dd>
        <input type="text" name="direccion2" id="direccion2" size="50" maxlength="100" value="{direccion2}" />
      </dd>

      <dt><label for="telefono">Tel&eacute;fono</label></dt>
      <dd>
        <big id="codigoPais">+{codigo}</big>
        <input type="text" name="codigoArea" id="codigoArea" value="{codigoArea}" size="2" maxlength="5" />
        <input type="text" name="telefono" id="telefono" size="23" maxlength="20" value="{telefono}" />
      </dd>

      <dt><label for="cp">C&oacute;digo Postal</label></dt>
      <dd>
        <input type="text" name="cp" id="cp" size="20" maxlength="20" value="{cp}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/usercp/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>
<div id="columnright">
{random}
</div>