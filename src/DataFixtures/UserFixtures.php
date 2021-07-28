<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
public function __construct( UserPasswordEncoderInterface $passwordEncoder)
{
    $this->passwordEncoder = $passwordEncoder;
}
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom("testNom");
        $user->setPrenom("testPrenom");
        $user->setDateInscription(new \DateTime());
        $user->setEmail("test@test.com");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user,'test'));
        $manager->persist($user);

        $user2 = new User();
        $user2->setNom("test2Nom");
        $user2->setPrenom("test2Prenom");
        $user2->setDateInscription(new \DateTime());
        $user2->setEmail("test2@test2.com");
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'test2'));
        $manager->persist($user2);

        $manager->flush();
    }
}
