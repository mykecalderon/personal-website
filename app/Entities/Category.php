<?php

namespace App\Entities;

use App\Entities\WpEntity;

class Category extends WpEntity
{
    protected $id;
    protected $name;
    protected $slug;
    protected $link;

    public function hydrate($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->link = $data->link;

        return $this;
    }

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