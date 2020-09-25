<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="Article", indexes={@ORM\Index(name="id user", columns={"id_user"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecrea", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $datecrea = 'current_timestamp()';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datemodif", type="date", nullable=true, options={"default"="NULL"})
     */
    private $datemodif = 'NULL';

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="idArticle")
     * @ORM\JoinTable(name="tag-article",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_article", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_tag", referencedColumnName="id")
     *   }
     * )
     */
    private $idTag;

    /**
     * Constructor
     */
    //public function __construct()
    //{
    //    $this->idTag = new \Doctrine\Common\Collections\ArrayCollection();
    //}

}
