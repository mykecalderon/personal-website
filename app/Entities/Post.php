<?php

namespace App\Entities;

use App\Entities\Author;
use App\Entities\Category;
use Carbon\Carbon;

class Post
{
    protected $id;
    protected $user_id;
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
     * @param mixed $tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

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
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    /**
     * @param mixed $featured_image
     *
     * @return self
     */
    public function setFeaturedImage($featured_image)
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @param mixed $featured
     *
     * @return self
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @param mixed $excerpt
     *
     * @return self
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     *
     * @return self
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublishesAt()
    {
        return $this->publishes_at;
    }

    /**
     * @param mixed $publishes_at
     *
     * @return self
     */
    public function setPublishesAt($publishes_at)
    {
        $this->publishes_at = $publishes_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}