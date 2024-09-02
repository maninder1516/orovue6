<?php

namespace IZMO\VueBundle\Controller;

// Basic Import Statements
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\UIBundle\Route\Router;
use Psr\Log\LoggerInterface;
// Specific Import Statements

#[Route(path: '/testvue', name: 'izmo_testvue_')]
class VueController extends AbstractController {


    /**
     * {@inheritDoc}
     */
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                TranslatorInterface::class,
                UpdateHandlerFacade::class,
                Router::class,
                LoggerInterface::class,
                //BrandHandler::class,
            ]
        );
    }
}