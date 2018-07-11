<?php

namespace App\Entities;

use App\Entities\WpEntity;

class Author extends WpEntity
{
    protected $id;
    protected $name;
    protected $url;
    protected $description;
    protected $link;
    protected $slug;
    protected $avatar_urls;

    public function hydrate($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->url = $data->url;
        $this->description = $data->description;
        $this->link = $data->link;
        $this->slug = $data->slug;
        $this->avatar_urls = $data->avatar_urls;

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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
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
    public function getAvatarUrls()
    {
        return $this->avatar_urls;
    }
}