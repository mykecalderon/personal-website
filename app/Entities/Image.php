<?php

namespace App\Entities;

use App\Entities\WpEntity;

class Image extends WpEntity
{
    protected $id;
    protected $title;
    protected $caption;
    protected $alt_text;
    protected $slug;
    protected $width;
    protected $height;
    protected $sizes;
    protected $link;

    public function hydrate($data)
    {
        $this->id = $data->id;
        $this->title = $data->title->rendered;
        $this->caption = $data->caption->rendered;
        $this->alt_text = $data->alt_text;
        $this->slug = $data->slug;
        $this->width = $data->media_details->width;
        $this->height = $data->media_details->height;
        $this->sizes = $data->media_details->sizes;
        $this->link = $data->source_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailUrl()
    {
        return $this->getSizes()->thumbnail->source_url;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return mixed
     */
    public function getAltText()
    {
        return $this->alt_text;
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
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }
}