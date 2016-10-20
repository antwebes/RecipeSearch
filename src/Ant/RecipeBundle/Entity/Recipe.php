<?php

    namespace Ant\RecipeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Ant\RecipeBundle\Util\Slugger;
    use Vich\UploaderBundle\Mapping\Annotation as Vich;
    use Symfony\Component\HttpFoundation\File\File;
    

    
    /**
    * @ORM\Entity(repositoryClass="Ant\RecipeBundle\Repository\RecipeRepository")
    * @Vich\Uploadable
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
        protected $descripcion;
        
        /**
        * @var string
        *
        * @ORM\Column(name="elaboracion", type="text", nullable=true)
        */
        protected $elaboracion;        
        
        /** 
         * @var time
         * 
         * @ORM\Column(type="integer") 
         */
        protected $time;
        
        /** 
         * @var string
         * 
         * @ORM\Column(name="image", type="string") 
         */
        protected $image;
        
        /** 
         * @var string
         * 
         * @Vich\UploadableField(mapping="recipe_images", fileNameProperty="image")
         */
        protected $imageFile;
        
        /** 
         * @var datetime
         * 
         * @ORM\Column(type="datetime", nullable=true) 
         */
        protected $updatedAt;
        
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

        function getDescripcion() {
            return $this->descripcion;
        }

        function getElaboracion() {
            return $this->elaboracion;
        }
        
        function getImageFile() {
            return $this->imageFile;
        }
        
        function getImage() {
            return $this->image;
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

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        function setElaboracion($elaboracion) {
            $this->elaboracion = $elaboracion;
        }
        
        function setImage($image) {
            $this->image = $image;
        }
        
        function setImageFile(File $image = null){
            $this->imageFile = $image;
            if($image){
                $this->updatedAt = new \DateTime('now');
            }
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
            return $this->getName();
        }
        
    }

