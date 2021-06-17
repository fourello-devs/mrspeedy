<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class OrderStatus
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-06-17
 */
class OrderStatus
{
    /**
     * Newly created order, waiting for verification from our dispatchers.
     */
    public const NEW = 'new';

    /**
     * Order was verified and is available for couriers.
     */
    public const AVAILABLE = 'available';

    /**
     * A courier was assigned and is working on the order.
     */
    public const ACTIVE = 'active';

    /**
     * Order is completed.
     */
    public const COMPLETED = 'completed';

    /**
     * Order was reactivated and is again available for couriers.
     */
    public const REACTIVATED = 'reactivated';

    /**
     * The order is a draft and will not be delivered as such. You can create an actual order out of the draft in your Personal cabinet.
     */
    public const DRAFT = 'draft';

    /**
     * Order was canceled.
     */
    public const CANCELED = 'canceled';

    /**
     * Order execution was delayed by a dispatcher.
     */
    public const DELAYED = 'delayed';
}
