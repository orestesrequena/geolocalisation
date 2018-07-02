<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $prenom;

    /**
     * @ORM\Column(type="datetime", length=64)
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $dateNaissance;
    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $email;
    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $sexe;
    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $pays;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $region;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    protected $metier;

    public function __toString() {
        return (string) $this->email;
    }
  
    public function getId()
    {
        return $this->id;
    }
    
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    
    public function setDateNaissance(\DateTime $dateNaissance = null)
    {
        $this->dateNaissance = $dateNaissance;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe= $sexe;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays)
    {
        $this->pays= $pays;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region= $region;
    }



    public function getMetier()
    {
        return $this->metier;
    }

    public function setMetier($metier)
    {
        $this->metier = $metier;
    }

}