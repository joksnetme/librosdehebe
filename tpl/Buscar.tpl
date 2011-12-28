<div id="columnleft">
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/buscar/">Buscar</a>
  </div>

  <h1>Buscar</h1>
  <h2>Complete el formulario y presione el bot&oacute;n Buscar.</h2>
  <form action="/buscar/" method="post">
<!-- BEGIN not_found -->
    <div class="alert">
      <div>Lo sentimos, ning&uacute;n resultado se corresponde con sus criterios de b&uacute;squeda</div>
    </div>
<!-- END not_found -->
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN titulo_minLength -->
      <li><label for="titulo">Ingrese m&aacute;s de dos car&aacute;cteres para el t&iacute;tulo.</label></li>
<!-- END titulo_minLength -->
<!-- BEGIN autor_minLength -->
      <li><label for="autor">Ingrese m&aacute;s de dos car&aacute;cteres para el nombre del autor.</label></li>
<!-- END autor_minLength -->
<!-- BEGIN editorial_minLength -->
      <li><label for="editorial">Ingrese m&aacute;s de dos car&aacute;cteres para la editorial.</label></li>
<!-- END editorial_minLength -->
<!-- BEGIN keywords_minLength -->
      <li><label for="keywords">Ingrese m&aacute;s de dos car&aacute;cteres para las palabras claves.</label></li>
<!-- END keywords_minLength -->
<!-- BEGIN anho_number -->
      <li><label for="anho">El a&ntilde;o debe ser un n&uacute;mero.</label></li>
<!-- END anho_number -->
<!-- BEGIN anho_d_number -->
      <li><label for="anho_d">El a&ntilde;o inicial debe ser un n&uacute;mero.</label></li>
<!-- END anho_d_number -->
<!-- BEGIN anho_h_number -->
      <li><label for="anho_h">El a&ntilde;o final debe ser un n&uacute;mero.</label></li>
<!-- END anho_h_number -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="titulo">T&iacute;tulo</label></dt>
      <dd>
        <input type="text" name="titulo" id="titulo" size="59" maxlength="96" value="{titulo}" />
        <span>Ej: El canto del pajaro</span>
      </dd>

      <dt><label for="autor">Autor</label></dt>
      <dd>
        <input type="text" name="autor" id="autor" size="42" maxlength="96" value="{autor}" />
        <span>Ej: Anthony de Mello</span>
      </dd>

<!-- BEGIN buscar_rangoanho -->
      <dt><label for="anho_d">A&ntilde;o</label>, <label for="editorial">Editorial</label></dt>
      <dd>Publicado
          desde <input type="text" name="anho_d" id="anho_d" size="3" maxlength="4" value="{anho_d}" />
          hasta <input type="text" name="anho_h" id="anho_h" size="3" maxlength="4" value="{anho_h}" />
          por <input type="text" name="editorial" id="editorial" size="19" maxlength="96" value="{editorial}" />
<!-- END buscar_rangoanho -->
<!-- BEGIN no_buscar_rangoanho -->
      <dt><label for="anho">A&ntilde;o</label>, <label for="editorial">Editorial</label></dt>
      <dd>Publicado
          en <input type="text" name="anho" id="anho" size="3" maxlength="4" value="{anho}" />
          por <input type="text" name="editorial" id="editorial" size="29" maxlength="96" value="{editorial}" />
<!-- END no_buscar_rangoanho -->
      </dd>

      <dt><label for="keywords">Palabras Claves</label></dt>
      <dd>
        <input type="text" name="keywords" id="keywords" size="59" maxlength="96" value="{keywords}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="send" value="Buscar" />
      </dd>
    </dl>
  </form>
</div>
<div id="columnright">
{random}
</div>