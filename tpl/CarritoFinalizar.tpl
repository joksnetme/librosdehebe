<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">/*<![CDATA[*/DOMAssistant.DOMReady(function() { $('select#pais').addEvent('change', function() { $$('codigoPais').innerHTML = "+" + this.options[ this.selectedIndex ].getAttribute('class').replace(/\D/g, ''); }); });/*]]>*/</script>
<div class="finalizarCarrito">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/carrito/">Carrito de Compras</a>
  </div>
  <h1>Carrito de Compras</h1>
  <h2>Sus libro por comprar.</h2>
  <div class="line">
    <ul>
        <li class="first previous">1. Carrito</li>
        <li class="active">2. Informaci&oacute;n</li>
        <li>3. Forma de Pago y Env&iacute;o</li>
        <li class="last">4. Revisar y Realizar el Pedido</li>
    </ul>
    <div class="clear"><!-- --></div>
  </div>
  <form action="/carrito/finalizar/{prevCompra}" method="post">
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN r_correo_email -->
    <li><label>Ingrese una direcci&oacute;n de correo electr&oacute;nico v&aacute;lida.</label></li>
<!-- END r_correo_email -->
<!-- BEGIN r_clave_required -->
    <li><label>Ingrese una clave.</label></li>
<!-- END r_clave_required -->
<!-- BEGIN r_clave_rangeLength -->
    <li><label>La clave debe tener de 6 a 12 digitos de longitud.</label></li>
<!-- END r_clave_rangeLength -->
<!-- BEGIN r_clave2_equalTo -->
    <li><label>Las claves no coinciden.</label></li>
<!-- END r_clave2_equalTo -->
<!-- BEGIN nombre_required -->
    <li><label>Ingrese su nombre.</label></li>
<!-- END nombre_required -->
<!-- BEGIN pais_required -->
    <li><label>Seleccione su pa&iacute;s.</label></li>
<!-- END pais_required -->
<!-- BEGIN estado_required -->
    <li><label>Ingrese su estado/provincia.</label></li>
<!-- END estado_required -->
<!-- BEGIN ciudad_required -->
    <li><label>Ingrese su ciudad/localidad.</label></li>
<!-- END ciudad_required -->
<!-- BEGIN direccion_required -->
    <li><label>Ingrese su direcci&oacute;n.</label></li>
<!-- END direccion_required -->
<!-- BEGIN codigoArea_required -->
    <li><label>Ingrese su c&oacute;digo de &aacute;rea.</label></li>
<!-- END codigoAreao_required -->
<!-- BEGIN telefono_required -->
    <li><label>Ingrese su tel&eacute;fono.</label></li>
<!-- END telefono_required -->
<!-- BEGIN cp_required -->
    <li><label>Ingrese su c&oacute;digo postal.</label></li>
<!-- END cp_required -->
<!-- BEGIN correo_required -->
    <li><label>Ingrese su correo.</label></li>
<!-- END correo_required -->
<!-- BEGIN correo_email -->
    <li><label>Ingrese una direcci&oacute; de correo electr&oacute;nico v&aacute;lida.</label></li>
<!-- END correo_email -->
<!-- BEGIN clave_required -->
    <li><label>Ingrese su clave</label></li>
<!-- END clave_required -->
<!-- BEGIN clave_rangeLength -->
    <li><label>Ingrese una clave de 6 a 12 digitos.</label></li>
<!-- END clave_required -->
  </ul>
<!-- END validation -->
<!-- BEGIN registerLogin -->
    <div class="left">
      <h3>&iquest; Ya sos miembro ?</h3>
        <dl>
          <dt><label for="correo">Correo</label></dt>
          <dd><input type="text" name="correo" id="correo" size="36" /></dd>
          <dt><label for="clave">Clave</label></dt>
          <dd><input type="password" name="clave" id="clave" size="36" /></dd>
        </dl>
    </div>
    <div class="left register">
      <h3>Registrate Gratis!</h3>
        <dl>
          <dt><label for="r_correo">Correo</label></dt>
          <dd><input type="text" name="r_correo" id="r_correo" size="36" /></dd>
          <dt><label for="r_clave">Clave</label></dt>
          <dd><input type="password" name="r_clave" id="r_clave" size="36" /></dd>
          <dt><label for="r_clave2">Repetir Clave</label></dt>
          <dd><input type="password" name="r_clave2" id="r_clave2" size="36" /></dd>
        </dl>
    </div>
    <div class="clear"><!-- --></div>
<!-- END registerLogin -->
    <div class="datos">
      <dl>
        <dt><label for="nombre">Nombre Completo</label></dt>
        <dd><input type="text" name="nombre" id="nombre" value="{nombre}" size="50" /></dd>

        <dt><label for="pais">Pa&iacute;s</label></dt>
        <dd>
          <select name="pais" id="pais">
            <option value="">Seleccionar</option>
<!-- BEGIN paises -->
            <option value="{paises.id_paises}" class="c{paises.codigo}"{paises.selected}>{paises.pais}</option>
<!-- END paises -->
          </select>
        </dd>

        <dt><label for="estado">Estado/Provincia</label></dt>
        <dd><input type="text" name="estado" id="estado" value="{estado}" size="50" /></dd>

        <dt><label for="ciudad">Ciudad/Localidad</label></dt>
        <dd><input type="text" name="ciudad" id="ciudad" value="{ciudad}" size="50" /></dd>

        <dt><label for="direccion">Direcci&oacute;n</label></dt>
        <dd><input type="text" name="direccion" id="direccion" value="{direccion}" size="50" /></dd>
        <dd><input type="text" name="direccion2" id="direccion2" value="{direccion2}" size="50" /></dd>

        <dt><label for="telefono">Tel&eacute;fono</label></dt>
        <dd>
          <big id="codigoPais">+{codigoPais}</big>
          <input type="text" maxlength="5" size="2" value="{codigoArea}" id="codigoArea" name="codigoArea" />
          <input type="text" maxlength="20" size="38" value="{telefono}" id="telefono" name="telefono" />
        </dd>

        <dt><label for="cp">C&oacute;digo Postal</label></dt>
        <dd><input type="text" name="cp" id="cp" value="{cp}" size="20" /></dd>

        <dd class="only"><hr /></dd>
        <dd>
          <input type="submit" class="submit" name="save" value="Siguiente" />
<!-- BEGIN anterior -->
          &oacute; <a href="/carrito/">Anterior</a>
<!-- END anterior -->
<!-- BEGIN cancelar -->
          &oacute; <a href="/carrito/finalizar/{cancelar.id_compras}/2/">Cancelar</a>
<!-- END cancelar -->
        </dd>
      </dl>
    </div>
  </form>
</div>
