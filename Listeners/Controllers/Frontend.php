<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Checkout Carrier Email Authorization
 *
 * @package   OstCheckoutCarrierEmailAuthorization
 *
 * @author    Tim Windelschmidt <tim.windelschmidt@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstCheckoutCarrierEmailAuthorization\Listeners\Controllers;

use Enlight_Event_EventArgs as EventArgs;
use Enlight_Controller_Action as Controller;

class Frontend
{
    /**
     * ...
     *
     * @param EventArgs $args
     */
    public function onPostDispatch(EventArgs $args)
    {
        /** @var $controller Controller */
        $controller = $args->getSubject();
        $view = $controller->View();

        if ($controller->Request()->getActionName() !== 'confirm') {
            return;
        }

        $dispatchId = $view->getAssign('sDispatch')['id'];

        $config = Shopware()->Container()->get('shopware.plugin.cached_config_reader')->getByPluginName('OstCheckoutCarrierEmailAuthorization', Shopware()->Shop());

        $dispatchTypes = (array) $config['dispatchTypes'];
        $before = (boolean) $config['before'];

        $view->addTemplateDir(Shopware()->Container()->getParameter('ost_checkout_carrier_email_authorization.view_dir'));

        $config = [
            'enabled' => in_array((int)$dispatchId, $dispatchTypes, true),
            'before' => $before,
        ];

        $view->assign('dprivacy', $config);
    }
}
