<?php


namespace wooShopTBot;


class Base
{
    const CART_TBL = 'cart';
    const USER_TBL = 'users';
    const ORDER_TBL = 'orders';
    const ERR_TBL = "errors";
    const REQUEST_TBL = "requests";

    const HOME_KEYBOARD = ["Каталог", "О нас"];

    const ERR_COM_MSG = 'Неизвестная команда';
    const ERR_TEXT_MSG = 'Ожидается только текстовое сообщение';
    const ERR_WP_MSG = 'Ошибка при запросе WP';

    const WAIT_TEXT = "⏳";
    //BUFFER
    const BUFFER_DIR = 'buffer/';
    const END_BUFFER_MSG = 'Буфер обновлен';

    const SECTION_CATALOG_HOME_TEXT = '<a href="https://topcraftbeer.ru/wp-content/uploads/2020/05/SvoiDelivery300.png">Каталог</a>';


}