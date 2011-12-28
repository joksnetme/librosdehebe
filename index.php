<?php

$urls = array(
  # '^/$' => 'Main',

    '^/$'            => 'ComingSoon',
    '^/newsletter/$' => 'Newsletter',

    '^/libros/(.+)/$'     => 'Libros',

    '^/buscar/$'          => 'Buscar',
    '^/buscar/(error)/$'  => 'Buscar',
  # '^/buscar/avanzado/$' => 'BuscarAvanzado',
    '^/buscar/(.+)/$'     => 'BuscarResultados',

    '^/faq/$'            => 'Faq',
    '^/quienes\+somos/$' => 'QuienesSomos',

    '^/contacto/$'         => 'Contacto',
    '^/contacto/gracias/$' => 'ContactoGracias',

    '^/login/$'  => 'Login',
    '^/logout/$' => 'Logout',

    '^/usuarios/$'                 => 'Usuarios',
    '^/usuarios/registrar/$'       => 'UsuariosRegistrar',

    '^/usuarios/(\d+)/$'           => 'UsuariosVer',
    '^/usuarios/(\d+)/(done)/$'    => 'UsuariosVer',
    '^/usuarios/(\d+)/modificar/$' => 'UsuariosModificar',

    '^/usuarios/(\d+)/deseos/$'               => 'UsuariosDeseos',
    '^/usuarios/(\d+)/deseos/(done)/$'        => 'UsuariosDeseos',
    '^/usuarios/(\d+)/deseos/(\d+)/borrar/$'  => 'UsuariosDeseosBorrar',
    '^/usuarios/(\d+)/deseos/(\d+)/$'         => 'UsuariosDeseosAgregar',
    
    '^/usuarios/(\d+)/carrito/$'              => 'UsuariosCarrito',
    

    '^/admincp/$'                        => 'AdminCP_Main',
    '^/admincp/stats/$'                  => 'AdminCP_Stats',

    '^/admincp/noticias/$'                 => 'AdminCP_Noticias',
    '^/admincp/noticias/(done)/$'          => 'AdminCP_Noticias',
    '^/admincp/noticias/(\d+)/$'           => 'AdminCP_NoticiasVer',
    '^/admincp/noticias/agregar/$'         => 'AdminCP_NoticiasAgregar',
    '^/admincp/noticias/(\d+)/modificar/$' => 'AdminCP_NoticiasModificar',

    '^/admincp/modulos/$'                => 'AdminCP_Modulos',
    '^/admincp/modulos/(done)/$'         => 'AdminCP_Modulos',

    '^/admincp/libros/$'                 => 'AdminCP_Libros',
    '^/admincp/libros/(error)/$'         => 'AdminCP_Libros',

    '^/admincp/libros/agregar/$'         => 'AdminCP_LibrosAgregar',
    '^/admincp/libros/agregar/(done)/$'  => 'AdminCP_LibrosAgregar',

    '^/admincp/libros/tapas/$'           => 'AdminCP_LibrosTapasBatch',
    '^/admincp/libros/tapas/(done)/$'    => 'AdminCP_LibrosTapasBatch',

    '^/admincp/libros/indexar/$'         => 'AdminCP_LibrosIndexar',
    '^/admincp/libros/indexar/(done)/$'  => 'AdminCP_LibrosIndexar',

    '^/admincp/libros/(\d+)/$'           => 'AdminCP_LibrosVer',
    '^/admincp/libros/(\d+)/(done)/$'    => 'AdminCP_LibrosVer',

    '^/admincp/libros/(\d+)/modificar/$'        => 'AdminCP_LibrosModificar',
    '^/admincp/libros/(\d+)/modificar/(done)/$' => 'AdminCP_LibrosModificar',

    '^/admincp/libros/(\d+)/modificar/(autor|editorial|coleccion)/$' => 'AdminCP_LibrosModificarRelaciones',

    '^/admincp/libros/(\d+)/tapas/$'                     => 'AdminCP_LibrosTapas',
    '^/admincp/libros/(\d+)/tapas/agregar/$'             => 'AdminCP_LibrosTapasAgregar',
    '^/admincp/libros/(\d+)/tapas/(done)/$'              => 'AdminCP_LibrosTapas',
    '^/admincp/libros/(\d+)/tapas/([ivxlcdm]*)/borrar/$' => 'AdminCP_LibrosTapasBorrar',

    '^/admincp/libros/(.+)/$'            => 'AdminCP_LibrosBuscar',

    '^/admincp/contacto/$'               => 'AdminCP_Contacto',
    '^/admincp/contacto/(read|unread)/$' => 'AdminCP_Contacto',
    '^/admincp/contacto/(error)/$'       => 'AdminCP_Contacto',
    '^/admincp/contacto/(\d+)/$'         => 'AdminCP_ContactoVer',

    '^/admincp/autores/$'                 => 'AdminCP_Autores',
    '^/admincp/autores/(done)/$'          => 'AdminCP_Autores',
    '^/admincp/autores/(error)/$'         => 'AdminCP_Autores',

    '^/admincp/autores/(\d+)/$'           => 'AdminCP_AutoresVer',
    '^/admincp/autores/(\d+)/(done)/$'    => 'AdminCP_AutoresVer',
    '^/admincp/autores/(\d+)/modificar/$' => 'AdminCP_AutoresModificar',

    '^/admincp/editoriales/$'                 => 'AdminCP_Editoriales',
    '^/admincp/editoriales/(done)/$'          => 'AdminCP_Editoriales',
    '^/admincp/editoriales/(error)/$'         => 'AdminCP_Editoriales',

    '^/admincp/editoriales/(\d+)/$'           => 'AdminCP_EditorialesVer',
    '^/admincp/editoriales/(\d+)/(done)/$'    => 'AdminCP_EditorialesVer',
    '^/admincp/editoriales/(\d+)/modificar/$' => 'AdminCP_EditorialesModificar',

    '^/admincp/colecciones/$'                 => 'AdminCP_Colecciones',
    '^/admincp/colecciones/(done)/$'          => 'AdminCP_Colecciones',
    '^/admincp/colecciones/(error)/$'         => 'AdminCP_Colecciones',

    '^/admincp/colecciones/(\d+)/$'           => 'AdminCP_ColeccionesVer',
    '^/admincp/colecciones/(\d+)/(done)/$'    => 'AdminCP_ColeccionesVer',
    '^/admincp/colecciones/(\d+)/modificar/$' => 'AdminCP_ColeccionesModificar',

    '^/admincp/faq/$'                 => 'AdminCP_Faq',
    '^/admincp/faq/(error)/$'         => 'AdminCP_Faq',

    '^/admincp/faq/(\d+)/$'           => 'AdminCP_FaqVer',
    '^/admincp/faq/(\d+)/(done)/$'    => 'AdminCP_FaqVer',
    '^/admincp/faq/(\d+)/modificar/$' => 'AdminCP_FaqModificar',

    '^/admincp/faq/categorias/$'                 => 'AdminCP_FaqCategorias',
    '^/admincp/faq/categorias/(error)/$'         => 'AdminCP_FaqCategorias',
    '^/admincp/faq/categorias/(done)/$'          => 'AdminCP_FaqCategorias',
    '^/admincp/faq/categorias/agregar/$'         => 'AdminCP_FaqCategoriasAgregar',

    '^/admincp/faq/categorias/(\d+)/$'           => 'AdminCP_FaqCategoriasVer',
    '^/admincp/faq/categorias/(\d+)/(done)/$'    => 'AdminCP_FaqCategoriasVer',

    '^/admincp/faq/categorias/(\d+)/agregar/$'   => 'AdminCP_FaqCategoriasAgregarPregunta',
    '^/admincp/faq/categorias/(\d+)/modificar/$' => 'AdminCP_FaqCategoriasModificar',

    '^/admincp/sinonimos/$'         => 'AdminCP_Sinonimos',
    '^/admincp/sinonimos/(done)/$'  => 'AdminCP_Sinonimos',
    '^/admincp/sinonimos/agregar/$' => 'AdminCP_SinonimosAgregar',

    '^/admincp/envios/$'                 => 'AdminCP_Envios',
    '^/admincp/envios/(done)/$'          => 'AdminCP_Envios',
    '^/admincp/envios/agregar/$'         => 'AdminCP_EnviosAgregar',
    '^/admincp/envios/(\d+)/borrar/$'    => 'AdminCP_EnviosBorrar',
    '^/admincp/envios/(\d+)/modificar/$' => 'AdminCP_EnviosModificar',

    '^/admincp/librerias/$'                            => 'AdminCP_Librerias',
    '^/admincp/librerias/(done)/$'                     => 'AdminCP_Librerias',
    '^/admincp/librerias/agregar/$'                    => 'AdminCP_LibreriasAgregar',
    '^/admincp/librerias/(\d+)/$'                      => 'AdminCP_LibreriasVer',
    '^/admincp/librerias/(\d+)/(done)/$'               => 'AdminCP_LibreriasVer',
    '^/admincp/librerias/(\d+)/modificar/$'            => 'AdminCP_LibreriasModificar',
    '^/admincp/librerias/(\d+)/stock/$'                => 'AdminCP_LibreriasStock',
    '^/admincp/librerias/(\d+)/stock/(\d+)/cambiar/$'  => 'AdminCP_LibreriasStockCambiar',
    
    '^/admincp/amigos/$'                      => 'AdminCP_Amigos',
    '^/admincp/amigos/(\d+)/$'                => 'AdminCP_AmigosVer',

    '^/admincp/paises/$'                      => 'AdminCP_Paises',
    '^/admincp/paises/(done)/$'               => 'AdminCP_Paises',
    '^/admincp/paises/agregar/$'              => 'AdminCP_PaisesAgregar',
    '^/admincp/paises/(\d+)/modificar/$'      => 'AdminCP_PaisesModificar',

    '^/admincp/idiomas/$'                     => 'AdminCP_Idiomas',
    '^/admincp/idiomas/(done)/$'              => 'AdminCP_Idiomas',
    '^/admincp/idiomas/(\d+)/$'               => 'AdminCP_IdiomasVer',
    '^/admincp/idiomas/agregar/$'             => 'AdminCP_IdiomasAgregar',
    '^/admincp/idiomas/(\d+)/modificar/$'     => 'AdminCP_IdiomasModificar',

    '^/admincp/pagos/$'                       => 'AdminCP_Pagos',
    '^/admincp/pagos/(done)/$'                => 'AdminCP_Pagos',
    '^/admincp/pagos/(\d+)/$'                 => 'AdminCP_PagosVer',
    '^/admincp/pagos/agregar/$'               => 'AdminCP_PagosAgregar',
    '^/admincp/pagos/(\d+)/modificar/$'       => 'AdminCP_PagosModificar',

    '^/admincp/condiciones/$'                 => 'AdminCP_Condiciones',
    '^/admincp/condiciones/(done)/$'          => 'AdminCP_Condiciones',
    '^/admincp/condiciones/(\d+)/$'           => 'AdminCP_CondicionesVer',
    '^/admincp/condiciones/agregar/$'         => 'AdminCP_CondicionesAgregar',
    '^/admincp/condiciones/(\d+)/modificar/$' => 'AdminCP_CondicionesModificar',

    
    '^/admincp/compras/(pendientes)/$'               => 'AdminCP_Compras',
    '^/admincp/compras/(pendientes)/(aprobacion)/$'  => 'AdminCP_Compras',
    '^/admincp/compras/(pendientes)/(envio)/$'       => 'AdminCP_Compras',
    '^/admincp/compras/(realizadas)/$'               => 'AdminCP_Compras',
    '^/admincp/compras/(rechazadas)/$'               => 'AdminCP_Compras',
    '^/admincp/compras/(finalizadas)/$'              => 'AdminCP_Compras',
    
    '^/admincp/compras/(\d+)/detalles/$'             => 'AdminCP_ComprasDetalles',
    
    
    '^/usercp/$'       => 'UserCP_Main',

    '^/usercp/datos/$'        => 'UserCP_Datos',
    '^/usercp/datos/(done)/$' => 'UserCP_Datos',
    
    
    '^/usercp/compras/(\d+)/completar/ajax/$'               => 'UserCP_ComprasCompletarAjax',
    '^/usercp/compras/(\d+)/completar/ajax/(comprobante)/$' => 'UserCP_ComprasCompletarAjax',
    '^/usercp/compras/(\d+)/completar/'                     => 'UserCP_ComprasCompletar',
    '^/usercp/compras/(\d+)/detalles/'                      => 'UserCP_ComprasDetalles',
    
    '^/usercp/compras/$'                               => 'UserCP_Compras',
    '^/usercp/compras/(\w+)/$'                         => 'UserCP_Compras',
    '^/usercp/compras/(\w+)/(\w+)/$'                   => 'UserCP_Compras',
    

    '^/blog/$'               => 'Blog',
    '^/blog/(\d+)\+(?:.+)/$' => 'BlogNoticia',
    '^/blog/(.+)/$'          => 'Blog',

    '^/carrito/$'                   => 'Carrito',
    '^/carrito/(done)/$'            => 'Carrito',
    '^/carrito/(agregar|ofertar)/$' => 'CarritoAgregar',
    '^/carrito/(\d+)/(agregar)/$'   => 'CarritoAgregar',
    '^/carrito/(\d+)/borrar/$'      => 'CarritoBorrar',
    
    '^/carrito/finalizar/$'               => 'CarritoFinalizar',
    '^/carrito/finalizar/(\d+)/$'         => 'CarritoFinalizar',
    '^/carrito/finalizar/(\d+)/2/$'       => 'CarritoFinalizar2',
    '^/carrito/finalizar/(\d+)/3/$'       => 'CarritoFinalizar3'

);

$startTime = microtime(true);

$root = realpath( dirname( __FILE__ ) );

include_once "$root/config.php";
include_once "$root/inc/common.php";

Web::$errors['404'] = 'Error404';
Web::dispatch($urls);

$endTime = microtime(true) - $startTime;
//print round($endTime * 1000, 5);