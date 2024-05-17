<?php

namespace Model\entity;

class Movie
{
        protected $id;
        private $title;
        private $director;
        private $poster;
        private $year;
        private $roles = [];



        public function __construct(int $id, string $title, string $director, string $poster, int $year, array $roles)
        {
                $this->id = $id;
                $this->title = $title;
                $this->director = $director;
                $this->poster = $poster;
                $this->year = $year;
                $this->roles[] = $roles;
        }

        /**
         * Get the value of title
         */
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of director
         */
        public function getDirector()
        {
                return $this->director;
        }

        /**
         * Set the value of director
         *
         * @return  self
         */
        public function setDirector($director)
        {
                $this->director = $director;

                return $this;
        }

        /**
         * Get the value of poster
         */
        public function getPoster()
        {
                return $this->poster;
        }

        /**
         * Set the value of poster
         *
         * @return  self
         */
        public function setPoster($poster)
        {
                $this->poster = $poster;

                return $this;
        }

        /**
         * Get the value of year
         */
        public function getYear()
        {
                return $this->year;
        }

        /**
         * Set the value of year
         *
         * @return  self
         */
        public function setYear($year)
        {
                $this->year = $year;

                return $this;
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
         * Get the value of roles
         */
        public function getRoles()
        {
                return $this->roles;
        }

        /**
         * Set the value of roles
         *
         * @return  self
         */
        public function setRoles($roles)
        {
                $this->roles = $roles;

                return $this;
        }
}
