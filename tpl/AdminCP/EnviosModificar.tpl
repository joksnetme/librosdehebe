<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
    DOMAssistant.DOMReady(function(){
        $('input#local').addEvent('click', function(){
            $('form dl .pais')[ this.checked ? 'removeClass' : 'addClass' ]('hidden');
        });
    });
/*]]>*/
</script>
<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/envios/">Formas de Env&iacute;o</a> &raquo;
    <a href="/admincp/envios/{id_envios}/">{nombre}</a> &raquo;
    <a href="/admincp/envios/{id_envios}/modificar/">Modificar</a>
  </div>
  <h1>Modificar {nombre}</h1>
  <h2>Modificando la forma de env&iacute;o</h2>
  <form action="/admincp/envios/{id_envios}/modificar/" method="post">
<!-- BEGIN validation -->
    <ul class="validation">
<!-- BEGIN nombre_required -->
      <li><label for="nombre">Falta el nombre de la forma de env&iacute;o.</label></li>
<!-- END nombre_required -->
<!-- BEGIN cantidad_tipo_required -->
      <li><label for="cantidad">Ingrese si la cantidad ejemplares es mayor, menor o igual.</label></li>
<!-- END cantidad_tipo_required -->
<!-- BEGIN cantidad_required -->
      <li><label for="cantidad2">Falta la cantidad de ejemplares.</label></li>
<!-- END cantidad_required -->
<!-- BEGIN entrega_required -->
      <li><label for="entrega">Ingrese la cantidad de d&iacute;as en el que se efectua la entrega.</label></li>
<!-- END entrega_required -->
<!-- BEGIN precio_required -->
      <li><label for="precio">Ingrese un precio en d&oacute;lares estaunidences.</label></li>
<!-- END precio_required -->
<!-- BEGIN precio_number -->
      <li><label for="precio">Ingrese un precio v&aacute;lido.</label></li>
<!-- END precio_number -->
<!-- BEGIN pais_required -->
      <li><label for="pais">Seleccione el pa&iacute;s.</label></li>
<!-- END pais_required -->
<!-- BEGIN done -->
      <li><label>Los datos de env&iacute;o fueron actualizados correctamente .</label></li>
<!-- END done -->
    </ul>
<!-- END validation -->
    <dl>
      <dt><label for="nombre">Nombre</label></dt>
      <dd><input type="text" name="nombre" id="nombre" value="{nombre}" size="40" maxlength="64" /></dd>

      <dt><label for="local">Local</label></dt>
      <dd><input type="checkbox" name="local" id="local" value="1"{localChecked} /></dd>

      <dt class="pais {classHidden}"><label for="pais">Pa&iacute;s</label></dt>
      <dd class="pais {classHidden}">
        <select name="pais" id="pais" >
          <option value="" class="">Seleccionar</option>
<!-- BEGIN paises -->
          <option value="{paises.id_paises}"{paises.selected}>{paises.pais}</option>
<!-- END paises -->
        </select>
      </dd>

      <dt><label for="cantidad">Cantidad</label></dt>
      <dd>
        <select name="cantidad_tipo" id="cantidad">
          <option value="="{igualSelected}>Igual a</option>
          <option value="<"{menorSelected}>Menor a</option>
          <option value=">"{mayorSelected}>Mayor a</option>
        </select>
        <input type="text" name="cantidad" id="cantidad2" value="{cantidad}" size="2" maxlength="3" />
        ejemplares
      </dd>

      <dt><label for="entrega">Entrega</label></dt>
      <dd>
        <input type="text" name="entrega" id="entrega" value="{entrega}" size="20" maxlength="64" />
        d&iacute;as laborables
      </dd>

      <dt><label for="precio">Precio</label></dt>
      <dd>
        <span class="precio big">u$s</span><input type="text" name="precio" id="precio" size="10" value="{precio}" />
      </dd>

      <dd class="only"><hr /></dd>
      <dd>
        <input type="submit" class="submit" name="save" value="Guardar" />
        &oacute; <a href="/admincp/envios/">Cancelar</a>
      </dd>
    </dl>
  </form>
</div>