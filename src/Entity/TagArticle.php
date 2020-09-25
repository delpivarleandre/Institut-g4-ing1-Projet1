<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagArticle
 *
 * @ORM\Table(name="Tag-article", indexes={@ORM\Index(name="id_article", columns={"id_article"})})
 * @ORM\Entity
 */
class TagArticle
{
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_article", referencedColumnName="id")
     * })
     */
    private $idArticle;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tag", referencedColumnName="id")
     * })
     */
    private $idTag;

    /**
     * Get the value of idArticle
     *
     * @return  int
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set the value of idArticle
     *
     * @param  int  $idArticle
     *
     * @return  self
     */
    public function setIdArticle(int $idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get the value of idTag
     *
     * @return  int
     */
    public function getIdTag()
    {
        return $this->idTag;
    }

    /**
     * Set the value of idTag
     *
     * @param  int  $idTag
     *
     * @return  self
     */
    public function setIdTag(int $idTag)
    {
        $this->idTag = $idTag;

        return $this;
    }
}
