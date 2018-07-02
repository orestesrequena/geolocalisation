<?php


namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{
    private $passwordEncoder;
    
     

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
 
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$username, $email, $password,  $roles]) {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setRoles($roles);
        
 
            $manager->persist($user);
            $this->addReference($username, $user);
        }
 
        $manager->flush();
    }
 
    private function getUserData(): array
    {
        return [
            // $userData = [$nom, $prenom, $password, $email, $roles];
            [ 'jane',  'jane_admin@test.com', 'kitten',['ROLE_ADMIN']],
            ['tom',  'tom_admin@test.com', 'kitten',['ROLE_ADMIN']],
            [ 'john',  'john_user@test.com', 'kitten',['ROLE_USER']],
        ];
    }
 
 
}