<?php

namespace HB\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Contrainte;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\ArticleRepository")
 */
class Article {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    

    public function __construct() {
        //valeur par défaut 
        $this->creationDate = new \DateTime();
        $this->publishDate = new \DateTime();
        $this->enabled = true;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Contrainte\Length(
     *      min = "5",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins  5  caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que  50 caractères"
     * )
     * 
     * @Contrainte\Regex(
     *  pattern="/^[A-Z]/",
     *  match=true,
     *  message="Votre Titre doit commencer par une Majuscule"
     * )
     * 
     */
    private $title;
    
    /**
     *
     * @var type Image
     * @ORM\OneToOne(targetEntity="Image",cascade="persist")
     */
    private $banner;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="aricles")
     * 
     *
     */
    private $author;
    
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * 
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     * @Contrainte\DateTime()
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishDate", type="datetime")
     * @Contrainte\DateTime()
     */
    private $publishDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastEditDate", type="datetime", nullable =true)
     * @Contrainte\DateTime()
     */
    private $lastEditDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Article
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Article
     */
    public function setPublishDate($publishDate) {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime 
     */
    public function getPublishDate() {
        return $this->publishDate;
    }

    /**
     * Set lastEditDate
     *
     * @param \DateTime $lastEditDate
     * @return Article
     */
    public function setLastEditDate($lastEditDate) {
        $this->lastEditDate = $lastEditDate;

        return $this;
    }

    /**
     * Get lastEditDate
     *
     * @return \DateTime 
     */
    public function getLastEditDate() {
        return $this->lastEditDate;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Article
     */
    public function setPublished($published) {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Article
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Set auteur
     *
     * @param \HB\BlogBundle\Entity\User $author
     * @return Article
     */
    public function setAuthor(\HB\BlogBundle\Entity\User $author = null) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \HB\BlogBundle\Entity\User 
     */
    public function getAuthor() {
        return $this->author;
    }


    /**
     * Set banner
     *
     * @param \HB\BlogBundle\Entity\Image $banner
     * @return Article
     */
    public function setBanner(\HB\BlogBundle\Entity\Image $banner = null)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return \HB\BlogBundle\Entity\Image 
     */
    public function getBanner()
    {
        return $this->banner;
    }
}
