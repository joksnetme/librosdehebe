<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/modulos/">M&oacute;dulos</a>
  </div>
  <h1>M&oacute;dulos</h1>
  <h2>Listado con todos los modulos disponibles.</h2>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN done -->
    <li><label>Estado de m&oacute;dulos actualizados.</label></li>
<!-- END done -->
  </ul>
<!-- END validation -->
  <form action="/admincp/modulos/" method="post">
    <dl>
      <dt><label for="buscar_javascript">B&uacute;squeda <sup>Beta</sup></label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="buscar_javascript" id="buscar_javascript"{buscar_javascript_checked} value="1" />
        <p class="inline">Realizada completamente JavaScript&trade;. Al posicionar el mouse sobre cada libro, este se marca y se muestra en la columna de la derecha toda la descripci&oacute;n.</p>
      </dd>

      <dt><label for="buscar_sinonimos">Sin&oacute;nimos</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="buscar_sinonimos" id="buscar_sinonimos"{buscar_sinonimos_checked} value="1" />
        <p class="inline">Utilizar sin&oacute;nimos al indexar. Esto genera que en la b&uacute;squeda al buscar por una palabra que no se encuentre en ning&uacute;n campo de libros, pero si su sin&oacute;nimo, este aparecer&aacute; igual.</p>
      </dd>

      <dt><label for="buscar_rangoanho">Rango de A&ntilde;os</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="buscar_rangoanho" id="buscar_rangoanho"{buscar_rangoanho_checked} value="1" />
        <p class="inline">Al estar tildado, aparecer&aacute; un desde-hasta a&ntilde;os en las opciones de b&uacute;squeda. Si no est&aacute; tildado, la b&uacute;squeda se hace por un a&ntilde;o en concreto.</p>
      </dd>

      <dt><label for="specialchars">Car&aacute;cteres</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="specialchars" id="specialchars"{specialchars_checked} value="1" />
        <p class="inline">No tiene influencia en la vista del usuario. Muestra una barra de idioma arriba de cada texto multilinea con los car&aacute;cteres del idioma espa&ntilde;ol m&aacute;s utilizados.</p>
      </dd>

      <dt><label for="libros_colecciones">Colecciones</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="libros_colecciones" id="libros_colecciones"{libros_colecciones_checked} value="1" />
        <p class="inline">Cargar colecciones a los libros. Aparecer&aacute; en el agregar y modificar libro un campo nuevo llamado Colecci&oacute;n. Este campo se podr&aacute; indexar y aparecer&aacute; en la ficha de cada libro.</p>
      </dd>

      <dt><label for="libros_ofertar">Ofertar</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="libros_ofertar" id="libros_ofertar"{libros_ofertar_checked} value="1" />
        <p class="inline">Habilitar la posibilidad que los usuarios oferten un precio por cada libro. Estas ofertas le aparecer&aacute;n para aprobar o rechazar en el ACP.</p>
      </dd>

      <dt><label for="libros_cantidades">Cantidades</label></dt>
      <dd>
        <input type="checkbox" class="checkbox" name="libros_cantidades" id="libros_cantidades"{libros_cantidades_checked} value="1" />
        <p class="inline">Poder cargar m&aacute;s de un ejemplar por libro por cada libreria. Esto dejar&aacute; que se pueda elegir la cantidad en el carrito de compras.</p>
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" value="Guardar" />
        &oacute; <a href="/admincp/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>