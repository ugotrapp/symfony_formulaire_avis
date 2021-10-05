<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Avis;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = FakerFactory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {

    $user = new User();
        $user->setEmail('admin@example.com');
        $password = $this->encoder->encodePassword($user,'123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('member@example.com');
        $password = $this->encoder->encodePassword($user,'456');
        $user->setPassword($password);
        $user->setRoles(['ROLE_MEMBER']);
        $manager->persist($user);
        $manager->flush();

        for ($i = 1; $i < 20; $i++) {

        $avis = new Avis();
        $avis->setNom($this->faker->name());
        $avis->setEmail($this->faker->email());
        $avis->setContenu($this->faker->words(5, true));
        $avis->setNote($this->faker->randomDigitNot(4));
        $avis->setDateDeCreation($this->faker->dateTime());
        $avis->setActive(1);
        $manager->persist($avis);
        $manager->flush();
        }
    }
}


