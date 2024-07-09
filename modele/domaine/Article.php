<?php
class Article
{
    private $id;
    private $titre;
    private $resume;
    private $contenu;
    private $dateCreation;
    private $dateModification;
    private $categorie;

    public function __construct($id, $titre, $resume, $contenu, $dateCreation, $dateModification, $categorie)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->resume = $resume;
        $this->contenu = $contenu;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->categorie = $categorie;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    public function getResume()
    {
        return $this->resume;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    public function getDateModification()
    {
        return $this->dateModification;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setReseume($resume)
    {
        $this->resume = $resume;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setDatePublication($datePublication)
    {
        $this->dateCreation = $datePublication;
    }

    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}
