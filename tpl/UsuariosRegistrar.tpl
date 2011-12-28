<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/usuarios/registrar/">Registrarse</a>
  </div>
  <h1>Registrarse</h1>
  <h2>Registrarse como miembro en Libros de Hebe.</h2>
  <form action="/usuarios/registrar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Ingrese su nombre completo. Ej: Juan Manuel Mart&iacute;nez.</label></li>
<!-- END nombre_required -->
<!-- BEGIN clave_required -->
      <li><label for="clave">Ingrese la clave que desea utilizar para ingresar.</label></li>
<!-- END clave_required -->
<!-- BEGIN clave_rangeLength -->
      <li><label for="clave">Su clave debe tener m&aacute;s de 6 car&aacute;cteres y hasta 12 como m&aacute;ximo.</label></li>
<!-- END clave_rangeLength -->
<!-- BEGIN clave2_equalTo -->
      <li><label for="clave2">Las claves no concuerdan.</label></li>
<!-- END clave2_equalTo -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre Completo</label></dt>
      <dd>
        <input type="text" name="nombre" id="nombre" size="59" maxlength="96" value="{nombre}" />
        <span>Ej: Juan Manuel Mart&iacute;nez</span>
      </dd>

      <dd>{correo}
        <input type="hidden" name="correo" id="correo" value="{correo}" />
      </dd>

      <dt><label for="clave">Clave</label></dt>
      <dd>
        <input type="password" name="clave" id="clave" size="32" maxlength="160" />
      </dd>

      <dt><label for="clave2">Repetir Clave</label></dt>
      <dd>
        <input type="password" name="clave2" id="clave2" size="32" maxlength="160" />
        <span>Debe volver a escribir su clave</span>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Registrarse" />
        &oacute; <a href="/login/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>