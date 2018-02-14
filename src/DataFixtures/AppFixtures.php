<?php
/**
 * Created by PhpStorm.
 * User: roxanne7
 * Date: 11/02/2018
 * Time: 20:25
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userName = 'Roxanne7_';
        $userAdmName = 'Admin';

        $user = new User();
        $user->setUsername($userName);
        $user->setEmail($userName.'@xp-it.com');
        $password = $this->encoder->encodePassword($user, $userName);
        $user->setPassword($password);

        $manager->persist($user);


        $userAdm = new User();
        $userAdm->setUsername($userAdmName);
        $userAdm->setEmail($userAdmName.'@xp-it.com');
        $password = $this->encoder->encodePassword($userAdm, $userAdmName);
        $userAdm->setPassword($password);
        $userAdm->addRole('ROLE_ADMIN');

        $manager->persist($userAdm);





        $manager->flush();
    }


}