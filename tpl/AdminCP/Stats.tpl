<div>
  <div id="breadcrumb">
    <a href="/">Libros de Hebe</a> &raquo;
    <a href="/admincp/">Panel de Control</a> &raquo;
    <a href="/admincp/stats/">Estad&iacute;sticas</a>
  </div>
  <h1>Estad&iacute;sticas</h1>
  <h2>Desde {fechaInicial} a {fechaFinal}.</h2>
  <dl>
    <dt><label>Hits Totales</label></dt>
    <dd>{hitsTotal}</dd>

    <dt><label>P&aacute;ginas Totales</label></dt>
    <dd>{urlsTotal}</dd>

    <dt><label>Visitas Totales</label></dt>
    <dd>{visitsTotal}</dd>
  </dl>
  <div class="half left">
    <h1 class="title">Primeras 10 p&aacute;ginas de {urlsTotal} en total</h1>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th class="center">#</th>
          <th class="center" colspan="2">Hits</th>
          <th>URL</th>
        </tr>
      </thead>
      <tbody>
<!-- BEGIN urls -->
        <tr class="{urls.class}">
          <td class="center">{urls.pos}</td>
          <td class="center">{urls.hits}</td>
          <td class="center">{urls.perc}%</td>
          <td><a href="{urls.url}">{urls.url}</a></td>
        </tr>
<!-- END urls -->
      </tbody>
    </table>
  </div>
  <div class="half right">
    <h1 class="title">Primeras 10 visitas de {visitsTotal} en total</h1>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th class="center">#</th>
          <th class="center" colspan="2">Hits</th>
          <th>IP</th>
        </tr>
      </thead>
      <tbody>
<!-- BEGIN visits -->
        <tr class="{visits.class}">
          <td class="center">{visits.pos}</td>
          <td class="center">{visits.hits}</td>
          <td class="center">{visits.perc}%</td>
          <td><a href="http://{visits.ip}/">{visits.ip}</a></td>
        </tr>
<!-- END visits -->
      </tbody>
    </table>
  </div>
  <div class="clear"><!-- --></div>
</div>