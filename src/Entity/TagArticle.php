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
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_article", referencedColumnName="id")
     * })
     */
    private $idArticle;

    /**
     * @var \Tag
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tag", referencedColumnName="id")
     * })
     */
    private $idTag;


}
