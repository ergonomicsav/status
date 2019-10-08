<?php
/**
 * Created by PhpStorm.
 * User: lysyi
 * Date: 30.06.16
 * Time: 15:13
 */

require 'TrackingSites.php';

$start = microtime(true);

$sites = [
    'main' => [
        'https://cbt.center',
        'http://www.dengi-info.com',
        'http://fin-sovet.com.ua',
        'http://fin.expert',
        'http://finsiter.com',
        'http://teletrade.tv',
        'http://top-traders.org',
        #'http://tv.teletrade.com.ua',
        #'http://promo.fin.expert',
        'http://promo.finsiter.com',
        'http://promo.teletrade.com.ua',
    ],
   'profit point' => [
        'http://profit-master.pt',
        'http://profit-point.pl',
        'http://profitpoint.bg',
        'http://profitpoint.biz',
        'http://profitpoint.eu',
        'http://profitpoint.gr',
       # 'http://profitpoint.hu',
        'http://profitpoint.info',
        'http://profitpoint.my',
        'http://profitpoint.pl',
        'http://profitpoint.pt',
        'http://profitpoint.ro',
        'http://profitpoint.rs',
        'http://profitway.mx',
    ],

    'satellites' => [
        'http://abt.academy',
        'http://abt.co.ua',
        'http://birjconsulting.com',
        'http://birzha-treyderov.com.ua',
        'http://broker-teletrade.com.ua',
        'http://c-b-t.com.ua',
        'https://cab.masterbrok.com.ua',
        'https://copy.masterbrok.com.ua',
        'https://crm.masterbrok.com.ua',
       # 'http://dengi.tv',
        'https://edu.masterbrok.com.ua',
       # 'http://financenews24.org',
       # 'http://financial-rating.com.ua',
        'http://forex-broker.com.ua',
        'http://forex-trade.com.ua',
        'http://interttconsultancy.my',
        'https://mailgroup.pro',
        'https://masterbrok.com.ua',
        'http://mbrok.com.ua',
        'http://otzovik.in.ua',
        'http://otzovik.org.ua',
        'http://profittest.pl',
        'http://rating-forex-broker.com',
        'http://ratingfx.com.ua',
        'http://starttrading.mbrok.com.ua',
        'http://take-profit.com.ua',
        'http://teletrade.in.ua',
        'http://teletrade.od.ua',
        'http://teletradevn.com',
        'http://trade-obzor.com.ua',
        'http://ttconsulting.com.vn',
        'http://ttconsulting.vn',
        'http://ttmarket.ae',
        #'http://bonus.teletrade.ru',
        'http://finmaster.org',
        'http://ppmtest.site.mapqo.com',
    ]
];

new TrackingSites('report.json', $sites, true);

echo 'Time: '.(microtime(true) - $start).' sec.' . "\n";

