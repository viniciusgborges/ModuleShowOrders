<?php

namespace Wayne\ShowOrders\Block;

use Magento\Framework\View\Element\Template\Context;

class Orders extends \Magento\Framework\View\Element\Template
{

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
}
