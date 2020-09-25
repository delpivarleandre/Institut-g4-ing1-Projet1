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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titre
     *
     * @return  string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @param  string  $titre
     *
     * @return  self
     */
    public function setTitre(string $titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of contenu
     *
     * @return  string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @param  string  $contenu
     *
     * @return  self
     */
    public function setContenu(string $contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of datecrea
     *
     * @return  \DateTime
     */
    public function getDatecrea()
    {
        return $this->datecrea;
    }

    /**
     * Set the value of datecrea
     *
     * @param  \DateTime  $datecrea
     *
     * @return  self
     */
    public function setDatecrea(\DateTime $datecrea)
    {
        $this->datecrea = $datecrea;

        return $this;
    }

    /**
     * Get the value of datemodif
     *
     * @return  \DateTime|null
     */
    public function getDatemodif()
    {
        return $this->datemodif;
    }

    /**
     * Set the value of datemodif
     *
     * @param  \DateTime|null  $datemodif
     *
     * @return  self
     */
    public function setDatemodif($datemodif)
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    /**
     * Get the value of idUser
     *
     * @return  int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @param  int  $idUser
     *
     * @return  self
     */
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}
