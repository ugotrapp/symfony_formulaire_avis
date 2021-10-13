<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Opinion;
use App\Entity\Game;
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

        for ($i = 1; $i < 10; $i++) {

        $opinion = new Opinion();
        $opinion->setNom($this->faker->name());
        $opinion->setEmail($this->faker->email());
        $opinion->setContenu($this->faker->words(20, true));
        $opinion->setNote($this->faker->numberBetween(1, 5));
        $opinion->setDateDeCreation($this->faker->dateTime());
        $opinion->setActive(1);
        $manager->persist($opinion);
        $manager->flush();
        }

        $game =new Game();
        $game->setNom("Assassin's Creed");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/158826/1588264397-5261-jaquette-avant.jpg");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("FARCRY 6");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/163161/1631607413-3853-jaquette-avant.jpg");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("Astria Ascending");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/163361/1633614374-6944-jaquette-avant.gif");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("HADES");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/161367/1613665411-7537-jaquette-avant.png");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("FIFA 22");
        $game->setImage("https://image.jeuxvideo.com/medias/163154/1631541998-6589-jaquette-avant.jpg");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("Alan Wake Remastered");
        $game->setImage("https://image.jeuxvideo.com/medias/163336/1633359162-4716-jaquette-avant.gif");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("WASTELAND 3");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/163335/1633352750-2611-jaquette-avant.gif");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("Demon Slayer");
        $game->setImage("https://image.jeuxvideo.com/medias/163335/1633350061-7908-jaquette-avant.gif");
        $game->setPlateform(['XBOX','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("FIFA 22");
        $game->setImage("https://image.jeuxvideo.com/medias/163154/1631541998-6589-jaquette-avant.jpg");
        $game->setPlateform(['PS5','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("Alan Wake Remastered");
        $game->setImage("https://image.jeuxvideo.com/medias/163336/1633359162-4716-jaquette-avant.gif");
        $game->setPlateform(['PS5','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("WASTELAND 3");
        $game->setImage("https://image.jeuxvideo.com/medias-sm/163335/1633352750-2611-jaquette-avant.gif");
        $game->setPlateform(['PS5','PC']);
        $manager->persist($game);
        $manager->flush();

        $game =new Game();
        $game->setNom("Demon Slayer");
        $game->setImage("https://image.jeuxvideo.com/medias/163335/1633350061-7908-jaquette-avant.gif");
        $game->setPlateform(['PS5','PC']);
        $manager->persist($game);
        $manager->flush();

}

}
