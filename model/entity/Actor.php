<?php
namespace Model\entity;

class Actor
{
        protected $id;
        private $name;
        private $firstName;

        public function __construct(int $id, string $name, string $firstName)
        {
                $this->id = $id;
                $this->name = $name;
                $this->firstName = $firstName;
        }



         /**
          * Get the value of id
         */ 
        public function getId()
        {
             return $this->id;
         }

         /**
         * Set the value of id
         *
         * @return  self
          */ 
         public function setId($id)
         {
          $this->id = $id;

           return $this;
         }


        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of firstName
         */
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

 
}
