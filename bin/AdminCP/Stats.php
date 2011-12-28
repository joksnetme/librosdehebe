<?php

include_once "$root/bin/AdminCP/Base.php";

class AdminCP_Stats extends AdminCP_Base
{
    public $type = 'text/html';

    public function __construct()
    {
        parent::__construct('Estadist&iacute;cas');
    }

    public function __toString()
    {
        $result = Db::query(
            "SELECT hits.id_hits
                  , hits.client_ip
                  , hits.user_agent
                  , hits.request_uri
                  , hits.time
             FROM hits
             ORDER BY hits.time"
        );

        if ( ( $total = sizeof($result) ) > 0 )
        {
            $urls   = array();
            $visits = array();

            $fechaInicial = $result[0]['time'];
            $fechaFinal   = $result[$total - 1]['time'];

            foreach ( $result as $row )
            {
                if ( !( isset($urls[$row['request_uri']]) ) )
                    $urls[$row['request_uri']] = 0;

                if ( !( isset($visits[$row['client_ip']]) ) )
                    $visits[$row['client_ip']] = 0;

                $urls[$row['request_uri']]++;
                $visits[$row['client_ip']]++;
            }

            array_multisort($urls, SORT_DESC, SORT_NUMERIC);
            array_multisort($visits, SORT_DESC, SORT_NUMERIC);

            $i = 0;

            foreach ( $urls as $requestUri => $count )
            {
                $i++;

                $perc = number_format( ( $count * 100 ) / $total, 2 );
                $this->block('urls')
                     ->set('pos', $i)
                     ->set('class', ( $i % 2 == 0 ) ? 'even' : 'odd')
                     ->set('hits', $count)
                     ->set('perc', $perc)
                     ->set('url', $requestUri)
                     ->end();

                if ( $i == 10 )
                    break;
            }

            $i = 0;

            foreach ( $visits as $clientIP => $count )
            {
                $i++;

                $perc = number_format( ( $count * 100 ) / $total, 2 );
                $this->block('visits')
                     ->set('pos', $i)
                     ->set('class', ( $i % 2 == 0 ) ? 'even' : 'odd')
                     ->set('hits', $count)
                     ->set('perc', $perc)
                     ->set('ip', $clientIP)
                     ->end();

                if ( $i == 10 )
                    break;
            }

            $totalUrls = sizeof($urls);
            $totalVisits = sizeof($visits);

            $this->set('hitsTotal', $total)
                 ->set('urlsTotal', $totalUrls)
                 ->set('visitsTotal', $totalVisits)
                 ->set('fechaInicial', date('d/m/Y', $fechaInicial))
                 ->set('fechaFinal', date('d/m/Y', $fechaFinal));
        }

        return parent::__toString();
    }
}