<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Role;

/**
 * Description of LoadUserFixture.
 *
 * @author Rodrigo Santellan
 */
class LoadUserFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName('ROLE_ADMIN');
        $role->setDescription('Admin role');
        $manager->persist($role);
        $roleTranslator = new Role();
        $roleTranslator->setName('ROLE_VIEW_TRANSLATOR');
        $roleTranslator->setDescription('Translator role');
        $manager->persist($roleTranslator);

        $userManager = $this->container->get('fos_user.user_manager');

        $mailuser = $userManager->createUser();
        $mailuser->setUsername('info@rodrigosantellan.com');
        $mailuser->setEmail('info@rodrigosantellan.com');
        $mailuser->setPlainPassword('1234');
        $mailuser->setEnabled(true);
        $mailuser->setSuperAdmin(true);
        $mailuser->addRole($role);
        $mailuser->addRole($roleTranslator);
        $manager->persist($mailuser);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
