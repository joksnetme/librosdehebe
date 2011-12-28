<div id="columnone">
  <form id="login" action="/login/" method="post">
<!-- BEGIN not_found -->
    <div class="alert">
      <div>Correo y clave no concuerdan !</div>
    </div>
<!-- END not_found -->
<!-- BEGIN not_found_mail -->
    <div class="alert">
      <div>El correo electr&oacute;nico ingresado no se encuentra !</div>
    </div>
<!-- END not_found_mail -->
<!-- BEGIN already_found -->
    <div class="alert">
      <div>El correo electr&oacute;nico ingresado ya existe !</div>
    </div>
<!-- END already_found -->
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN correo_required -->
      <li><label for="correo">Ingrese un correo electr&oacute;nico</label></li>
<!-- END correo_required -->
<!-- BEGIN correo_email -->
      <li><label for="correo">El correo electr&oacute;nico debe tener el formato <em>john@example.com</em></label></li>
<!-- END correo_email -->
<!-- BEGIN clave_required -->
      <li><label for="clave">Ingrese una clave</label></li>
<!-- END clave_required -->
<!-- BEGIN clave_rangeLength -->
      <li><label for="clave">La clave debe tener entre 6 y 12 car&aacute;cteres</label></li>
<!-- END clave_rangeLength -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="correo">Correo</label></dt>
      <dd><input type="text" name="correo" id="correo" value="{correo}" tabindex="1" size="36" /></dd>

      <dt class="input">
        <input type="radio" name="choice" value="login"
<!-- BEGIN checkedLogin -->
         checked="checked"
<!-- END checkedLogin -->
         class="checkbox" />
        <label for="clave">Clave</label>
      </dt>
      <dd><input type="password" name="clave" id="clave" value="{clave}" tabindex="2" size="36" /></dd>

      <dt class="only input">
        <input type="radio" name="choice" id="register" value="register"
<!-- BEGIN checkedRegister -->
         checked="checked"
<!-- END checkedRegister -->
         class="checkbox" />
        <label for="register">Soy un nuevo usuario.</label>
      </dt>

      <dt class="only input">
        <input type="radio" name="choice" id="password" value="password"
<!-- BEGIN checkedPassword -->
         checked="checked"
<!-- END checkedPassword -->
         class="checkbox" />
        <label for="password">Me olvid&eacute; la clave.</label>
      </dt>

      <dd class="submit"><input type="submit" class="submit" value="Continuar" tabindex="3" /></dd>
    </dl>
  </form>
</div>