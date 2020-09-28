<?php

namespace App\Entity;

use App\Repository\TagArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagArticleRepository::class)
 */
class TagArticle
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="tagArticles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_article;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Tag::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_tag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArticle(): ?Article
    {
        return $this->id_article;
    }

    public function setIdArticle(?Article $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    public function getIdTag(): ?Tag
    {
        return $this->id_tag;
    }

    public function setIdTag(?Tag $id_tag): self
    {
        $this->id_tag = $id_tag;

        return $this;
    }
}
