<?php

namespace App\Entities;

use App\Entities\Author;
use App\Entities\Category;
use Carbon\Carbon;

class Post extends WpEntity
{
    protected $id;
    protected $author;
    protected $title;
    protected $slug;
    protected $featured_image;
    protected $featured;
    protected $excerpt;
    protected $content;
    protected $format;
    protected $status;
    protected $publishes_at;
    protected $created_at;
    protected $updated_at;
    protected $category;
    protected $tags;

    public function hydrate($data)
    {
        $this->id = $data->id;
        $this->author = $this->createAuthor($data->_embedded->author);
        $this->title = $data->title->rendered;
        $this->slug = $data->slug;
        $this->featured_image = $this->featuredImage($data->_embedded);
        $this->featured = ($data->sticky) ? 1 : null;
        $this->excerpt = $data->excerpt->rendered;
        $this->content = $data->content->rendered;
        $this->format = $data->format;
        $this->status = 'publish';
        $this->publishes_at = $this->carbonDate($data->date);
        $this->created_at = $this->carbonDate($data->date);
        $this->updated_at = $this->carbonDate($data->modified);
        $this->category = $this->createCategory($data->_embedded->{"wp:term"});
        $this->tags = $this->createTags($data->_embedded->{"wp:term"});

        return $this;
    }

    public function createAuthor($data)
    {
        $data = head($data);

        return Author::createFromData($data);
    }

    public function featuredImage($data)
    {
        if (property_exists($data, "wp:featuredmedia")) {
            $data = head($data->{"wp:featuredmedia"});
            if (isset($data->source_url)) {
                return $data->source_url;
            }
        }
        return null;
    }

    public function createCategory($data)
    {
        $data = collect($data)->collapse()->where('taxonomy', 'category')->first();

        return Category::createFromData($data);
    }

    public function createTags($data)
    {
        return collect($data)->collapse()->where('taxonomy', 'post_tag')->pluck('name')->toArray();
    }

    protected function carbonDate($date)
    {
        return Carbon::parse($date);
    }

    public function getUrl()
    {
        return route('posts.show', $this->slug);
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    /**
     * @return mixed
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getPublishesAt()
    {
        return $this->publishes_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}