<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_crea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modif;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Id", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\OneToMany(targetEntity=TagArticle::class, mappedBy="id_article", orphanRemoval=true)
     */
    private $tagArticles;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="id_article", orphanRemoval=true)
     */
    private $commentaires;

    public function __construct()
    {
        $this->tagArticles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateCrea(): ?\DateTimeInterface
    {
        return $this->date_crea;
    }

    public function setDateCrea(\DateTimeInterface $date_crea): self
    {
        $this->date_crea = $date_crea;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->date_modif;
    }

    public function setDateModif(\DateTimeInterface $date_modif): self
    {
        $this->date_modif = $date_modif;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|TagArticle[]
     */
    public function getTagArticles(): Collection
    {
        return $this->tagArticles;
    }

    public function addTagArticle(TagArticle $tagArticle): self
    {
        if (!$this->tagArticles->contains($tagArticle)) {
            $this->tagArticles[] = $tagArticle;
            $tagArticle->setIdArticle($this);
        }

        return $this;
    }

    public function removeTagArticle(TagArticle $tagArticle): self
    {
        if ($this->tagArticles->contains($tagArticle)) {
            $this->tagArticles->removeElement($tagArticle);
            // set the owning side to null (unless already changed)
            if ($tagArticle->getIdArticle() === $this) {
                $tagArticle->setIdArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdArticle() === $this) {
                $commentaire->setIdArticle(null);
            }
        }

        return $this;
    }
}
