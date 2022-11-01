<?php

namespace Wayne\ShowOrders\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CmsPage implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var PageFactory
     */
    private $pageFactory;
    /**
     * @var \Magento\Cms\Model\ResourceModel\Page
     */
    private $pageResource;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * AddNewCmsPage constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     * @param Page $pageResource
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory              $pageFactory,
        Page                     $pageResource,
        BlockFactory             $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
        $this->pageResource = $pageResource;
        $this->blockFactory = $blockFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $pageIdentifier = 'formapi';
        $pageData = [
            'title' => 'Get Orders',
            'page_layout' => '1column',
            'meta_keywords' => '',
            'meta_description' => '',
            'identifier' => $pageIdentifier,
            'content_heading' => '',
            'content' => '{{block class="Wayne\ShowOrders\Block\Orders" template="Wayne_ShowOrders::request.phtml"}}',
            'layout_update_xml' => '<head>
                                    <css src="Wayne_ShowOrders::css/show_orders.css"/>
                                    </head>',
            'url_key' => $pageIdentifier,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->moduleDataSetup->startSetup();
        $this->pageFactory->create()->setData($pageData)->save();
        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
