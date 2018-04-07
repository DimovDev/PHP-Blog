<?php

namespace SoftUniBlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="SoftUniBlogBundle\Repository\ArticleRepository")
 */
class Article
{
	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="SoftUniBlogBundle\Entity\Article" ,mappedBy="author")
	 */
	private $articles;


	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="SoftUniBlogBundle\Entity\User",inversedBy="articles")
	 * @ORM\JoinColumn(name="authorId",referencedColumnName="id")
	 */
  private $author;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdded", type="datetime")//tova li e da, kak da q napalnq , kude suzadaash zapisa, v koq
     */
    private $dateAdded;
	/**
	 * @var string
	 */
	private $summary;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="authorId",type="integer")
	 */
	private $authorId;

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticles()
	{
		return $this->articles;
	}

	public function addPost(Article $article)
	{
		$this->articles[]=$article;
		return $this;
	}

	/**
	 * @param \SoftUniBlogBundle\Entity\ User $author
	 */


	public function setAuthor(User $author=null)
	{
		$this->author = $author;
	}

	/**
	 * @return \SoftUniBlogBundle\Entity\ User
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param integer $authorId
	 *
	 * @return Article
	 */



	public function setAuthorId($authorId)
	{
		$this->authorId = $authorId;
		return $this;
	}
	/**
	 * @return int
	 */
	public function getAuthorID()
	{
		return $this->authorId;
	}


	private function setSummary()
	{
		$this->summary=substr($this->getContent(),0,strlen($this->getContent())/2). "...";

	}

	/**
	 * @return string
	 */
	public function getSummary()
	{
		if($this->summary===null){

			$this->setSummary();
		}
		return $this->summary;
	}

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateAdded.
     *
     * @param \DateTime $dateAdded
     *
     * @return Article
     */
    public function setDateAdded($dateAdded)//this
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded.
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
	public function __construct()
	{
		$this->articles=new ArrayCollection();
	}


}
