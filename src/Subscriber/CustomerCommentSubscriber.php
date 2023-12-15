<?php declare(strict_types=1);

namespace CustomerCommentInvoice\Subscriber;

use Shopware\Core\Checkout\Order\OrderEntity;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Account\Order\AccountOrderPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CustomerCommentSubscriber implements EventSubscriberInterface
{
    private SystemConfigService $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AccountOrderPageLoadedEvent::class => 'onOrderPageLoaded',
        ];
    }

    public function onOrderPageLoaded(AccountOrderPageLoadedEvent $event): void
    {
        $order = $event->getPage()->getOrder();

        if (!$order instanceof OrderEntity) {
            return;
        }

        // Add the customer comment to the view data
        $event->getPage()->addExtension('customerComment', $order->getCustomerComment());
    }
}
