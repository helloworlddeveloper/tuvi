<?php
namespace UserBundle\Menu;
use Admingenerator\GeneratorBundle\Menu\AdmingeneratorMenuBuilder;
use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;
use Knp\Menu\FactoryInterface;

class DashboardMenuBuilder extends AdmingeneratorMenuBuilder
{
    /**
     * Check security expression
     * @param string $expression
     * @return bool 
     */
    private function isGranted($expression)
    {
        return $this->container->get('security.context')->isGranted(array(
            new Expression($expression)
        ));
    }
    
    public function sidebarMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        if ($dashboardRoute = $this->container->getParameter('admingenerator.dashboard_route')) {
            $this
                ->addLinkRoute($menu, 'admingenerator.dashboard', $dashboardRoute)
                ->setExtra('icon', 'fa fa-dashboard');
        }
        $this->translation_domain = 'AdmingeneratorDashboardDemoMenu';

        $this->addWelcomeMenu($menu);
//        $this->addSecuredMenu($menu);
        return $menu;
    }
    
    private function addWelcomeMenu($menu)
    {
        $welcome = $this->addDropdown($menu, 'welcome.dropdown');
//        $this->addLinkURI($menu,'module.User','/admin/user/');
//        $this->addLinkURI($menu,'module.Post','/admin/post/');
//        $this->addLinkURI($menu,'module.Category','/admin/category/');
        $this->addLinkRoute($welcome, 'welcome.welcome', 'welcome_admin_homepage');
        $this->addLinkRoute($welcome, 'module.user', 'Admin_BlogBundle_User_list');
        $this->addLinkRoute($welcome, 'module.post', 'Admin_BlogBundle_Post_list');
        $this->addLinkRoute($welcome, 'module.category', 'Admin_BlogBundle_Category_list');
//        $this->addLinkRoute($welcome, 'module.tag', 'Admingenerator_DoctrineOrmDemoBundle_Tag_list');
        
        return $menu;
    }
    
    private function addSecuredMenu($menu)
    {
        if ($this->isGranted('canSeeSecuredMenu()')) {
            $this->addDropdown($menu, 'secured.dropdown');
        }
        
        return $menu;
    }
}