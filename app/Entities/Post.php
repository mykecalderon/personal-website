<?php

namespace App\Entities;

use App\Entities\Author;
use App\Entities\Category;
use Carbon\Carbon;

class Post
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

    public static function createFromData($data)
    {
        return (new static)->hydrate($data);
    }

    public function hydrate($data)
    {
        $this->id = $data->id;
        $this->author = $this->extractAuthor($data->_embedded->author);
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
        $this->category = $this->extractCategory($data->_embedded->{"wp:term"});
        $this->tags = $this->extractTags($data->_embedded->{"wp:term"});

        return $this;
    }

    public function extractAuthor($data)
    {
        $data = head($data);

        $author = new Author();
        $author->setId($data->id);
        $author->setName($data->name);
        $author->setUrl($data->url);
        $author->setDescription($data->description);
        $author->setLink($data->link);
        $author->setSlug($data->slug);
        $author->setAvatarUrls($data->avatar_urls);

        return $author;
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

    public function extractCategory($data)
    {
        $cat = collect($data)->collapse()->where('taxonomy', 'category')->first();

        $category = new Category();
        $category->setId($cat->id);
        $category->setName($cat->name);
        $category->setSlug($cat->slug);
        $category->setLink($cat->link);

        return $category;
    }

    public function extractTags($data)
    {
        return collect($data)->collapse()->where('taxonomy', 'post_tag')->pluck('name')->toArray();
    }

    protected function carbonDate($date)
    {
        return Carbon::parse($date);
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