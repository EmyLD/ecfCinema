<?php

class Role

{
        private $id;
        private $character;
        private $actor;

        public function __construct(int $id, string $character, Actor $actor)
        {
                $this->id = $id;
                $this->character = $character;
                $this->setActor($actor);
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
         * Get the value of character
         */
        public function getCharacter()
        {
                return $this->character;
        }

        /**
         * Set the value of character
         *
         * @return  self
         */
        public function setCharacter($character)
        {

                $this->character = $character;

                return $this;
        }

        /**
         * Get the value of actor
         */ 
        public function getActor()
        {

                return $this->actor;
        }

                /**
                 * Set the value of actor
                 *
                 * @return  self
                 */ 
        public function setActor($actor)
        {

                $this->actor = $actor;

                return $this;
        }
}
