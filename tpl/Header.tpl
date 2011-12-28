<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Libros de Hebe &raquo; {title}</title>
  <meta http-equiv="imagetoolbar" content="no" />
  <link rel="shortcut icon" href="/favicon.ico" />
  <style type="text/css">
  /*<![CDATA[*/
    @import '/css/screen.css';
  /*]]>*/
  </style>
</head>

<body>
  <div id="wrap">
    <div id="header">
      <h1><span>Libros de Hebe</span></h1>
    </div>
    <div id="nav">
      <ul>
        <li class="{NavInicioClass}"><a href="/" title="Inicio">Inicio</a></li>
        <li class="{NavBuscarClass}"><a href="/buscar/" title="Buscar">Buscar</a></li>
        <li class="{NavPreguntasFrecuentesClass}"><a href="/faq/" title="Preguntas Frecuentes">Preguntas Frecuentes</a></li>
        <!-- li class="{NavQuienesSomosClass}"><a href="/quienes+somos/" title="Quienes Somos">Quienes Somos</a></li -->
        <li class="{NavCarritoClass}"><a href="/carrito/" title="Carrito de Compras">Carrito</a></li>
<!-- BEGIN ifLogin -->
        <li class="{NavMiCuentaClass}"><a href="/usercp/" title="Mi Cuenta">Mi Cuenta</a></li>
        <!-- li class="{NavLogoutClass}"><a href="/logout/" title="Salir">Salir</a></li -->
<!-- END ifLogin -->
<!-- BEGIN ifAdmin -->
        <li class="{NavPanelDeControlClass}"><a href="/admincp/" title="Panel de Control">ACP</a></li>
<!-- END ifAdmin -->
<!-- BEGIN ifNLogin -->
        <li class="{NavLoginClass}"><a href="/login/" title="Ingresar">Ingresar</a></li>
<!-- END ifNLogin -->
        <li class="{NavBlogClass}"><a href="/blog/" title="Blog">Blog</a></li>
        <li class="{NavContactoClass}"><a href="/contacto/" title="Contacto">Contacto</a></li>
      </ul>
      <div class="clear"><!-- --></div>
    </div>
    <div id="container">
      <div id="content">