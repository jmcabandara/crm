<?php

namespace Oro\Bundle\ChannelBundle\Tests\Functional\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\TestFrameworkBundle\Tests\Functional\DataFixtures\LoadOrganization;
use Oro\Bundle\UserBundle\Entity\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class LoadRestrictedUser extends AbstractFixture implements ContainerAwareInterface, DependentFixtureInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [LoadOrganization::class];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var UserManager $userManager */
        $userManager = $this->container->get('oro_user.manager');

        $role = $userManager
            ->getStorageManager()
            ->getRepository('OroUserBundle:Role')
            ->findBy(['role' => 'IS_AUTHENTICATED_ANONYMOUSLY']);

        $org = $this->getReference('organization');

        $user = $userManager->createUser();
        $user
            ->setUsername('restricted_user')
            ->setPlainPassword(uniqid())
            ->setFirstName('Simple')
            ->setLastName('User')
            ->addRole($role[0])
            ->setEmail('simple@example.com')
            ->setOrganization($org)
            ->addOrganization($org)
            ->setSalt('');

        $userManager->updateUser($user);
        $this->setReference('restrictedUser', $user);
    }
}
