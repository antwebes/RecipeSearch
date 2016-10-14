<?php

    namespace Ant\RecipeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    
    /**
    * @ORM\Entity
    */
    class RecipeIngredient{
        
        
        /**
        * @var string
        *
        * @ORM\Column(name="quantity", type="string", length=255)
        */
        protected $quantity;
        
        /**
        * @var boolean
        *
        * @ORM\Column(name="mandatory", type="boolean", nullable=false)
        */
        protected $mandatory;
        
        /** 
         * @ORM\Id()
         * @ORM\ManyToOne(targetEntity="Ant\RecipeBundle\Entity\Ingredient", inversedBy="recipeIngredients") 
         * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id", nullable=true) 
         */
        private $ingredient;
        
        /** 
         * @ORM\Id()
         * @ORM\ManyToOne(targetEntity="Ant\RecipeBundle\Entity\Recipe", inversedBy="recipeIngredients") 
         * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=false) 
         */
        private $recipe;
        
        function getQuantity() {
            return $this->quantity;
        }

        function getMandatory() {
            return $this->mandatory;
        }

        function getIngredient() {
            return $this->ingredient;
        }

        function getRecipe() {
            return $this->recipe;
        }

        function setQuantity($quantity) {
            $this->quantity = $quantity;
        }

        function setMandatory($mandatory) {
            $this->mandatory = $mandatory;
        }

        function setIngredient($ingredient) {
            $this->ingredient = $ingredient;
        }

        function setRecipe($recipe) {
            $this->recipe = $recipe;
        }

        public function __toString(){
            return $this->getNombre();
        }
    }


