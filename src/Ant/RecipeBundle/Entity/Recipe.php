<?php

    namespace Ant\RecipeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Ant\RecipeBundle\Util\Slugger;

    
    /**
    * @ORM\Entity(repositoryClass="Ant\RecipeBundle\Repository\RecipeRepository")
    */
    class Recipe{
        
        /** 
         * @ORM\Id
         * @ORM\Column(name="id", type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
        
        /**
        * @var string
        *
        * @ORM\Column(name="name", type="string", length=255)
        */
        protected $name;
        
        /**
        * @var string
        *
        * @ORM\Column(name="descripcion", type="text", nullable=true)
        */
        protected $description;
        
        /**
        * @var string
        *
        * @ORM\Column(name="elaboration", type="text", nullable=true)
        */
        protected $elaboration;        
        
        /** 
         * @var time
         * 
         * @ORM\Column(type="integer") 
         */
        protected $time;
        
        /**
        * @var string
        *
        * @ORM\Column(name="category", type="text")
        */
        protected $category;
        
        /**
        * @var string
        *
        * @ORM\Column(name="slug", type="string", length=255, nullable=true)
        */
        protected $slug;
        
        /**
        * @var string
        *
        * @ORM\Column(name="path_video", type="text")
        */
        protected $pathVideo;
        
        /**
        * @var string
        *
        * @ORM\Column(name="diners", type="string", length=255)
        */
        protected $diners;
        
        /** @ORM\OneToMany(targetEntity="Ant\RecipeBundle\Entity\RecipeIngredient", cascade={"remove"}, mappedBy="recipe") */
        private $recipeIngredients;
        
        function getId() {
            return $this->id;
        }

        function getName() {
            return $this->name;
        }

        function getDescription() {
            return $this->description;
        }

        function getElaboration() {
            return $this->elaboration;
        }

        function getTime() {
            return $this->time;
        }

        function getCategory() {
            return $this->category;
        }

        function getSlug() {
            return $this->slug;
        }

        function getPathVideo() {
            return $this->pathVideo;
        }

        function getDiners() {
            return $this->diners;
        }

        function getRecipeIngredients() {
            return $this->recipeIngredients;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setName($name) {
            $this->name = $name;
            $this->slug = Slugger::getSlug($name);
        }

        function setDescription($description) {
            $this->description = $description;
        }

        function setElaboration($elaboration) {
            $this->elaboration = $elaboration;
        }

        function setTime($time) {
            $this->time = $time;
        }

        function setCategory($category) {
            $this->category = $category;
        }

        function setSlug($slug) {
            $this->slug = $slug;
        }

        function setPathVideo($pathVideo) {
            $this->pathVideo = $pathVideo;
        }

        function setDiners($diners) {
            $this->diners = $diners;
        }

        function setRecipeIngredients($recipeIngredients) {
            $this->recipeIngredients = $recipeIngredients;
        }

        public function __toString(){
            return $this->getNombre();
        }
        
    }

