<?php
namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername("Admin");
        $admin->setEmail("anatolia060590@hotmail.com");
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCreateTime(new \DateTime());
        $manager->persist($admin);

        $user1 = new User();
        $user1->setUsername("User1");
        $user1->setEmail("Pharma123@free.fr");
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, '1234'));
        $user1->setRoles(["ROLE_USER"]);
        $user1->setCreateTime(new \DateTime());
        $manager->persist($user1);
        $this->setReference("user1", $user1);
        $manager->flush();
    }
}