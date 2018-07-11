<?php

namespace App\Entities;

class Category
{
    protected $id;
    protected $name;
    protected $slug;
    protected $link;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }
}