<script type="text/javascript" src="/js/domassistant.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
    DOMAssistant.DOMReady(function(){

        if ( 'ActiveXObject' in window ){
        
            var height = document.body.clientHeight;
            var width  = document.body.clientWidth;
            
            $('div#background').setStyle({height: height + 'px', width: width + 'px'})
            $('div#backgroundDisplay').setStyle({height: height + 'px', width: width + 'px'})
        }

        var last = $('ul.listImages li a');
        
        $('ul.listImages li a').addEvent('click', function(){
        
            last.removeClass('selected');
            $(this).addClass('selected');
                
            var img    = $('img#img');
            var imgSrc = img[0].getAttribute('src');
            var romano = this.innerHTML.toLowerCase();
            img[0].setAttribute('src', imgSrc.replace(/[ivxlcd]+\./g, romano + '.'));
            
            last = this;
            
            return false;
        });
        
        $('div.bookImage > a').addEvent('click', function(){
            var img = $('div.bookImage > a > img');
            var src = img[0].getAttribute('src');
            
            $('div#backgroundDisplay a img')[0].setAttribute('src', src.replace(/250x330\//g, ''));
            $('div#background, div#backgroundDisplay').removeClass('hidden');
            
            return false;
        });
        
        $('div#backgroundDisplay a').addEvent('click', function(){
            $('div#background, div#backgroundDisplay').addClass('hidden');
            
            return false;
        });
        
        
        $('div#columnright.bookPrice ul li a.r').addEvent('click', function(){

            var recomendar = $('li#recomendar');
            
            if ( recomendar.hasClass('hidden')[0] ){
            
                recomendar.removeClass('hidden');
                $(this).addClass('selected');
                
            }
            else {
                recomendar.addClass('hidden');
                $(this).removeClass('selected');
            }

            return false;
        });
    });
/*]]>*/
</script>

<div id="columnleft">
  <h1>{titulo}</h1>
  <h2>Viendo un libro de {autor}
<!-- BEGIN anho -->
  publicado en {anho}
<!-- END anho -->
  por {editorial}.</h2>

  <div class="left center bookImage">
    <a href="#">
      <img src="{imagen}" alt="{titulo}" id="img" />
    </a>
    <ul class="listImages">
<!-- BEGIN romanos -->
        <li><a href="#" class="{romanos.class}">{romanos.numero}</a></li>
<!-- END romanos -->
    </ul>
  </div>
  <div class="left bookInfo">
    <ul>
      <li><span>Por <a href="/buscar/{autorUri}" title="{autor}">{autor}</a></span></li>
      <li><span>Publicado
<!-- BEGIN anho -->
      en {anho}
<!-- END anho -->
      por <a href="/buscar/{editorialUri}" title="{editorial}">{editorial}</a></span></li>
      <li><span>
<!-- BEGIN isbn -->
      ISBN {isbn},
<!-- END isbn -->
      {tomos} tomo{s}, {paginas} p&aacute;ginas</span></li>
      <li><span>
<!-- BEGIN coleccion -->
      Colecci&oacute;n <a href="/buscar/{coleccionUri}" title="{coleccion}">{coleccion}</a>
<!-- END coleccion -->
      en {idioma}</span></li>
    </ul>

    <ul class="tabs">
      <li><a href="#" class="active">Sinopsis</a></li>
    </ul>
    <div class="clear"><!-- --></div>
    <div class="tabsContent">
      {sinopsis}
    </div>
  </div>
  <div class="clear"><!-- --></div>
</div>
<div id="columnright" class="bookPrice">
  <div class="details">
    <div class="pusrchase">
<!-- BEGIN ofertar -->
      <form action="/carrito/ofertar/" method="post">
        <dl>
          <dt><big><span class="precio">u$s</span></big></dt>
          <dd>
            <input type="hidden" name="id_libros" id="id_libros" value="{id_libros}" />
            <input type="text" name="oferta" size="4" value="{precio}" maxlength="6" />
            <input type="submit" class="submit" name="ofertar" value="Ofertar" />
          </dd>
        </dl>
      </form>
      &oacute; <a href="/carrito/{id_libros}/agregar/">comprar por <span class="precio">u$s</span> {precio} inmediatamente</a>.
<!-- END ofertar -->
<!-- BEGIN fijo -->
      <form action="/carrito/agregar/" method="post">
        <dl>
          <dt><big><span class="precio">u$s</span></big></dt>
          <dd><big>{precio}</big>
            <input type="hidden" name="id_libros" id="id_libros" value="{id_libros}" />
            <input type="submit" class="submit" name="comprar" value="Comprar" />
          </dd>
        </dl>
      </form>
<!-- END fijo -->
    </div>
  </div>
  <ul>
<!-- BEGIN deseo -->
    <li><a href="/usuarios/{id_usuarios}/deseos/{id_libros}/">Agregar a mi lista de deseos</a></li>
<!-- END deseo -->
    <li>
    <a href="#" class="r">Comentale a un amigo</a>
    </li>
    <li id="recomendar" class="hidden">
        <form action="{uri}" method="post">
            <dl>
                <dt><label for="tunombre">Tu nombre</label></dt>
                <dd><input type="text" name="tunombre" id="tunombre" value="{nombre}" /></dd>
                <dt><label for="tucorreo">Tu correo</label></dt>
                <dd><input type="text" name="tucorreo" id="tucorreo" value="{correo}" /></dd>
                <dt><label for="sunombre">Su nombre</label></dt>
                <dd><input type="text" name="sunombre" id="sunombre" /></dd>
                <dt><label for="sucorreo">Su correo</label></dt>
                <dd><input type="text" name="sucorreo" id="sucorreo" /></dd>
                <dt><label for="mensaje">Mensaje</label></dt>
                <dd class="only"><textarea name="mensaje" id="mensaje" rows="2" cols="34">{mensaje}</textarea></dd>
                <dd class="only"><hr /></dd>
                <dd class="only center"><input type="submit" name="comentar" class="submit" value="Comentar" /></dd>
            </dl>
        </form>
    </li>
  </ul>
  <div class="clear"><!-- --></div>
<!-- BEGIN validation -->
  <ul class="validation">
<!-- BEGIN tunombre_required -->
    <li><label for="tunombre">Falta tu nombre.</label></li>
<!-- END tunombre_required -->
<!-- BEGIN tucorreo_required -->
    <li><label for="tucorreo">Falta tu correo.</label></li>
<!-- END tucorreo_required -->
<!-- BEGIN sunombre_required -->
    <li><label for="sunombre">Falta su nombre.</label></li>
<!-- END sunombre_required -->
<!-- BEGIN sucorreo_required -->
    <li><label for="sucorreo">Falta su correo.</label></li>
<!-- END sucorreo_required -->
  </ul>
<!-- END validation -->
</div>
<div class="clear"><!-- --></div>
<div id="background" class="hidden"><!-- --></div>
<div id="backgroundDisplay" class="hidden">
    <a href="#">
        <img src="{imagenGrande}" alt="" />
    </a>
</div>
