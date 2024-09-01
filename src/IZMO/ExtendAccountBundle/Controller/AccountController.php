<?php

namespace IZMO\ExtendAccountBundle\Controller;

// Basic Import Statements
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
use Oro\Bundle\AccountBundle\Controller\AccountController as BaseController;
use Oro\Bundle\AccountBundle\Entity\Account;
use Oro\Bundle\ChannelBundle\Entity\Channel;
use Oro\Bundle\AccountBundle\Event\CollectAccountWebsiteActivityCustomersEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 *  Accounts.
 */
class AccountController extends BaseController {
    
    #[Route(path: '/view/{id}', name: 'oro_account_view', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'oro_account_view', type: 'entity', class: Account::class, permission: 'VIEW')]
    public function viewAction(Account $account): array
    {
        $channels = $this->container->get('doctrine')
            ->getRepository(Channel::class)
            ->findBy([], ['channelType' => 'ASC', 'name' => 'ASC']);

        $event = new CollectAccountWebsiteActivityCustomersEvent($account->getId());
        $this->container->get(EventDispatcherInterface::class)->dispatch($event);

        return [
            'entity' => $account,
            'channels' => $channels,
            'customers' => $event->getCustomers(),
        ];
    }
    
    /**
     * Create account form
     */
    #[Route(path: '/create', name: 'oro_account_create')]
    #[Template('@OroAccount/Account/update.html.twig')]
    #[Acl(id: 'oro_account_create', type: 'entity', class: Account::class, permission: 'CREATE')]
    public function createAction(): array|RedirectResponse
    {
        return $this->update();
    }
    
    /**
     * Edit user form
     */
    #[Route(path: '/update/{id}', name: 'oro_account_update', requirements: ['id' => '\d+'])]
    #[Template]
    #[Acl(id: 'oro_account_update', type: 'entity', class: Account::class, permission: 'EDIT')]
    public function updateAction(Account $entity): array|RedirectResponse
    {
        return $this->update($entity);
    }
        
    #[Route(path: '/{_format}', name: 'oro_account_index', requirements: ['_format' => 'html|json'], defaults: ['_format' => 'html'])]
    #[Template]
    #[AclAncestor('oro_account_view')]
    public function indexAction(): array
    {
        return [
            'entity_class' => Account::class
        ];
    }

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
            ]
        );
    }
      
}

