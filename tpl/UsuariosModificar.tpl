<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/">Usuarios</a> &raquo;
    <a href="/usuarios/{id_usuarios}/">{nombre}</a> &raquo;
    <a href="/usuarios/{id_usuarios}/modificar/">Modificar</a>
  </div>
  <h1>{nombre}</h1>
  <h2>Modificando usuario.</h2>
  <form action="/usuarios/{id_usuarios}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese su nombre completo. Ej: Juan Manuel Mart&iacute;nez.</label></li>
<!-- END nombre_required -->
<!-- BEGIN clave_rangeLength -->
      <li><label for="clave">La clave debe tener entre 6 y 12 car&aacute;cteres.</label></li>
<!-- END clave_rangeLength -->
<!-- BEGIN clave2_equalTo -->
      <li><label for="clave2">Las claves no concuerdan. Tenga en cuenta que si deja el campo clave vac&iacute;o, este no se actualizar&aacute;.</label></li>
<!-- END clave2_equalTo -->
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
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre Completo</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="96" value="{nombre}" />
        <span>Ej: Juan Manuel Mart&iacute;nez</span>
      </dd>

      <dt><label>Correo</label></dt>
      <dd>{correo}</dd>

      <dt><label for="clave">Clave</label></dt>
      <dd>
        <input type="password" name="clave" id="clave" size="32" maxlength="160" />
        <span>Si deja este campo en blanco, su clave no se modificar&aacute;</span>
      </dd>

      <dt><label for="clave2">Repetir Clave</label></dt>
      <dd>
        <input type="password" name="clave2" id="clave2" size="32" maxlength="160" />
        <span>Si completa el campo de arriba, debe repetir su clave</span>
      </dd>

<!-- BEGIN datos -->
      <dd class="only">
<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { $('select#pais').addEvent('change', function() { $$('codigoPais').innerHTML = "+" + this.options[ this.selectedIndex ].getAttribute('class').replace(/\D/g, ''); }); });/*]]>*/</script>
        <hr />
      </dd>

      <dd>Ingrese los datos donde desea recibir sus libros.</dd>

      <dt><label for="pais">Pa&iacute;s</label></dt>
      <dd>
        <select name="pais" id="pais" >
          <option value="" class="">Seleccionar</option>
<!-- BEGIN paises -->
          <option value="{datos.paises.id_paises}" class="c{datos.paises.codigo}"{datos.paises.selected}>{datos.paises.pais}</option>
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
<!-- END datos -->
<!-- BEGIN librerias -->
      <dd class="only"><hr /></dd>
      <dd>Seleccione la Libreria a la cual pertenece.</dd>
      
      <dt><label for="libreria">Libreria</label></dt>
      <dd>
        <select name="libreria" id="libreria">
<!-- BEGIN options -->
          <option value="{librerias.options.id_librerias}"{librerias.options.selected}>{librerias.options.libreria}</option>
<!-- END options -->
        </select>
      </dd>
<!-- END librerias -->

      <dd class="only"><hr /></dd>
      <dd>
        <input type="hidden" name="id_usuarios" id="id_usuarios" value="{id_usuarios}" />
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/usuarios/{id_usuarios}/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>
<div id="columnright">
{random}
</div>