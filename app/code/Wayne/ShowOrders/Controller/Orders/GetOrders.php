<?php

namespace Wayne\ShowOrders\Controller\Orders;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Wayne\ShowOrders\Block\ConfigInterface;

class GetOrders extends Action implements ConfigInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultFactory;

    /**
     * @var Http
     */
    protected Http $request;

    /**
     * @param Context $context
     * @param JsonFactory $resultFactory
     * @param Http $request
     */
    public function __construct(
        Context     $context,
        JsonFactory $resultFactory,
        Http $request
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->request = $request;
    }

    public function execute()
    {
        $items = $this->resultFactory->create();

        $userData = ["username" => "testefullstack", "password" => "8cjmbx1r"];
        $ch = curl_init(self::ADMIN_TOKEN_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))]);

        $token = curl_exec($ch);

        $httpHeaders = new \Zend\Http\Headers();
        $httpHeaders->addHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $apiOrderUrl = self::GET_ORDERS_URL . self::ORDER_FILTER . $this->request->getParam('customer_email');
        $ch = curl_init($apiOrderUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer " . json_decode($token)]);

        $result = curl_exec($ch);
        $results = json_decode($result, 1);

        return $items->setData($results);
    }
}
