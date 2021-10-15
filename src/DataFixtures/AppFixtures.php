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

        

       
        

        $game1 =new Game();
        $game1->setNom("Assassin's Creed");
        $game1->setImage("https://image.jeuxvideo.com/medias-sm/158826/1588264397-5261-jaquette-avant.jpg");
        $game1->setPlateform(['XBOX','PC']);
        $manager->persist($game1);
        

        $game2 =new Game();
        $game2->setNom("FARCRY 6");
        $game2->setImage("https://image.jeuxvideo.com/medias-sm/163161/1631607413-3853-jaquette-avant.jpg");
        $game2->setPlateform(['XBOX','PC']);
        $manager->persist($game2);
        

        $game3 =new Game();
        $game3->setNom("Astria Ascending");
        $game3->setImage("https://image.jeuxvideo.com/medias-sm/163361/1633614374-6944-jaquette-avant.gif");
        $game3->setPlateform(['XBOX','PC']);
        $manager->persist($game3);
        

        $game4 =new Game();
        $game4->setNom("HADES");
        $game4->setImage("https://image.jeuxvideo.com/medias-sm/161367/1613665411-7537-jaquette-avant.png");
        $game4->setPlateform(['XBOX','PC']);
        $manager->persist($game4);
        

        $game5 =new Game();
        $game5->setNom("FIFA 22");
        $game5->setImage("https://image.jeuxvideo.com/medias/163154/1631541998-6589-jaquette-avant.jpg");
        $game5->setPlateform(['XBOX','PC']);
        $manager->persist($game5);
      

        $game6 =new Game();
        $game6->setNom("Alan Wake Remastered");
        $game6->setImage("https://image.jeuxvideo.com/medias/163336/1633359162-4716-jaquette-avant.gif");
        $game6->setPlateform(['XBOX','PC']);
        $manager->persist($game6);
        

        $game7 =new Game();
        $game7->setNom("WASTELAND 3");
        $game7->setImage("https://image.jeuxvideo.com/medias-sm/163335/1633352750-2611-jaquette-avant.gif");
        $game7->setPlateform(['XBOX','PC']);
        $manager->persist($game7);
       

        $game8 =new Game();
        $game8->setNom("Demon Slayer");
        $game8->setImage("https://image.jeuxvideo.com/medias/163335/1633350061-7908-jaquette-avant.gif");
        $game8->setPlateform(['XBOX','PC']);
        $manager->persist($game8);
        

        $game9 =new Game();
        $game9->setNom("FIFA 22");
        $game9->setImage("https://image.jeuxvideo.com/medias/163154/1631541998-6589-jaquette-avant.jpg");
        $game9->setPlateform(['PS5','PC']);
        $manager->persist($game9);
        
        $game10 =new Game();
        $game10->setNom("Alan Wake Remastered");
        $game10->setImage("https://image.jeuxvideo.com/medias/163336/1633359162-4716-jaquette-avant.gif");
        $game10->setPlateform(['PS5','PC']);
        $manager->persist($game10);
        

        $game11 =new Game();
        $game11->setNom("WASTELAND 3");
        $game11->setImage("https://image.jeuxvideo.com/medias-sm/163335/1633352750-2611-jaquette-avant.gif");
        $game11->setPlateform(['PS5','PC']);
        $manager->persist($game11);
        

        $game12 =new Game();
        $game12->setNom("Demon Slayer");
        $game12->setImage("https://image.jeuxvideo.com/medias/163335/1633350061-7908-jaquette-avant.gif");
        $game12->setPlateform(['PS5','PC']);
        $manager->persist($game12);

        $opinion1 = new Opinion();
        $opinion1->setNom($this->faker->name());
        $opinion1->setEmail($this->faker->email());
        $opinion1->setContenu($this->faker->words(20, true));
        $opinion1->setNote($this->faker->numberBetween(1, 5));
        $opinion1->setDateDeCreation($this->faker->dateTime());
        $opinion1->setActive(1);
        $opinion1->setGame($game1);
        $manager->persist($opinion1);
        

        $opinion2 = new Opinion();
        $opinion2->setNom($this->faker->name());
        $opinion2->setEmail($this->faker->email());
        $opinion2->setContenu($this->faker->words(20, true));
        $opinion2->setNote($this->faker->numberBetween(1, 5));
        $opinion2->setDateDeCreation($this->faker->dateTime());
        $opinion2->setActive(1);
        $opinion2->setGame($game1);
        $manager->persist($opinion2);
        

        $opinion3 = new Opinion();
        $opinion3->setNom($this->faker->name());
        $opinion3->setEmail($this->faker->email());
        $opinion3->setContenu($this->faker->words(20, true));
        $opinion3->setNote($this->faker->numberBetween(1, 5));
        $opinion3->setDateDeCreation($this->faker->dateTime());
        $opinion3->setActive(1);
        $opinion3->setGame($game5);
        $manager->persist($opinion3);
       

        $opinion4 = new Opinion();
        $opinion4->setNom($this->faker->name());
        $opinion4->setEmail($this->faker->email());
        $opinion4->setContenu($this->faker->words(20, true));
        $opinion4->setNote($this->faker->numberBetween(1, 5));
        $opinion4->setDateDeCreation($this->faker->dateTime());
        $opinion4->setActive(1);
        $opinion4->setGame($game4);
        $manager->persist($opinion4);
        

        $opinion5 = new Opinion();
        $opinion5->setNom($this->faker->name());
        $opinion5->setEmail($this->faker->email());
        $opinion5->setContenu($this->faker->words(20, true));
        $opinion5->setNote($this->faker->numberBetween(1, 5));
        $opinion5->setDateDeCreation($this->faker->dateTime());
        $opinion5->setActive(1);
        $opinion5->setGame($game4);
        $manager->persist($opinion5);
        

        $opinion6 = new Opinion();
        $opinion6->setNom($this->faker->name());
        $opinion6->setEmail($this->faker->email());
        $opinion6->setContenu($this->faker->words(20, true));
        $opinion6->setNote($this->faker->numberBetween(1, 5));
        $opinion6->setDateDeCreation($this->faker->dateTime());
        $opinion6->setActive(1);
        $opinion6->setGame($game3);
        $manager->persist($opinion6);
        

        $opinion7 = new Opinion();
        $opinion7->setNom($this->faker->name());
        $opinion7->setEmail($this->faker->email());
        $opinion7->setContenu($this->faker->words(20, true));
        $opinion7->setNote($this->faker->numberBetween(1, 5));
        $opinion7->setDateDeCreation($this->faker->dateTime());
        $opinion7->setActive(1);
        $opinion7->setGame($game2);
        $manager->persist($opinion7);
        $manager->flush();

}

}
