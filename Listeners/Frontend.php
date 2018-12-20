<?php

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Checkout Carrier Email Authorization
 *
 * @package   OstCheckoutCarrierEmailAuthorization
 *
 * @author    Tim Windelschmidt <tim.windelschmidt@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstCheckoutCarrierEmailAuthorization\Listeners;

class Frontend
{
    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $controller = $args->getSubject();
        $view = $controller->View();

        if ($controller->Request()->getActionName() !== 'confirm') {
            return;
        }

        $dispatchId = $view->getAssign('sDispatch')['id'];
        $dispatchTypes = Shopware()->Config()->getByNamespace('OstCheckoutCarrierEmailAuthorization', 'dispatchTypes');
        $before = Shopware()->Config()->getByNamespace('OstCheckoutCarrierEmailAuthorization', 'before');

        $config = [
            'enabled' => \in_array((int)$dispatchId, $dispatchTypes, true),
            'before' => $before,
        ];

        $view->addTemplateDir(Shopware()->Container()->getParameter('ost_checkout_carrier_email_authorization.view_dir'));

        $view->assign('dprivacy', $config);
    }
}
