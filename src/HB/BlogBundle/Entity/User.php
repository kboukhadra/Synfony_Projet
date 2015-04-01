<?php

namespace HB\BlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Contrainte;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\UserRepository")
 */
class User
{
    
      public function __construct(){
        //valeur par défaut 
        $this->creationDate= new \DateTime() ;
}
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Contrainte\Email(
     *             message = "'{{ value }}' n'est pas un email valide.",
     *              checkMX = true
     * 
     * )
     */
    private $email;
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Contrainte\Length(
     *      min = "3",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ 3 }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ 50 }} caractères"
     * )
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     * @Contrainte\Length(
     *      min = "3",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ 3 }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ 40 }} caractères"
     * )
     * 
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * 
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     *
    */
      private $creationDate;
     
    
    /**
     * @var Article[]
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     * 
     */
    
    private $articles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastEditDate", type="datetime")
     * 
     */
    private $lastEditDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date")
     * 
     */
    private $birthDate;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /*
     * @return String
     */
     public function getNameLogin()
    {
        return $this->name.'.'.$this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastEditDate
     *
     * @param \DateTime $lastEditDate
     * @return User
     */
    public function setLastEditDate($lastEditDate)
    {
        $this->lastEditDate = $lastEditDate;

        return $this;
    }

    /**
     * Get lastEditDate
     *
     * @return \DateTime 
     */
    public function getLastEditDate()
    {
        return $this->lastEditDate;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    
    /**
     * Get Login
     *
     * @return \string 
     */
    public function getLogin()
    {
        return $this->id;
    }
    
    
    
  

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Add article
     *
     * @param \HB\BlogBundle\Entity\Article $article
     * @return User
     */
    public function addArticle(\HB\BlogBundle\Entity\Article $article)
    {
        $article->setAuthor($this);
        $this->articles[]=$article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \HB\BlogBundle\Entity\Article $article
     */
    public function removeArticle(\HB\BlogBundle\Entity\Article $article)
    {
        $this->setAuthor(null) ;
        $this->article->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
