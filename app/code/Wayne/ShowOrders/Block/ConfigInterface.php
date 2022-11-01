<?php

namespace Wayne\ShowOrders\Block;

interface ConfigInterface
{
    const ADMIN_TOKEN_URL = 'https://dc98dbb.dizycommerce.com.br/index.php/rest/V1/integration/admin/token';
    const GET_ORDERS_URL = 'https://dc98dbb.dizycommerce.com.br/index.php/rest/V1/orders';
    const ORDER_FILTER = '?searchCriteria[filter_groups][0][filters][0][field]=customer_email&searchCriteria[filter_groups][0][filters][0][value]=';
}
