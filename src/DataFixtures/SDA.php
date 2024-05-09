<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SDA extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create("fr_FR");

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setNom($faker->name)
                ->setDescription($faker->text)
                ->setAuteur($faker->name)
                ->setLien($faker->url);

            $manager->persist($post);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email)
                ->setPassword($faker->password)
                ->setPseudo($faker->name)
                ->setBiographie($faker->text)
                ->setRoles([USER::DEFAULT_ROLES]);

            $manager->persist($user);
        }

        $userAdmin = new User();
        $userAdmin->setEmail($faker->email)
            ->setPassword($faker->password)
            ->setPseudo($faker->name)
            ->setBiographie($faker->text)
            ->setRoles([USER::ROLE_ADMIN]);

        $manager->persist($userAdmin);


        $manager->flush();
    }
}
