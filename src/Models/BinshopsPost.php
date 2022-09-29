<?php

namespace BinshopsBlog\Models;

use Illuminate\Database\Eloquent\Model;
use BinshopsBlog\Scopes\BinshopsBlogPublishedScope;
use Carbon\Carbon;

/**
 * Class BinshopsPost
 * @package BinshopsBlog\Models
 */
class BinshopsPost extends Model
{
    /**
     * @var array
     */
    public $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * @var array
     */
    public $dates = [
        'posted_at'
    ];

    /**
     * @var array
     */
    public $fillable = [
        'is_published',
        'posted_at',
    ];

    /**
     * The associated post translations
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postTranslations()
    {
        return $this->hasMany(BinshopsPostTranslation::class,"post_id");
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /* If user is logged in and \Auth::user()->canManageBinshopsBlogPosts() == true, show any/all posts.
           otherwise (which will be for most users) it should only show published posts that have a posted_at
           time <= Carbon::now(). This sets it up: */
        static::addGlobalScope(new BinshopsBlogPublishedScope());

        static::deleting(function($post) { // before delete() method call this
            $post->postTranslations()->delete();
        });
    }

    /**
     * The associated author (if user_id) is set
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(config("binshopsblog.user_model"), 'user_id');
    }

    /**
     * Return author string (either from the User (via ->user_id), or the submitted author_name value
     * @return string
     */
    public function author_string()
    {
        if ($this->author) {
            return optional($this->author)->name;
        } else {
            return 'Unknown Author';
        }
    }

    /**
     * The associated categories for this blog post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(BinshopsCategory::class, 'binshops_post_categories','post_id','category_id');
    }

    /**
     * Comments for this post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(BinshopsComment::class, 'post_id');
    }

    public static function getPostsByCategorySlug($category_slug)
    {
        $lang_id = BinshopsLanguage::getLangID();
        $category = BinshopsCategoryTranslation::where("slug", $category_slug)->with('category')->firstOrFail()->category;
        $categoryChain = $category->getAncestorsAndSelf();
        $posts = $category->posts()->where("binshops_post_categories.category_id", $category->id)->with([ 'postTranslations' => function($query) use ($lang_id){
            $query->where("lang_id" , '=' , $lang_id);
        }
        ])->get();

        $posts = BinshopsPostTranslation::join('binshops_posts', 'binshops_post_translations.post_id', '=', 'binshops_posts.id')
                ->where('lang_id', $lang_id)
                ->where("is_published" , '=' , true)
                ->where('posted_at', '<', Carbon::now()->format('Y-m-d H:i:s'))
                ->orderBy("posted_at", "desc")
                ->whereIn('binshops_posts.id', $posts->pluck('id'))
                ->paginate(config("binshopsblog.per_page", 10));

        return $posts;

    }

}
