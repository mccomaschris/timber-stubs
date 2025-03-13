<?php
/**
 * Generated stub declarations for Timber.
 *  @see https://github.com/mccomaschris/timber-stubs
 */

namespace Timber;

/**
 * Trait implementing ArrayAccess::getOffset() using lazy instantiation.
 *
 * @see https://timber.github.io/docs/v2/guides/posts.md#laziness-and-caching
 * @internal
 */
trait AccessesPostsLazily
{
    /**
     * Whether Timber\Post instances have been lazily instantiated.
     *
     * @var bool
     */
    private $realized = false;
    /**
     * PostFactory instance used internally to instantiate Posts.
     *
     * @var PostFactory
     */
    private $factory;
    /**
     * Realizes a lazy collection of posts.
     *
     * For better performance, Post Collections do not instantiate `Timber\Post` objects
     * at query time. They instantiate each `Timber\Post` only as needed, i.e. while
     * iterating or for direct array access (`$coll[$i]`). Since specific `Timber\Post`
     * implementations may have expensive `::setup()` operations, this is usually
     * what you want, but not always. For example, you may want to force eager
     * instantiation to front-load a collection of posts to be cached. To eagerly instantiate
     * a lazy collection of objects is to "realize" that collection.
     *
     * @api
     * @example
     * ```php
     * $lazy_posts = \Timber\Helper::transient('my_posts', function() {
     *   return \Timber\Timber::get_posts([
     *          'post_type' => 'some_post_type',
     *   ]);
     * }, HOUR_IN_SECONDS);
     *
     * foreach ($lazy_posts as $post) {
     *   // This will incur the performance cost of Post::setup().
     * }
     *
     * // Contrast with:
     *
     * $eager_posts = \Timber\Helper::transient('my_posts', function() {
     *   $query = \Timber\Timber::get_posts([
     *          'post_type' => 'some_post_type',
     *   ]);
     *   // Incur Post::setup() cost up front.
     *   return $query->realize();
     * }, HOUR_IN_SECONDS);
     *
     * foreach ($eager_posts as $post) {
     *   // No additional overhead here.
     * }
     * ```
     * @return PostCollectionInterface The realized PostQuery.
     */
    public function realize() : self
    {
    }
    /**
     * @internal
     */
    public function getArrayCopy() : array
    {
    }
    /**
     * @api
     * @return array
     */
    public function to_array() : array
    {
    }
    /**
     * @deprecated 2.0.0 use PostCollectionInterface::to_array() instead
     * @api
     * @return array
     */
    public function get_posts() : array
    {
    }
    /**
     * Lazily instantiates Timber\Post instances from WP_Post objects.
     *
     * @internal
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
    }
    /**
     * @internal
     */
    private function factory() : \Timber\Factory\PostFactory
    {
    }
}
/**
 * Class Admin
 */
class Admin
{
    public static function init()
    {
    }
    /**
     * Display a message in the admin.
     *
     * @date    01/07/2020
     *
     * @param string  $text to display
     * @param string  $class of the notice 'error' (red) or 'warning' (yellow)
     */
    protected static function show_notice($text, $class = 'error')
    {
    }
}
/**
 * Class Core
 */
#[\AllowDynamicProperties]
abstract class Core
{
    public $id;
    public $ID;
    public $object_type;
    /**
     * This method is needed to complement the magic __get() method, because Twig uses `isset()`
     * internally.
     *
     * @internal
     * @link https://github.com/twigphp/Twig/issues/601
     * @link https://twig.symfony.com/doc/2.x/recipes.html#using-dynamic-object-properties
     * @return boolean
     */
    public function __isset($field)
    {
    }
    /**
     * Magic method dispatcher for meta fields, for convenience in Twig views.
     *
     * Called when explicitly invoking non-existent methods on a Core object. This method is not
     * meant to be called directly.
     *
     * @example
     * ```php
     * $post = Timber\Post::get( get_the_ID() );
     *
     * update_post_meta( $post->id, 'favorite_zep4_track', 'Black Dog' );
     *
     * Timber::render( 'rock-n-roll.twig', array( 'post' => $post ) );
     * ```
     * ```twig
     * {# Since this method does not exist explicitly on the Post class,
     *    it will dynamically dispatch the magic __call() method with an argument
     *    of "favorite_zep4_track" #}
     * <span>Favorite <i>Zeppelin IV</i> Track: {{ post.favorite_zep4_track() }}</span>
     * ```
     * @link https://secure.php.net/manual/en/language.oop5.overloading.php#object.call
     * @link https://github.com/twigphp/Twig/issues/2
     * @api
     *
     * @param string $field     The name of the method being called.
     * @param array  $arguments Enumerated array containing the parameters passed to the function.
     *                          Not used.
     *
     * @return mixed The value of the meta field named `$field` if truthy, `false` otherwise.
     */
    public function __call($field, $arguments)
    {
    }
    /**
     * Magic getter for dynamic meta fields, for convenience in Twig views.
     *
     * This method is not meant to be called directly.
     *
     * @example
     * ```php
     * $post = Timber\Post::get( get_the_ID() );
     *
     * update_post_meta( $post->id, 'favorite_darkside_track', 'Any Colour You Like' );
     *
     * Timber::render('rock-n-roll.twig', array( 'post' => $post ));
     * ```
     * ```twig
     * {# Since this property does not exist explicitly on the Post class,
     *    it will dynamically dispatch the magic __get() method with an argument
     *    of "favorite_darkside_track" #}
     * <span>Favorite <i>Dark Side of the Moon</i> Track: {{ post.favorite_darkside_track }}</span>
     * ```
     * @link https://secure.php.net/manual/en/language.oop5.overloading.php#object.get
     * @link https://twig.symfony.com/doc/2.x/recipes.html#using-dynamic-object-properties
     *
     * @param string $field The name of the property being accessed.
     *
     * @return mixed The value of the meta field, or the result of invoking `$field()` as a method
     * with no arguments, or `false` if neither returns a truthy value.
     */
    public function __get($field)
    {
    }
    /**
     * Takes an array or object and adds the properties to the parent object.
     *
     * @example
     * ```php
     * $data = array( 'airplane' => '757-200', 'flight' => '5316' );
     * $post = Timber::get_post();
     * $post->import(data);
     *
     * echo $post->airplane; // 757-200
     * ```
     * @param array|object $info an object or array you want to grab data from to attach to the Timber object
     */
    public function import($info, $force = false, $only_declared_properties = false)
    {
    }
    /**
     * Updates metadata for the object.
     *
     * @deprecated 2.0.0 Use `update_metadata()` instead.
     *
     * @param string $key   The key of the meta field to update.
     * @param mixed  $value The new value.
     */
    public function update($key, mixed $value)
    {
    }
}
/**
 * Class Archive
 *
 * The `Timber\Archives` class is used to generate a menu based on the date archives of your posts.
 *
 * The [Nieman Foundation News site](https://nieman.harvard.edu/news/) has an example of how the
 * output can be used in a real site ([screenshot](https://cloud.githubusercontent.com/assets/1298086/9610076/3cdca596-50a5-11e5-82fd-acb74c09c482.png)).
 *
 * @api
 * @example
 * ```php
 * $context['archives'] = new Timber\Archives( $args );
 * ```
 * ```twig
 * <ul>
 * {% for item in archives.items %}
 *     <li><a href="{{item.link}}">{{item.name}}</a></li>
 *     {% for child in item.children %}
 *         <li class="child"><a href="{{child.link}}">{{child.name}}</a></li>
 *     {% endfor %}
 * {% endfor %}
 * </ul>
 * ```
 * ```html
 * <ul>
 *     <li>2015</li>
 *     <li class="child">May</li>
 *     <li class="child">April</li>
 *     <li class="child">March</li>
 *     <li class="child">February</li>
 *     <li class="child">January</li>
 *     <li>2014</li>
 *     <li class="child">December</li>
 *     <li class="child">November</li>
 *     <li class="child">October</li>
 * </ul>
 * ```
 */
class Archives extends \Timber\Core
{
    /**
     * @var array Preserves arguments sent with the constructor for possible later use when
     * displaying items.
     */
    protected $args;
    /**
     * URL prefix.
     *
     * @api
     * @var string
     */
    public $base = '';
    /**
     * @api
     * @var array The items of the archives to iterate through and markup for your page.
     */
    public $items;
    /**
     * Build an Archives menu
     *
     * @api
     * @param array  $args {
     *      Optional. Array of arguments.
     *
     *      @type bool   $show_year => false
     *      @type string
     *      @type string $type => 'monthly-nested'
     *      @type int    $limit => -1
     *      @type bool   $show_post_count => false
     *      @type string $order => 'DESC'
     *      @type string $post_type => 'post'
     *      @type bool   $show_year => false
     *      @type bool   $nested => false
     * }
     * @param string $base Any additional paths that need to be prepended to the URLs that are
     *                     generated, for example: "tags". Default ''.
     */
    public function __construct($args = null, $base = '')
    {
    }
    /**
     * Initialize the Archives
     *
     * @internal
     * @param array|string $args
     * @param string       $base
     */
    public function init($args = null, $base = '')
    {
    }
    /**
     * @internal
     * @param string $url
     * @param string $text
     * @param int    $post_count
     * @return mixed
     */
    protected function get_archives_link($url, $text, $post_count = 0)
    {
    }
    /**
     * @internal
     * @param array  $args
     * @param string $last_changed
     * @param string $join
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    protected function get_items_yearly($args, $last_changed, $join, $where, $order, $limit)
    {
    }
    /**
     * @internal
     * @param array|string $args
     * @param string $last_changed
     * @param string $join
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param bool $nested
     * @return array
     */
    protected function get_items_monthly($args, $last_changed, $join, $where, $order, $limit = '', $nested = true)
    {
    }
    /**
     * Gets archive items.
     *
     * @api
     * @deprecated 2.0.0, use `{{ archives.items }}` instead.
     * @see \Timber\Archives::items()
     * @return array|string
     */
    public function get_items($args = null)
    {
    }
    /**
     * @api
     * @param array|string $args Optional. Array of arguments.
     * @return array|string
     */
    public function items($args = null)
    {
    }
}
/**
 * Interface DateTimeInterface
 *
 * An interface for classes that implement getting date/time values from objects.
 *
 * @since 2.0.0
 */
interface DatedInterface
{
    /**
     * Gets the timestamp when the object was published.
     *
     * @api
     * @since 2.0.0
     *
     * @return false|int Unix timestamp on success, false on failure.
     */
    public function timestamp();
    /**
     * Gets the timestamp when the object was last modified.
     *
     * @api
     * @since 2.0.0
     *
     * @return false|int Unix timestamp on success, false on failure.
     */
    public function modified_timestamp();
    /**
     * Gets the publishing date of the object.
     *
     * @api
     * @since 2.0.0
     *
     * @param string|null $date_format Optional. PHP date format. Will use the `date_format` option
     *                                 as a default.
     * @return string
     */
    public function date($date_format = null);
    /**
     * Gets the date of the last modification of the object.
     *
     * @param string|null $date_format Optional. PHP date format. Will use the `date_format` option
     *                                 as a default.
     *
     * @return string
     */
    public function modified_date($date_format = null);
}
/**
 * Interface Setupable
 */
interface Setupable
{
    /**
     * Sets up an object.
     *
     * @since 2.0.0
     *
     * @return Core The affected object.
     */
    public function setup();
    /**
     * Resets variables after the loop.
     *
     * @since 2.0.0
     *
     * @return Core The affected object.
     */
    public function teardown();
}
/**
 * Interface CoreInterface
 */
interface CoreInterface
{
    public function __call($field, $args);
    public function __get($field);
    /**
     * @return boolean
     */
    public function __isset($field);
}
/**
 * Interface CoreEntityInterface
 */
interface CoreEntityInterface
{
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return object|null
     */
    public function wp_object();
    /**
     * Checks whether the current user can edit the object.
     *
     * @return bool
     */
    public function can_edit() : bool;
}
/**
 * Interface MetaInterface
 *
 * An interface for classes that implement getting meta values from the database.
 *
 * @since 2.0.0
 */
interface MetaInterface
{
    /**
     * Gets a meta value.
     *
     * Returns a meta value for an object that’s saved in the database.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @param array  $args       An array of arguments for getting the meta value. Third-party
     *                           integrations can use this argument to make their API arguments
     *                           available in Timber. Default empty.
     * @return mixed The meta field value.
     */
    public function meta($field_name = '', $args = []);
    /**
     * Gets a meta value directly from the database.
     *
     * Returns a raw meta value for an object that’s saved in the database. Be aware that the value
     * can still be filtered by plugins.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The raw meta field value.
     */
    public function raw_meta($field_name = '');
    /**
     * Gets a meta value.
     *
     * @api
     * @deprecated 2.0.0
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name);
}
abstract class CoreEntity extends \Timber\Core implements \Timber\CoreInterface, \Timber\CoreEntityInterface, \Timber\MetaInterface
{
    /**
     * Gets an object meta value.
     *
     * Returns a meta value or all meta values for all custom fields of an object saved in the
     * meta database table.
     *
     * Fetching all values is only advised during development, because it can have a big performance
     * impact, when all filters are applied.
     *
     * @api
     *
     * @param string $field_name Optional. The field name for which you want to get the value. If
     *                           no field name is provided, this function will fetch values for all
     *                           custom fields. Default empty string.
     * @param array $args An array of arguments for getting the meta value. Third-party integrations
     *                    can use this argument to make their API arguments available in Timber.
     *                    Default empty array.
     * @return mixed The custom field value or an array of custom field values. Null if no value
     *               could be found.
     */
    public function meta($field_name = '', $args = [])
    {
    }
    /**
     * Gets an object meta value directly from the database.
     *
     * Returns a raw meta value or all raw meta values saved in the meta database table. In
     * comparison to `meta()`, this function will return raw values that are not filtered by third-
     * party plugins.
     *
     * Fetching raw values for all custom fields will not have a big performance impact, because
     * WordPress gets all meta values, when the first meta value is accessed.
     *
     * @api
     * @since 2.0.0
     *
     * @param string $field_name Optional. The field name for which you want to get the value. If
     *                           no field name is provided, this function will fetch values for all
     *                           custom fields. Default empty string.
     *
     * @return null|mixed The meta field value(s). Null if no value could be found, an empty array
     *                    if all fields were requested but no values could be found.
     */
    public function raw_meta($field_name = '')
    {
    }
    /**
     * Gets an object meta value.
     *
     * Returns a meta value or all meta values for all custom fields of an object saved in the object
     * meta database table.
     *
     * Fetching all values is only advised during development, because it can have a big performance
     * impact, when all filters are applied.
     *
     * @api
     *
     * @param string $field_name Optional. The field name for which you want to get the value. If
     *                           no field name is provided, this function will fetch values for all
     *                           custom fields. Default empty string.
     * @param array  $args       {
     *      An array of arguments for getting the meta value. Third-party integrations can use this
     *      argument to make their API arguments available in Timber. Default empty array.
     * }
     * @param bool $apply_filters Whether to apply filtering of meta values. You can also use
     *                               the `raw_meta()` method as a shortcut to apply this argument.
     *                            Default true.
     *
     * @return mixed The custom field value or an array of custom field values. Null if no value
     *               could be found.
     */
    protected function fetch_meta($field_name = '', $args = [], $apply_filters = true)
    {
    }
    /**
     * Finds any WP_Post objects and converts them to Timber\Posts
     *
     * @api
     * @param array|CoreEntity $data
     */
    public function convert($data)
    {
    }
    /**
     * Get the base object type
     *
     * @return string
     */
    protected function get_object_type()
    {
    }
}
/**
 * Class Post
 *
 * This is the object you use to access or extend WordPress posts. Think of it as Timber's (more
 * accessible) version of `WP_Post`. This is used throughout Timber to represent posts retrieved
 * from WordPress making them available to Twig templates. See the PHP and Twig examples for an
 * example of what it’s like to work with this object in your code.
 *
 * @api
 * @example
 *
 * **single.php**
 *
 * ```php
 * $context = Timber::context();
 *
 * Timber::render( 'single.twig', $context );
 * ```
 *
 * **single.twig**
 *
 * ```twig
 * <article>
 *     <h1 class="headline">{{ post.title }}</h1>
 *     <div class="body">
 *         {{ post.content }}
 *     </div>
 * </article>
 * ```
 *
 * ```html
 * <article>
 *     <h1 class="headline">The Empire Strikes Back</h1>
 *     <div class="body">
 *         It is a dark time for the Rebellion. Although the Death Star has been
 *         destroyed, Imperial troops have driven the Rebel forces from their
 *         hidden base and pursued them across the galaxy.
 *     </div>
 * </article>
 * ```
 */
class Post extends \Timber\CoreEntity implements \Timber\DatedInterface, \Timber\Setupable, \Stringable
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_Post|null
     */
    protected ?\WP_Post $wp_object = null;
    /**
     * @var string What does this class represent in WordPress terms?
     */
    public $object_type = 'post';
    /**
     * @var string What does this class represent in WordPress terms?
     */
    public static $representation = 'post';
    /**
     * @internal
     * @var string stores the processed content internally
     */
    protected $___content;
    /**
     * @var string|boolean The returned permalink from WP's get_permalink function
     */
    protected $_permalink;
    /**
     * @var array Stores the results of the next Timber\Post in a set inside an array (in order to manage by-taxonomy)
     */
    protected $_next = [];
    /**
     * @var array Stores the results of the previous Timber\Post in a set inside an array (in order to manage by-taxonomy)
     */
    protected $_prev = [];
    /**
     * @var string Stores the CSS classes for the post (ex: "post post-type-book post-123")
     */
    protected $_css_class;
    /**
     * @api
     * @var int The numeric WordPress id of a post.
     */
    public $id;
    /**
     * @api
     * @var int The numeric WordPress id of a post, capitalized to match WordPress usage.
     */
    public $ID;
    /**
     * @api
     * @var int The numeric ID of the a post's author corresponding to the wp_user database table
     */
    public $post_author;
    /**
     * @api
     * @var string The raw text of a WP post as stored in the database
     */
    public $post_content;
    /**
     * @api
     * @var string The raw date string as stored in the WP database, ex: 2014-07-05 18:01:39
     */
    public $post_date;
    /**
     * @api
     * @var string The raw text of a manual post excerpt as stored in the database
     */
    public $post_excerpt;
    /**
     * @api
     * @var int The numeric ID of a post's parent post
     */
    public $post_parent;
    /**
     * @api
     * @var string The status of a post ("draft", "publish", etc.)
     */
    public $post_status;
    /**
     * @api
     * @var string The raw text of a post's title as stored in the database
     */
    public $post_title;
    /**
     * @api
     * @var string The name of the post type, this is the machine name (so "my_custom_post_type" as
     *      opposed to "My Custom Post Type")
     */
    public $post_type;
    /**
     * @api
     * @var string The URL-safe slug, this corresponds to the poorly-named "post_name" in the WP
     *      database, ex: "hello-world"
     */
    public $slug;
    /**
     * @var string Stores the PostType object for the post.
     */
    protected $__type;
    /**
     * Create and initialize a new instance of the called Post class
     * (i.e. Timber\Post or a subclass).
     *
     * @internal
     * @return Post
     */
    public static function build(\WP_Post $wp_post) : static
    {
    }
    /**
     * If you send the constructor nothing it will try to figure out the current post id based on
     * being inside The_Loop.
     *
     * @internal
     */
    protected function __construct()
    {
    }
    /**
     * This is helpful for twig to return properties and methods see:
     * https://github.com/fabpot/Twig/issues/2
     *
     * This is also here to ensure that {{ post.class }} remains usable.
     *
     * @api
     *
     * @return mixed
     */
    public function __get($field)
    {
    }
    /**
     * This is helpful for twig to return properties and methods see:
     * https://github.com/fabpot/Twig/issues/2
     *
     * This is also here to ensure that {{ post.class }} remains usable
     *
     * @api
     *
     * @return mixed
     */
    public function __call($field, $args)
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Post|null
     */
    public function wp_object() : ?\WP_Post
    {
    }
    /**
     * Sets up a post.
     *
     * Sets up the `$post` global, and other global variables as well as variables in the
     * `$wp_query` global that makes Timber more compatible with WordPress.
     *
     * This function will be called automatically when you loop over Timber posts as well as in
     * `Timber::context()`.
     *
     * @api
     * @since 2.0.0
     *
     * @return Post The post instance.
     */
    public function setup()
    {
    }
    /**
     * Resets variables after post has been used.
     *
     * This function will be called automatically when you loop over Timber posts.
     *
     * @api
     * @since 2.0.0
     *
     * @return Post The post instance.
     */
    public function teardown()
    {
    }
    /**
     * Determine whether or not an admin/editor is looking at the post in "preview mode" via the
     * WordPress admin
     * @internal
     * @return bool
     */
    protected static function is_previewing()
    {
    }
    /**
     * Outputs the title of the post if you do something like `<h1>{{post}}</h1>`
     *
     * @api
     * @return string
     */
    public function __toString()
    {
    }
    protected function get_post_preview_object()
    {
    }
    protected function get_post_preview_id($query)
    {
    }
    /**
     * Updates post_meta of the current object with the given value.
     *
     * @deprecated 2.0.0 Use `update_post_meta()` instead.
     *
     * @param string $field The key of the meta field to update.
     * @param mixed  $value The new value.
     */
    public function update($field, $value)
    {
    }
    /**
     * Gets a excerpt of your post.
     *
     * If you have an excerpt is set on the post, the excerpt will be used. Otherwise it will try to
     * pull from an excerpt from `post_content`. If there’s a `<!-- more -->` tag in the post
     * content, it will use that to mark where to pull through.
     *
     * @api
     * @see PostExcerpt
     *
     * @param array $options {
     *     An array of configuration options for generating the excerpt. Default empty.
     *
     *     @type int      $words     Number of words in the excerpt. Default `50`.
     *     @type int|bool $chars     Number of characters in the excerpt. Default `false` (no
     *                               character limit).
     *     @type string   $end       String to append to the end of the excerpt. Default '&hellip;'
     *                               (HTML ellipsis character).
     *     @type bool     $force     Whether to shorten the excerpt to the length/word count
     *                               specified, if the editor wrote a manual excerpt longer than the
     *                               set length. Default `false`.
     *     @type bool     $strip     Whether to strip HTML tags. Default `true`.
     *     @type string   $read_more String for what the "Read More" text should be. Default
     *                               'Read More'.
     * }
     * @example
     * ```twig
     * <h2>{{ post.title }}</h2>
     * <div>{{ post.excerpt({ words: 100, read_more: 'Keep reading' }) }}</div>
     * ```
     * @return PostExcerpt
     */
    public function excerpt(array $options = [])
    {
    }
    /**
     * Gets an excerpt of your post.
     *
     * If you have an excerpt is set on the post, the excerpt will be used. Otherwise it will try to
     * pull from an excerpt from `post_content`. If there’s a `<!-- more -->` tag in the post
     * content, it will use that to mark where to pull through.
     *
     * This method returns a `Timber\PostExcerpt` object, which is a **chainable object**. This
     * means that you can change the output of the excerpt by **adding more methods**. Refer to the
     * [documentation of the `Timber\PostExcerpt` class](https://timber.github.io/docs/v2/reference/timber-postexcerpt/)
     * to get an overview of all the available methods.
     *
     * @api
     * @deprecated 2.0.0, use `{{ post.excerpt }}` instead.
     * @see PostExcerpt
     * @example
     * ```twig
     * {# Use default excerpt #}
     * <p>{{ post.excerpt }}</p>
     *
     * {# Change the post excerpt text #}
     * <p>{{ post.excerpt.read_more('Continue Reading') }}</p>
     *
     * {# Additionally restrict the length to 50 words #}
     * <p>{{ post.excerpt.length(50).read_more('Continue Reading') }}</p>
     * ```
     * @return PostExcerpt
     */
    public function preview()
    {
    }
    /**
     * Gets the link to a page number.
     *
     * @internal
     * @param int $i
     * @return string|null Link to page number or `null` if link could not be read.
     */
    protected static function get_wp_link_page($i)
    {
    }
    /**
     * Gets info to import on Timber post object.
     *
     * Used internally by init, etc. to build Timber\Post object.
     *
     * @internal
     *
     * @param array $data Data to update.
     * @return array
     */
    protected function get_info(array $data) : array
    {
    }
    /**
     * Gets the comment form for use on a single article page
     *
     * @api
     * @param array $args see [WordPress docs on comment_form](https://codex.wordpress.org/Function_Reference/comment_form)
     *                    for reference on acceptable parameters
     * @return string of HTML for the form
     */
    public function comment_form($args = [])
    {
    }
    /**
     * Gets the terms associated with the post.
     *
     * @api
     * @example
     * ```twig
     * <section id="job-feed">
     * {% if jobs is not empty %}
     *   {% for post in jobs %}
     *       <div class="job">
     *           <h2>{{ post.title }}</h2>
     *           <p>{{ post.terms({
     *               taxonomy: 'category',
     *               orderby: 'name',
     *               order: 'ASC'
     *           })|join(', ') }}</p>
     *       </div>
     *   {% endfor %}
     * {% endif %}
     * </section>
     * ```
     * ```html
     * <section id="job-feed">
     *     <div class="job">
     *         <h2>Cheese Maker</h2>
     *         <p>Cheese, Food, Fromage</p>
     *     </div>
     *     <div class="job">
     *         <h2>Mime</h2>
     *         <p>Performance, Silence</p>
     *     </div>
     * </section>
     * ```
     * ```php
     * // Get all terms of a taxonomy.
     * $terms = $post->terms( 'category' );
     *
     * // Get terms of multiple taxonomies.
     * $terms = $post->terms( array( 'books', 'movies' ) );
     *
     * // Use custom arguments for taxonomy query and options.
     * $terms = $post->terms( [
     *     'taxonomy' => 'custom_tax',
     *     'orderby'  => 'count'
     * ], [
     *     'merge' => false
     * ] );
     * ```
     *
     * @param string|array $query_args     Any array of term query parameters for getting the terms.
     *                                  See `WP_Term_Query::__construct()` for supported arguments.
     *                                  Use the `taxonomy` argument to choose which taxonomies to
     *                                  get. Defaults to querying all registered taxonomies for the
     *                                  post type. You can use custom or built-in WordPress
     *                                  taxonomies (category, tag). Timber plays nice and figures
     *                                  out that `tag`, `tags` or `post_tag` are all the same
     *                                  (also for `categories` or `category`). For custom
     *                                  taxonomies you need to define the proper name.
     * @param array $options {
     *     Optional. An array of options for the function.
     *
     *     @type bool $merge Whether the resulting array should be one big one (`true`) or whether
     *                       it should be an array of sub-arrays for each taxonomy (`false`).
     *                       Default `true`.
     * }
     * @return array An array of taxonomies.
     */
    public function terms($query_args = [], $options = [])
    {
    }
    /**
     * @api
     * @param string|int $term_name_or_id
     * @param string $taxonomy
     * @return bool
     */
    public function has_term($term_name_or_id, $taxonomy = 'all')
    {
    }
    /**
     * Gets the number of comments on a post.
     *
     * @api
     * @return int The number of comments on a post
     */
    public function comment_count() : int
    {
    }
    /**
     * @api
     * @param string $field_name
     * @return boolean
     */
    public function has_field($field_name)
    {
    }
    /**
     * Gets the field object data from Advanced Custom Fields.
     * This includes metadata on the field like whether it's conditional or not.
     *
     * @api
     * @since 1.6.0
     * @param string $field_name of the field you want to lookup.
     * @return mixed
     */
    public function field_object($field_name)
    {
    }
    /**
     * @inheritDoc
     */
    protected function fetch_meta($field_name = '', $args = [], $apply_filters = true)
    {
    }
    /**
     * Gets a post meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ post.meta('field_name') }}` instead.
     * @see \Timber\Post::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Import field data onto this object
     *
     * @api
     * @deprecated since 2.0.0
     * @param string $field_name
     */
    public function import_field($field_name)
    {
    }
    /**
     * Get the CSS classes for a post without cache.
     * For usage you should use `{{post.class}}`
     *
     * @internal
     * @param string $class additional classes you want to add.
     * @example
     * ```twig
     * <article class="{{ post.post_class }}">
     *    {# Some stuff here #}
     * </article>
     * ```
     *
     * ```html
     * <article class="post-2612 post type-post status-publish format-standard has-post-thumbnail hentry category-data tag-charleston-church-shooting tag-dylann-roof tag-gun-violence tag-hate-crimes tag-national-incident-based-reporting-system">
     *    {# Some stuff here #}
     * </article>
     * ```
     * @return string a space-separated list of classes
     */
    public function post_class($class = '')
    {
    }
    /**
     * Get the CSS classes for a post, but with caching css post classes. For usage you should use `{{ post.class }}` instead of `{{post.css_class}}` or `{{post.post_class}}`
     *
     * @internal
     * @param string $class additional classes you want to add.
     * @see \Timber\Post::$_css_class
     * @example
     * ```twig
     * <article class="{{ post.class }}">
     *    {# Some stuff here #}
     * </article>
     * ```
     *
     * @return string a space-separated list of classes
     */
    public function css_class($class = '')
    {
    }
    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function get_method_values() : array
    {
    }
    /**
     * Return the author of a post
     *
     * @api
     * @example
     * ```twig
     * <h1>{{post.title}}</h1>
     * <p class="byline">
     *     <a href="{{post.author.link}}">{{post.author.name}}</a>
     * </p>
     * ```
     * @return User|null A User object if found, false if not
     */
    public function author()
    {
    }
    /**
     * Got more than one author? That's cool, but you'll need Co-Authors plus or another plugin to access any data
     *
     * @api
     * @return array
     */
    public function authors()
    {
    }
    /**
     * Get the author (WordPress user) who last modified the post
     *
     * @api
     * @example
     * ```twig
     * Last updated by {{ post.modified_author.name }}
     * ```
     * ```html
     * Last updated by Harper Lee
     * ```
     * @return User|null A User object if found, false if not
     */
    public function modified_author()
    {
    }
    /**
     * Get the categories on a particular post
     *
     * @api
     * @return array of Timber\Term objects
     */
    public function categories()
    {
    }
    /**
     * Gets a category attached to a post.
     *
     * If multiple categories are set, it will return just the first one.
     *
     * @api
     * @return Term|null
     */
    public function category()
    {
    }
    /**
     * Returns an array of children on the post as Timber\Posts
     * (or other claass as you define).
     *
     * @api
     * @example
     * ```twig
     * {% if post.children is not empty %}
     *     Here are the child pages:
     *     {% for child in post.children %}
     *         <a href="{{ child.link }}">{{ child.title }}</a>
     *     {% endfor %}
     * {% endif %}
     * ```
     * @param string|array $args _optional_ An array of arguments for the `get_children` function or a string/non-indexed array to use as the post type(s).
     * @return PostCollectionInterface
     */
    public function children($args = 'any')
    {
    }
    /**
     * Gets the comments on a Timber\Post and returns them as an array of `Timber\Comment` objects (or whatever comment class you set).
     *
     * @api
     * Gets the comments on a `Timber\Post` and returns them as a `Timber\CommentThread`: a PHP
     * ArrayObject of [`Timber\Comment`](https://timber.github.io/docs/v2/reference/timber-comment/)
     * (or whatever comment class you set).
     * @api
     *
     * @param int    $count        Set the number of comments you want to get. `0` is analogous to
     *                             "all".
     * @param string $order        Use ordering set in WordPress admin, or a different scheme.
     * @param string $type         For when other plugins use the comments table for their own
     *                             special purposes. Might be set to 'liveblog' or other, depending
     *                             on what’s stored in your comments table.
     * @param string $status       Could be 'pending', etc.
     * @see CommentThread for an example with nested comments
     * @return bool|CommentThread
     *
     * @example
     *
     * **single.twig**
     *
     * ```twig
     * <div id="post-comments">
     *   <h4>Comments on {{ post.title }}</h4>
     *   <ul>
     *     {% for comment in post.comments() %}
     *       {% include 'comment.twig' %}
     *     {% endfor %}
     *   </ul>
     *   <div class="comment-form">
     *     {{ function('comment_form') }}
     *   </div>
     * </div>
     * ```
     *
     * **comment.twig**
     *
     * ```twig
     * {# comment.twig #}
     * <li>
     *   <p class="comment-author">{{ comment.author.name }} says:</p>
     *   <div>{{ comment.content }}</div>
     * </li>
     * ```
     */
    public function comments($count = null, $order = 'wp', $type = 'comment', $status = 'approve')
    {
    }
    /**
     * If the Password form is to be shown, show it!
     * @return string|void
     */
    protected function maybe_show_password_form()
    {
    }
    /**
     *
     */
    protected function get_revised_data_from_method($method, $args = false)
    {
    }
    /**
     * Gets the actual content of a WordPress post.
     *
     * As opposed to using `{{ post.post_content }}`, this will run the hooks/filters attached to
     * the `the_content` filter. It will return your post’s content with WordPress filters run on it
     * – which means it will parse blocks, convert shortcodes or run `wpautop()` on the content.
     *
     * If you use page breaks in your content to split your post content into multiple pages,
     * use `{{ post.paged_content }}` to display only the content for the current page.
     *
     * @api
     * @example
     * ```twig
     * <article>
     *     <h1>{{ post.title }}</h1>
     *
     *     <div class="content">{{ post.content }}</div>
     * </article>
     * ```
     *
     * @param int $page Optional. The page to show if the content of the post is split into multiple
     *                  pages. Read more about this in the [Pagination Guide](https://timber.github.io/docs/v2/guides/pagination/#paged-content-within-a-post). Default `0`.
     * @param int $len Optional. The number of words to show. Default `-1` (show all).
     * @param bool $remove_blocks Optional. Whether to remove blocks. Defaults to false. True when called from the $post->excerpt() method.
     * @return string The content of the post.
     */
    public function content($page = 0, $len = -1, $remove_blocks = false)
    {
    }
    /**
     * Handles for an circumstance with the Block editor where a "more" block has an option to
     * "Hide the excerpt on the full content page" which hides everything prior to the inserted
     * "more" block
     * @ticket #2218
     * @param string $content
     * @return string
     */
    protected function content_handle_no_teaser_block($content)
    {
    }
    /**
     * Gets the paged content for a post.
     *
     * You will use this, if you use `<!--nextpage-->` in your post content or the Page Break block
     * in the Block Editor. Use `{{ post.pagination }}` to create a pagination for your paged
     * content. Learn more about this in the [Pagination Guide](https://timber.github.io/docs/v2/guides/pagination/#paged-content-within-a-post).
     *
     * @example
     * ```twig
     * {{ post.paged_content }}
     * ```
     *
     * @return string The content for the current page. If there’s no page break found in the
     *                content, the whole content is returned.
     */
    public function paged_content()
    {
    }
    /**
     * Gets the timestamp when the post was published.
     *
     * @api
     * @since 2.0.0
     *
     * @return false|int Unix timestamp on success, false on failure.
     */
    public function timestamp()
    {
    }
    /**
     * Gets the timestamp when the post was last modified.
     *
     * @api
     * @since 2.0.0
     *
     * @return false|int Unix timestamp on success, false on failure.
     */
    public function modified_timestamp()
    {
    }
    /**
     * Gets the publishing date of the post.
     *
     * This function will also apply the
     * [`get_the_date`](https://developer.wordpress.org/reference/hooks/get_the_date/) filter to the
     * output.
     *
     * If you use {{ post.date }} with the |time_ago filter, then make sure that you use a time
     * format including the full time and not just the date.
     *
     * @api
     * @example
     * ```twig
     * {# Uses date format set in Settings → General #}
     * Published on {{ post.date }}
     * OR
     * Published on {{ post.date('F jS') }}
     * which was
     * {{ post.date('U')|time_ago }}
     * {{ post.date('Y-m-d H:i:s')|time_ago }}
     * {{ post.date(constant('DATE_ATOM'))|time_ago }}
     * ```
     *
     * ```html
     * Published on January 12, 2015
     * OR
     * Published on Jan 12th
     * which was
     * 8 years ago
     * ```
     *
     * @param string|null $date_format Optional. PHP date format. Will use the `date_format` option
     *                                 as a default.
     *
     * @return string
     */
    public function date($date_format = null)
    {
    }
    /**
     * Gets the date the post was last modified.
     *
     * This function will also apply the
     * [`get_the_modified_date`](https://developer.wordpress.org/reference/hooks/get_the_modified_date/)
     * filter to the output.
     *
     * @api
     * @example
     * ```twig
     * {# Uses date format set in Settings → General #}
     * Last modified on {{ post.modified_date }}
     * OR
     * Last modified on {{ post.modified_date('F jS') }}
     * ```
     *
     * ```html
     * Last modified on January 12, 2015
     * OR
     * Last modified on Jan 12th
     * ```
     *
     * @param string|null $date_format Optional. PHP date format. Will use the `date_format` option
     *                                 as a default.
     *
     * @return string
     */
    public function modified_date($date_format = null)
    {
    }
    /**
     * Gets the time the post was published to use in your template.
     *
     * This function will also apply the
     * [`get_the_time`](https://developer.wordpress.org/reference/hooks/get_the_time/) filter to the
     * output.
     *
     * @api
     * @example
     * ```twig
     * {# Uses time format set in Settings → General #}
     * Published at {{ post.time }}
     * OR
     * Published at {{ post.time|time('G:i') }}
     * ```
     *
     * ```html
     * Published at 1:25 pm
     * OR
     * Published at 13:25
     * ```
     *
     * @param string|null $time_format Optional. PHP date format. Will use the `time_format` option
     *                                 as a default.
     *
     * @return string
     */
    public function time($time_format = null)
    {
    }
    /**
     * Gets the time of the last modification of the post to use in your template.
     *
     * This function will also apply the
     * [`get_the_time`](https://developer.wordpress.org/reference/hooks/get_the_modified_time/)
     * filter to the output.
     *
     * @api
     * @example
     * ```twig
     * {# Uses time format set in Settings → General #}
     * Published at {{ post.time }}
     * OR
     * Published at {{ post.time|time('G:i') }}
     * ```
     *
     * ```html
     * Published at 1:25 pm
     * OR
     * Published at 13:25
     * ```
     *
     * @param string|null $time_format Optional. PHP date format. Will use the `time_format` option
     *                                 as a default.
     *
     * @return string
     */
    public function modified_time($time_format = null)
    {
    }
    /**
     * Returns the PostType object for a post’s post type with labels and other info.
     *
     * @api
     * @since 1.0.4
     * @example
     * ```twig
     * This post is from <span>{{ post.type.labels.name }}</span>
     * ```
     *
     * ```html
     * This post is from <span>Recipes</span>
     * ```
     * @return PostType
     */
    public function type()
    {
    }
    /**
     * Checks whether the current user can edit the post.
     *
     * @api
     * @example
     * ```twig
     * {% if post.can_edit %}
     *     <a href="{{ post.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return bool
     */
    public function can_edit() : bool
    {
    }
    /**
     * Gets the edit link for a post if the current user has the correct rights.
     *
     * @api
     * @example
     * ```twig
     * {% if post.can_edit %}
     *     <a href="{{ post.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return string|null The edit URL of a post in the WordPress admin or null if the current user can’t edit the
     *                     post.
     */
    public function edit_link() : ?string
    {
    }
    /**
     * @api
     * @return mixed
     */
    public function format()
    {
    }
    /**
     * whether post requires password and correct password has been provided
     * @api
     * @return boolean
     */
    public function password_required()
    {
    }
    /**
     * get the permalink for a post object
     * @api
     * @example
     * ```twig
     * <a href="{{post.link}}">Read my post</a>
     * ```
     * @return string ex: https://example.org/2015/07/my-awesome-post
     */
    public function link()
    {
    }
    /**
     * @api
     * @return string
     */
    public function name()
    {
    }
    /**
     * Gets the next post that is adjacent to the current post in a collection.
     *
     * Works pretty much the same as
     * [`get_next_post()`](https://developer.wordpress.org/reference/functions/get_next_post/).
     *
     * @api
     * @example
     * ```twig
     * {% if post.next %}
     *     <a href="{{ post.next.link }}">{{ post.next.title }}</a>
     * {% endif %}
     * ```
     * @param bool|string $in_same_term Whether the post should be in a same taxonomy term. Default
     *                                  `false`.
     *
     * @return mixed
     */
    public function next($in_same_term = false)
    {
    }
    /**
     * Gets a data array to display a pagination for your paginated post.
     *
     * Use this in combination with `{{ post.paged_content }}`.
     *
     * @api
     * @example
     * Using simple links to the next an previous page.
     * ```twig
     * {% if post.pagination.next is not empty %}
     *     <a href="{{ post.pagination.next.link|esc_url }}">Go to next page</a>
     * {% endif %}
     *
     * {% if post.pagination.prev is not empty %}
     *     <a href="{{ post.pagination.prev.link|esc_url }}">Go to previous page</a>
     * {% endif %}
     * ```
     * Using a pagination for all pages.
     * ```twig
     * {% if post.pagination.pages is not empty %}
     *    <nav aria-label="pagination">
     *        <ul>
     *            {% for page in post.pagination.pages %}
     *                <li>
     *                    {% if page.current %}
     *                        <span aria-current="page">Page {{ page.title }}</span>
     *                    {% else %}
     *                        <a href="{{ page.link|esc_ur }}">Page {{ page.title }}</a>
     *                    {% endif %}
     *                </li>
     *            {% endfor %}
     *        </ul>
     *    </nav>
     * {% endif %}
     * ```
     *
     * @return array An array with data to build your paginated content.
     */
    public function pagination()
    {
    }
    /**
     * Finds any WP_Post objects and converts them to Timber\Post objects.
     *
     * @api
     * @param array|WP_Post $data
     */
    public function convert($data)
    {
    }
    /**
     * Gets the parent (if one exists) from a post as a Timber\Post object.
     * Honors Class Maps.
     *
     * @api
     * @example
     * ```twig
     * Parent page: <a href="{{ post.parent.link }}">{{ post.parent.title }}</a>
     * ```
     * @return bool|Post
     */
    public function parent()
    {
    }
    /**
     * Gets the relative path of a WP Post, so while link() will return https://example.org/2015/07/my-cool-post
     * this will return just /2015/07/my-cool-post
     *
     * @api
     * @example
     * ```twig
     * <a href="{{post.path}}">{{post.title}}</a>
     * ```
     * @return string
     */
    public function path()
    {
    }
    /**
     * Get the previous post that is adjacent to the current post in a collection.
     *
     * Works pretty much the same as
     * [`get_previous_post()`](https://developer.wordpress.org/reference/functions/get_previous_post/).
     *
     * @api
     * @example
     * ```twig
     * {% if post.prev %}
     *     <a href="{{ post.prev.link }}">{{ post.prev.title }}</a>
     * {% endif %}
     * ```
     * @param bool|string $in_same_term Whether the post should be in a same taxonomy term. Default
     *                                  `false`.
     * @return mixed
     */
    public function prev($in_same_term = false)
    {
    }
    /**
     * Gets the tags on a post, uses WP's post_tag taxonomy
     *
     * @api
     * @return array
     */
    public function tags()
    {
    }
    /**
     * Gets the post’s thumbnail ID.
     *
     * @api
     * @since 2.0.0
     *
     * @return false|int The default post’s ID. False if no thumbnail was defined.
     */
    public function thumbnail_id()
    {
    }
    /**
     * get the featured image as a Timber/Image
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ post.thumbnail.src }}" />
     * ```
     * @return Image|null of your thumbnail
     */
    public function thumbnail()
    {
    }
    /**
     * Returns the processed title to be used in templates. This returns the title of the post after WP's filters have run. This is analogous to `the_title()` in standard WP template tags.
     *
     * @api
     * @example
     * ```twig
     * <h1>{{ post.title }}</h1>
     * ```
     * @return string
     */
    public function title()
    {
    }
    /**
     * Returns galleries from the post’s content.
     *
     * @api
     * @example
     * ```twig
     * {{ post.gallery }}
     * ```
     * @return array A list of arrays, each containing gallery data and srcs parsed from the
     * expanded shortcode.
     */
    public function gallery($html = true)
    {
    }
    protected function get_entity_name()
    {
    }
    /**
     * Given a base query and a list of taxonomies, return a list of queries
     * each of which queries for one of the taxonomies.
     * @example
     * ```
     * $this->partition_tax_queries(["object_ids" => [123]], ["a", "b"]);
     *
     * // result:
     * // [
     * //   ["object_ids" => [123], "taxonomy" => ["a"]],
     * //   ["object_ids" => [123], "taxonomy" => ["b"]],
     * // ]
     * ```
     * @internal
     */
    private function partition_tax_queries(array $query, array $taxonomies) : array
    {
    }
    /**
     * Get a PostFactory instance for internal usage
     *
     * @internal
     * @return PostFactory
     */
    private function factory()
    {
    }
}
/**
 * Class Attachment
 *
 * Objects of this class represent WordPress attachments. This is the basis that `Timber\Image`
 * objects build upon.
 *
 * @api
 * @since 2.0.0
 */
class Attachment extends \Timber\Post
{
    /**
     * Representation.
     *
     * @var string What does this class represent in WordPress terms?
     */
    public static $representation = 'attachment';
    /**
     * File.
     *
     * @api
     * @var string
     */
    protected string $file;
    /**
     * File location.
     *
     * @api
     * @var string The absolute path to the attachmend file in the filesystem
     *             (Example: `/var/www/htdocs/wp-content/uploads/2015/08/my-pic.jpg`)
     */
    protected string $file_loc;
    /**
     * File extension.
     *
     * @api
     * @since 2.0.0
     * @var string A file extension.
     */
    protected string $file_extension;
    /**
     * Absolute URL.
     *
     * @var string The absolute URL to the attachment.
     */
    public $abs_url;
    /**
     * Attachment metadata.
     *
     * @var array Attachment metadata.
     */
    protected array $metadata;
    /**
     * Size.
     *
     * @var integer|null
     */
    protected ?int $size = null;
    /**
     * Gets the src for an attachment.
     *
     * @api
     *
     * @return string The src of the attachment.
     */
    public function __toString() : string
    {
    }
    /**
     * Gets the link to an attachment.
     *
     * This returns a link to an attachment’s page, but not the link to the image src itself.
     *
     * @api
     * @example
     * ```twig
     * <a href="{{ image.link }}"><img src="{{ image.src }} "></a>
     * ```
     * ```html
     * <a href="https://example.org/my-cool-picture">
     *     <img src="https://example.org/wp-content/uploads/2015/whatever.jpg"/>
     * </a>
     * ```
     *
     * @return string The URL of the attachment.
     */
    public function link()
    {
    }
    /**
     * Gets the relative path to an attachment.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.path }}" />
     * ```
     * ```html
     * <img src="/wp-content/uploads/2015/08/pic.jpg" />
     * ```
     *
     * @return string The relative path to an attachment.
     */
    public function path() : string
    {
    }
    /**
     * Gets the relative path to the uploads folder of an attachment.
     *
     * @api
     *
     * @return string
     */
    public function file() : string
    {
    }
    /**
     * Gets the absolute path to an attachment.
     *
     * @api
     *
     * @return string
     */
    public function file_loc() : string
    {
    }
    /**
     * Gets the source URL for an attachment.
     *
     * @api
     * @example
     * ```twig
     * <a href="{{ get_attachment(post.meta('job_pdf')).src }}" download>
     * ```
     * ```html
     * <a href="https://example.org/wp-content/uploads/2015/08/job-ad-5noe2304i.pdf" download>
     * ```
     *
     * @return string
     */
    public function src() : string
    {
    }
    /**
     * Gets the caption of an attachment.
     *
     * @api
     * @since 2.0
     * @example
     * ```twig
     * <figure>
     *     <img src="{{ post.thumbnail.src }}">
     *
     *     {% if post.thumbnail is not empty %}
     *         <figcaption>{{ post.thumbnail.caption }}</figcaption
     *     {% endif %}
     * </figure>
     * ```
     *
     * @return string|null
     */
    public function caption() : ?string
    {
    }
    /**
     * Gets the raw filesize in bytes.
     *
     * Use the `size_format` filter to format the raw size into a human readable size («1 MB» instead of «1048576»)
     *
     * @api
     * @since 2.0.0
     * @example
     * @see https://developer.wordpress.org/reference/functions/size_format/
     *
     * Use filesize information in a link that downloads a file:
     *
     * ```twig
     * <a class="download" href="{{ attachment.src }}" download="{{ attachment.title }}">
     *     <span class="download-title">{{ attachment.title }}</span>
     *     <span class="download-info">(Download, {{ attachment.size|size_format }})</span>
     * </a>
     * ```
     *
     * @return int|null The raw filesize or null if it could not be read.
     */
    public function size() : ?int
    {
    }
    /**
     * Gets the extension of the attached file.
     *
     * @api
     * @since 2.0.0
     * @example
     * Use extension information in a link that downloads a file:
     *
     * ```twig
     * <a class="download" href="{{ attachment.src }}" download="{{ attachment.title }}">
     *     <span class="download-title">{{ attachment.title }}</span>
     *     <span class="download-info">
     *         (Download {{ attachment.extension|upper }}, {{ attachment.size }})
     *     </span>
     * </a>
     * ```
     *
     * @return string An uppercase extension string.
     */
    public function extension() : string
    {
    }
    /**
     * Gets the parent object.
     *
     * The parent object of an attachment is a post it is assigned to.
     *
     * @api
     * @example
     * ```twig
     * This image is assigned to {{ image.parent.title }}
     * ```
     *
     * @return null|Post Parent object as a `Timber\Post`. Returns `false` if no parent
     *                            object is defined.
     */
    public function parent() : ?\Timber\Post
    {
    }
    /**
     * Get a PHP array with pathinfo() info from the file
     *
     * @deprecated 2.0.0, use Attachment::pathinfo() instead
     * @return array
     */
    public function get_pathinfo()
    {
    }
    /**
     * Get a PHP array with pathinfo() info from the file
     *
     * @return array
     */
    public function pathinfo()
    {
    }
    /**
     * Get attachment metadata the lazy way.
     *
     * This method is used to retrieve the attachment metadata only when it's needed.
     *
     * @return array|string|int|null
     */
    protected function metadata(?string $key = null)
    {
    }
}
namespace Timber\Cache;

/**
 * Class Cleaner
 *
 * @api
 */
class Cleaner
{
    public static function clear_cache(string $mode = 'all') : bool
    {
    }
    /**
     * Clears Timber’s cache.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * Timber\Cache\Cleaner::clear_cache_timber();
     * ```
     *
     * @return bool
     */
    public static function clear_cache_timber()
    {
    }
    /**
     * Clears Twig’s cache.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * Timber\Cache\Cleaner::clear_cache_twig();
     * ```
     *
     * @return bool
     */
    public static function clear_cache_twig()
    {
    }
    protected static function delete_transients_single_site()
    {
    }
    protected static function delete_transients_multisite()
    {
    }
    public static function delete_transients()
    {
    }
}
class KeyGenerator
{
    /**
     * @return string
     */
    public function generateKey(mixed $value)
    {
    }
}
interface TimberKeyGeneratorInterface
{
    public function _get_cache_key();
}
class WPObjectCacheAdapter
{
    public function __construct(private readonly \Timber\Loader $timberloader, private $cache_group = 'timber')
    {
    }
    public function fetch($key)
    {
    }
    public function save($key, $value, $expire = 0)
    {
    }
}
namespace Timber;

/**
 * Class Comment
 *
 * The `Timber\Comment` class is used to view the output of comments. 99% of the time this will be
 * in the context of the comments on a post. However you can also fetch a comment directly using its
 * comment ID.
 *
 * @api
 * @example
 * ```php
 * $comment = Timber::get_comment( $comment_id );
 *
 * $context = [
 *     'comment_of_the_day' => $comment
 * ];
 *
 * Timber::render('index.twig', $context);
 * ```
 *
 * ```twig
 * <p class="comment">{{comment_of_the_day.content}}</p>
 * <p class="comment-attribution">- {{comment.author.name}}</p>
 * ```
 *
 * ```html
 * <p class="comment">But, O Sarah! If the dead can come back to this earth and flit unseen around those they loved, I shall always be near you; in the garish day and in the darkest night -- amidst your happiest scenes and gloomiest hours - always, always; and if there be a soft breeze upon your cheek, it shall be my breath; or the cool air fans your throbbing temple, it shall be my spirit passing by.</p>
 * <p class="comment-attribution">- Sullivan Ballou</p>
 * ```
 */
class Comment extends \Timber\CoreEntity implements \Stringable
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_Comment|null
     */
    protected ?\WP_Comment $wp_object = null;
    public $object_type = 'comment';
    public static $representation = 'comment';
    /**
     * @api
     * @var int
     */
    public $ID;
    /**
     * @api
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $comment_approved;
    /**
     * @api
     * @var string
     */
    public $comment_author_email;
    /**
     * @api
     * @var string
     */
    public $comment_content;
    /**
     * @api
     * @var string
     */
    public $comment_date;
    /**
     * @api
     * @var int
     */
    public $comment_ID;
    /**
     * @var int
     */
    public $comment_parent;
    /**
     * @api
     * @var int
     */
    public $user_id;
    /**
     * @api
     * @var int
     */
    public $post_id;
    /**
     * @api
     * @var string
     */
    public $comment_author;
    public $_depth = 0;
    protected $children = [];
    /**
     * Construct a Timber\Comment. This is protected to prevent direct instantiation,
     * which is no longer supported. Use `Timber::get_comment()` instead.
     *
     * @internal
     */
    protected function __construct()
    {
    }
    /**
     * Build a Timber\Comment. Do not call this directly. Use `Timber::get_comment()` instead.
     *
     * @internal
     * @param WP_Comment $wp_comment a native WP_Comment instance
     */
    public static function build(\WP_Comment $wp_comment) : static
    {
    }
    /**
     * Gets the content.
     *
     * @api
     * @return string
     */
    public function __toString()
    {
    }
    /**
     * @internal
     * @param integer $cid
     */
    public function init($cid)
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Comment|null
     */
    public function wp_object() : ?\WP_Comment
    {
    }
    /**
     * Gets the author.
     *
     * @api
     * @example
     * ```twig
     * <h3>Comments by...</h3>
     * <ol>
     * {% for comment in post.comments %}
     *     <li>{{comment.author.name}}, who is a {{comment.author.roles[0]}}</li>
     * {% endfor %}
     * </ol>
     * ```
     * ```html
     * <h3>Comments by...</h3>
     * <ol>
     *  <li>Jared Novack, who is a contributor</li>
     *  <li>Katie Ricci, who is a subscriber</li>
     *  <li>Rebecca Pearl, who is a author</li>
     * </ol>
     * ```
     * @return User
     */
    public function author()
    {
    }
    /**
     * Fetches the Gravatar.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{comment.avatar(36,template_uri~"/img/dude.jpg")}}" alt="Image of {{comment.author.name}}" />
     * ```
     * ```html
     * <img src="https://gravatar.com/i/sfsfsdfasdfsfa.jpg" alt="Image of Katherine Rich" />
     * ```
     * @param int|mixed    $size     Size of avatar.
     * @param string       $default  Default avatar URL.
     * @return bool|mixed|string
     */
    public function avatar($size = 92, $default = '')
    {
    }
    /**
     * Gets the content.
     *
     * @api
     * @return string
     */
    public function content()
    {
    }
    /**
     * Gets the comment children.
     *
     * @api
     * @return array Comments
     */
    public function children()
    {
    }
    /**
     * Adds a child.
     *
     * @api
     * @param Comment $child_comment Comment child to add.
     * @return array Comment children.
     */
    public function add_child(\Timber\Comment $child_comment)
    {
    }
    /**
     * Updates the comment depth.
     *
     * @api
     * @param int $depth Level of depth.
     */
    public function update_depth($depth = 0)
    {
    }
    /**
     * At what depth is this comment?
     *
     * @api
     * @return int
     */
    public function depth()
    {
    }
    /**
     * Is the comment approved?
     *
     * @api
     * @example
     * ```twig
     * {% if comment.approved %}
     *   Your comment is good
     * {% else %}
     *   Do you kiss your mother with that mouth?
     * {% endif %}
     * ```
     * @return boolean
     */
    public function approved()
    {
    }
    /**
     * The date for the comment.
     *
     * @api
     * @example
     * ```twig
     * {% for comment in post.comments %}
     * <article class="comment">
     *   <p class="date">Posted on {{ comment.date }}:</p>
     *   <p class="comment">{{ comment.content }}</p>
     * </article>
     * {% endfor %}
     * ```
     * ```html
     * <article class="comment">
     *   <p class="date">Posted on September 28, 2015:</p>
     *   <p class="comment">Happy Birthday!</p>
     * </article>
     * ```
     * @param string $date_format of desired PHP date format (eg "M j, Y").
     * @return string
     */
    public function date($date_format = '')
    {
    }
    /**
     * What time was the comment posted?
     *
     * @api
     * @example
     * ```twig
     * {% for comment in post.comments %}
     * <article class="comment">
     *   <p class="date">Posted on {{ comment.date }} at {{comment.time}}:</p>
     *   <p class="comment">{{ comment.content }}</p>
     * </article>
     * {% endfor %}
     * ```
     * ```html
     * <article class="comment">
     *   <p class="date">Posted on September 28, 2015 at 12:45 am:</p>
     *   <p class="comment">Happy Birthday!</p>
     * </article>
     * ```
     * @param string $time_format of desired PHP time format (eg "H:i:s").
     * @return string
     */
    public function time($time_format = '')
    {
    }
    /**
     * Gets a comment meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ comment.meta('field_name') }}` instead.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_meta_field($field_name)
    {
    }
    /**
     * Checks if the comment is a child.
     *
     * @api
     * @return bool
     */
    public function is_child()
    {
    }
    /**
     * Gets a comment meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ comment.meta('field_name') }}` instead.
     * @see \Timber\Comment::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Enqueue the WP threaded comments JavaScript, and fetch the reply link for various comments.
     *
     * @api
     * @param string $reply_text Text of the reply link.
     * @return string
     */
    public function reply_link($reply_text = 'Reply')
    {
    }
    /**
     * Checks whether the current user can edit the comment.
     *
     * @api
     * @example
     * ```twig
     * {% if comment.can_edit %}
     *     <a href="{{ comment.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return bool
     */
    public function can_edit() : bool
    {
    }
    /**
     * Gets the edit link for a comment if the current user has the correct rights.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```twig
     * {% if comment.can_edit %}
     *     <a href="{{ comment.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return string|null The edit URL of a comment in the WordPress admin or null if the current user can’t edit the
     *                     comment.
     */
    public function edit_link() : ?string
    {
    }
    /* AVATAR Stuff
       ======================= */
    /**
     * @internal
     * @return string
     */
    protected function avatar_email()
    {
    }
    /**
     * @internal
     * @param string $email_hash
     * @return string
     */
    protected function avatar_host($email_hash)
    {
    }
    /**
     * @internal
     * @param string $default
     * @param string $email
     * @param string $size
     * @param string $host
     * @return string
     */
    protected function avatar_default($default, $email, $size, $host)
    {
    }
    /**
     * @internal
     * @param string $default
     * @param string $host
     * @param string $email_hash
     * @param string $size
     * @return mixed
     */
    protected function avatar_out($default, $host, $email_hash, $size)
    {
    }
}
/**
 * Class CommentThread
 *
 * This object is a special type of array that hold WordPress comments as `Timber\Comment` objects.
 * You probably won't use this directly. This object is returned when calling `{{ post.comments }}`
 * in Twig.
 *
 * @example
 * ```twig
 * {# single.twig #}
 * <div id="post-comments">
 *   <h4>Comments on {{ post.title }}</h4>
 *   <ul>
 *     {% for comment in post.comments %}
 *       {% include 'comment.twig' %}
 *     {% endfor %}
 *   </ul>
 *   <div class="comment-form">
 *     {{ function('comment_form') }}
 *   </div>
 * </div>
 * ```
 *
 * ```twig
 * {# comment.twig #}
 * <li>
 *   <div>{{ comment.content }}</div>
 *   <p class="comment-author">{{ comment.author.name }}</p>
 *   {{ function('comment_form') }}
 *   <!-- nested comments here -->
 *   {% if comment.children %}
 *     <div class="replies">
 *	     {% for child_comment in comment.children %}
 *         {% include 'comment.twig' with { comment:child_comment } %}
 *       {% endfor %}
 *     </div>
 *   {% endif %}
 * </li>
 * ```
 */
class CommentThread extends \ArrayObject
{
    public $_orderby = '';
    public $_order = 'ASC';
    /**
     * Creates a new `Timber\CommentThread` object.
     *
     * @param int           $post_id The post ID.
     * @param array|boolean $args    Optional. An array of arguments or false if initialization
     *                               should be skipped.
     */
    public function __construct(public $post_id, $args = [])
    {
    }
    /**
     * @internal
     */
    protected function fetch_comments($args = [])
    {
    }
    /**
     * Gets the number of comments on a post.
     *
     * @return int The number of comments on a post.
     */
    public function mecount()
    {
    }
    protected function merge_args($args)
    {
    }
    /**
     * @internal
     */
    public function order($order = 'ASC')
    {
    }
    /**
     * @internal
     */
    public function orderby($orderby = 'wp')
    {
    }
    /**
     * Inits the object.
     *
     * @internal
     * @param array $args Optional.
     */
    public function init($args = [])
    {
    }
    /**
     * @internal
     */
    protected function clear()
    {
    }
    /**
     * @internal
     */
    protected function import_comments($arr)
    {
    }
}
/**
 * Class DateTimeHelper
 *
 * Helper class to work with dates and times.
 *
 * @api
 * @since 2.0.0
 */
class DateTimeHelper
{
    /**
     * Wrapper for wp_date().
     *
     * @api
     * @since 2.0.0
     *
     * @param null|string|false             $format   Optional. PHP date format. Will use the
     *                                                `date_format` option as a default.
     * @param string|int|DateTimeInterface $date     A date.
     * @param null|DateTimeZone            $timezone Optional. Timezone to output result in.
     *                                                Defaults to timezone from site settings.
     *
     * @return false|string
     */
    public static function wp_date($format = null, $date = null, $timezone = null)
    {
    }
    /**
     * Returns the difference between two times in a human readable format.
     *
     * Differentiates between past and future dates.
     *
     * @api
     * @see \human_time_diff()
     * @example
     * ```twig
     * {{ post.date('U')|time_ago }}
     * {{ post.date('Y-m-d H:i:s')|time_ago }}
     * {{ post.date(constant('DATE_ATOM'))|time_ago }}
     * ```
     *
     * @param int|string $from          Base date as a timestamp or a date string.
     * @param int|string $to            Optional. Date to calculate difference to as a timestamp or
     *                                  a date string. Default current time.
     * @param string     $format_past   Optional. String to use for past dates. To be used with
     *                                  `sprintf()`. Default `%s ago`.
     * @param string     $format_future Optional. String to use for future dates. To be used with
     *                                  `sprintf()`. Default `%s from now`.
     *
     * @return string
     */
    public static function time_ago($from, $to = null, $format_past = null, $format_future = null)
    {
    }
}
/**
 * Interface ImageInterface
 */
interface ImageInterface
{
    /**
     * Gets the relative path to an attachment.
     *
     * @api
     * @return string The relative path to an attachment.
     */
    public function path() : string;
    /**
     * Gets the caption of an attachment.
     *
     * @api
     * @since 2.0
     * @return string|null
     */
    public function caption() : ?string;
    /**
     * Gets filesize in bytes.
     *
     * @api
     * @since 2.0.0
     * @return int|null The filesize string in bytes, or null if the filesize can’t be read.
     */
    public function size() : ?int;
    /**
     * Gets the extension of the attached file.
     *
     * @api
     * @since 2.0.0
     * @return string|null An uppercase extension string.
     */
    public function extension() : ?string;
    /**
     * Gets the source URL for the image.
     *
     * @return string The src of the file.
     */
    public function __toString() : string;
    /**
     * Gets the source URL for the image.
     *
     * You can use WordPress image sizes (including the ones you registered with your theme or
     * plugin) by passing the name of the size to this function (like `medium` or `large`). If the
     * WordPress size has not been generated, it will return an empty string.
     *
     * @api
     * @param string $size Optional. The requested image size. This can be a size that was in
     *                     WordPress. Example: `medium` or `large`. Default `full`.
     *
     * @return string The src URL for the image.
     */
    public function src($size = 'full') : string;
    /**
     * Gets the width of the image in pixels.
     *
     * @api
     * @return int The width of the image in pixels.
     */
    public function width();
    /**
     * Gets the height of the image in pixels.
     *
     * @api
     * @return int The height of the image in pixels.
     */
    public function height();
    /**
     * Gets the aspect ratio of the image.
     *
     * @api
     * @return float The aspect ratio of the image.
     */
    public function aspect();
    /**
     * Gets the alt text for an image.
     *
     * For better accessibility, you should always add an alt attribute to your images, even if it’s
     * empty.
     *
     * @api
     * @return string|null Alt text stored in WordPress.
     */
    public function alt() : ?string;
}
/**
 * Class ExternalImage
 *
 * The `Timber\ExternalImage` class represents an image that is not part of the WordPress content (Attachment).
 * Instead, it’s an image that can be either a path (relative/absolute) on the same server, or a URL (either from the
 * same or from a different website). When you use a URL of an image on a different website, Timber will load it into
 * your WordPress installation once and then load it from there.
 *
 * @api
 * @example
 * ```php
 * $context = Timber::context();
 *
 * // Lets say you have an external image that you want to use in your theme
 *
 * $context['cover_image'] = Timber::get_external_image($url);
 *
 * Timber::render('single.twig', $context);
 * ```
 *
 * ```twig
 * <article>
 *   <img src="{{ cover_image.src }}" class="cover-image" />
 *   <h1 class="headline">{{ post.title }}</h1>
 *   <div class="body">
 *     {{ post.content }}
 *   </div>
 * </article>
 * ```
 *
 * ```html
 * <article>
 *   <img src="https://example.org/wp-content/uploads/2015/06/nevermind.jpg" class="cover-image" />
 *   <h1 class="headline">Now you've done it!</h1>
 *   <div class="body">
 *     Whatever whatever
 *   </div>
 * </article>
 * ```
 */
class ExternalImage implements \Timber\ImageInterface
{
    /**
     * Alt text.
     *
     * @api
     * @var string
     */
    protected string $alt_text;
    /**
     * Alt text.
     *
     * @api
     * @var string
     */
    protected string $caption;
    /**
     * Representation.
     *
     * @var string What does this class represent in WordPress terms?
     */
    public static $representation = 'image';
    /**
     * File location.
     *
     * @api
     * @var string The absolute path to the attachmend file in the filesystem
     *             (Example: `/var/www/htdocs/wp-content/themes/my-theme/images/`)
     */
    protected string $file_loc;
    /**
     * File extension.
     *
     * @api
     * @since 2.0.0
     * @var string A file extension.
     */
    protected string $file_extension;
    /**
     * Absolute URL.
     *
     * @var string The absolute URL to the attachment.
     */
    public $abs_url;
    /**
     * Size.
     *
     * @var integer|null
     */
    protected ?int $size = null;
    /**
     * File types.
     *
     * @var array An array of supported relative file types.
     */
    private $image_file_types = ['jpg', 'jpeg', 'png', 'svg', 'bmp', 'ico', 'gif', 'tiff', 'pdf'];
    /**
     * Image dimensions.
     *
     * @internal
     * @var ImageDimensions|null stores Image Dimensions in a structured way.
     */
    protected ?\Timber\ImageDimensions $image_dimensions = null;
    protected function __construct()
    {
    }
    /**
     * Inits the ExternalImage object.
     *
     * @internal
     * @param $url string URL or path to load the image from.
     * @param $args array An array of arguments for the image.
     */
    public static function build($url, array $args = []) : ?\Timber\ExternalImage
    {
    }
    /**
     * Gets the source URL for the image.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ post.thumbnail.src }}">
     * <img src="{{ post.thumbnail.src('medium') }}">
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" />
     * <img src="https://example.org/wp-content/uploads/2015/08/pic-800-600.jpg">
     * ```
     *
     * @param string $size Ignored. For compatibility with Timber\Image.
     *
     * @return string The src URL for the image.
     */
    public function src($size = 'full') : string
    {
    }
    /**
     * Gets the relative path to the file.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.path }}" />
     * ```
     * ```html
     * <img src="/wp-content/uploads/2015/08/pic.jpg" />
     * ```
     *
     * @return string The relative path to the image file.
     */
    public function path() : string
    {
    }
    /**
     * Gets the absolute path to the image.
     *
     * @api
     *
     * @return string
     */
    public function file_loc() : string
    {
    }
    /**
     * Gets filesize in a human-readable format.
     *
     * This can be useful if you want to display the human-readable filesize for a file. It’s
     * easier to read «16 KB» than «16555 bytes» or «1 MB» than «1048576 bytes».
     *
     * @api
     * @since 2.0.0
     * @example
     * Use filesize information in a link that downloads a file:
     *
     * ```twig
     * <a class="download" href="{{ attachment.src }}" download="{{ attachment.title }}">
     *     <span class="download-title">{{ attachment.title }}</span>
     *     <span class="download-info">(Download, {{ attachment.size }})</span>
     * </a>
     * ```
     *
     * @return null|int Filsize or null if the filesize couldn't be determined.
     */
    public function size() : ?int
    {
    }
    /**
     * Gets the src for an attachment.
     *
     * @api
     *
     * @return string The src of the attachment.
     */
    public function __toString() : string
    {
    }
    /**
     * Gets the extension of the attached file.
     *
     * @api
     * @since 2.0.0
     * @example
     *
     * Use extension information in a link that downloads a file:
     *
     * ```twig
     * <a class="download" href="{{ attachment.src }}" download="{{ attachment.title }}">
     *     <span class="download-title">{{ attachment.title }}</span>
     *     <span class="download-info">
     *         (Download {{ attachment.extension|upper }}, {{ attachment.size }})
     *     </span>
     * </a>
     * ```
     *
     * @return string|null An uppercase extension string.
     */
    public function extension() : ?string
    {
    }
    /**
     * Gets the width of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" width="{{ image.width }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" width="1600" />
     * ```
     *
     * @return int|null The width of the image in pixels. Null if the width can’t be read, e.g. because the file doesn’t
     *                  exist.
     */
    public function width() : ?int
    {
    }
    /**
     * Gets the height of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" height="{{ image.height }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" height="900" />
     * ```
     *
     * @return int|null The height of the image in pixels. Null if the height can’t be read, e.g. because the file
     *                  doesn’t exist.
     */
    public function height() : ?int
    {
    }
    /**
     * Gets the aspect ratio of the image.
     *
     * @api
     * @example
     * ```twig
     * {% if post.thumbnail.aspect < 1 %}
     *     {# handle vertical image #}
     *     <img src="{{ post.thumbnail.src|resize(300, 500) }}" alt="A basketball player" />
     * {% else %}
     *     <img src="{{ post.thumbnail.src|resize(500) }}" alt="A sumo wrestler" />
     * {% endif %}
     * ```
     *
     * @return float The aspect ratio of the image.
     */
    public function aspect()
    {
    }
    /**
     * Sets the relative alt text of the image.
     *
     * @param string $alt Alt text for the image.
     */
    public function set_alt(string $alt)
    {
    }
    /**
     * Sets the relative alt text of the image.
     *
     * @param string $caption Caption text for the image
     */
    public function set_caption(string $caption)
    {
    }
    /**
     * Inits the object with an absolute path.
     *
     * @internal
     *
     * @param string $file_path An absolute path to a file.
     */
    protected function init_with_file_path($file_path)
    {
    }
    /**
     * Inits the object with a relative path.
     *
     * @internal
     *
     * @param string $relative_path A relative path to a file.
     */
    protected function init_with_relative_path($relative_path)
    {
    }
    /**
     * Inits the object with an URL.
     *
     * @internal
     *
     * @param string $url An URL on the same host.
     */
    protected function init_with_url($url)
    {
    }
    /**
     * Gets the alt text for an image.
     *
     * For better accessibility, you should always add an alt attribute to your images, even if it’s
     * empty.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" alt="{{ image.alt }}" />
     * ```
     * ```html
     * <img
     *     src="https://example.org/wp-content/uploads/2015/08/pic.jpg"
     *     alt="You should always add alt texts to your images for better accessibility"
     * />
     * ```
     *
     * @return string Alt text stored in WordPress.
     */
    public function alt() : ?string
    {
    }
    public function caption() : ?string
    {
    }
}
namespace Timber\Factory;

/**
 * Internal API class for instantiating Comments
 */
class CommentFactory
{
    public function from($params)
    {
    }
    protected function from_id(int $id)
    {
    }
    protected function from_comment_object(object $comment) : \Timber\CoreInterface
    {
    }
    protected function from_wp_comment_query(\WP_Comment_Query $query) : iterable
    {
    }
    protected function get_comment_class(\WP_Comment $comment) : string
    {
    }
    protected function build(\WP_Comment $comment) : \Timber\CoreInterface
    {
    }
    protected function is_numeric_array($arr)
    {
    }
}
/**
 * Internal API class for instantiating Menus
 */
class MenuFactory
{
    /**
     * Tries to get a menu by all means available in an order that matches the most common use
     * cases.
     *
     * Will fall back on the first menu found if no parameters are provided. If no menu is found
     * with the given parameters, it will return null.
     *
     * Note that this method has pitfalls and might not be the most performant way to get a menu.
     *
     *
     * @return Menu|null
     */
    public function from(mixed $params, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a Menu from its location
     *
     * @return Menu|null
     */
    protected function from_nav_menu_terms(array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a Menu from its location
     *
     * @return Menu|null
     */
    public function from_location(string $location, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a Menu by its ID
     *
     * @internal
     */
    public function from_id(int $id, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a Menu by its slug
     *
     * @internal
     */
    public function from_slug(string $slug, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a Menu by its name
     *
     * @internal
     */
    public function from_name(string $name, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a menu from object
     *
     * @internal
     */
    protected function from_object(object $obj, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Get a menu class
     *
     * @internal
     */
    protected function get_menu_class($term, $args) : string
    {
    }
    /**
     * Build menu
     *
     * @param array $args
     * @return CoreInterface
     */
    protected function build(\WP_Term $term, $args) : \Timber\CoreInterface
    {
    }
}
/**
 * Internal API class for instantiating Menus
 */
class MenuItemFactory
{
    /**
     * Create a new MenuItem from a WP_Post or post id
     *
     * @param int|WP_Post $item
     * @return MenuItem|null
     */
    public function from($item, \Timber\Menu $menu) : ?\Timber\MenuItem
    {
    }
    protected function build(\WP_Post $item, \Timber\Menu $menu) : \Timber\CoreInterface
    {
    }
    protected function get_menuitem_class(\WP_Post $item, \Timber\Menu $menu) : string
    {
    }
}
/**
 * Internal API class for instantiating Menus
 */
class PagesMenuFactory
{
    /**
     * Gets a menu with pages from get_pages().
     *
     * @param array $args Optional. Args for get_pages().
     *
     * @return CoreInterface
     */
    public function from_pages(array $args = [])
    {
    }
    /**
     * Gets the pages menu class.
     *
     * @internal
     *
     * @return string
     */
    protected function get_menu_class($args) : string
    {
    }
    /**
     * Build menu
     *
     * @param array $args Optional. Args for get_pages().
     * @return CoreInterface
     */
    protected function build(array $args = []) : \Timber\CoreInterface
    {
    }
}
/**
 * Internal API class for instantiating posts
 */
class PostFactory
{
    public function from($params)
    {
    }
    protected function from_id(int $id) : ?\Timber\Post
    {
    }
    protected function from_post_object(object $obj) : \Timber\CoreInterface
    {
    }
    protected function from_wp_query(\WP_Query $query) : iterable
    {
    }
    protected function get_post_class(\WP_Post $post) : string
    {
    }
    protected function is_image(\WP_Post $post)
    {
    }
    protected function build(\WP_Post $post) : \Timber\CoreInterface
    {
    }
    protected function is_numeric_array($arr)
    {
    }
}
/**
 * Internal API class for instantiating Terms
 */
class TermFactory
{
    public function from($params)
    {
    }
    protected function from_id(int $id) : ?\Timber\Term
    {
    }
    protected function from_wp_term_query(\WP_Term_Query $query)
    {
    }
    protected function from_term_object(object $obj) : \Timber\CoreInterface
    {
    }
    protected function from_taxonomy_names(array $names)
    {
    }
    protected function get_term_class(\WP_Term $term) : string
    {
    }
    protected function build(\WP_Term $term) : \Timber\CoreInterface
    {
    }
    protected function correct_tax_key(array $params)
    {
    }
    protected function correct_taxonomies($tax) : array
    {
    }
    protected function filter_query_params(array $params)
    {
    }
    protected function is_numeric_array($arr)
    {
    }
    protected function is_array_of_strings($arr)
    {
    }
}
/**
 * Class UserFactory
 *
 * Internal class for instantiating User objects/collections. Responsible for applying
 * the `timber/user/class` filter.
 *
 * @internal
 */
class UserFactory
{
    /**
     * Internal method that does the heavy lifting for converting some kind of user
     * object or ID to a Timber\User object.
     *
     * Do not call this directly. Use Timber::get_user() or Timber::get_users() instead.
     *
     * @internal
     * @param mixed $params One of:
     * * a user ID (string or int)
     * * a WP_User_Query object
     * * a WP_User object
     * * a Timber\Core object (presumably a User)
     * * an array of IDs
     * * an associative array (interpreted as arguments for a WP_User_Query)
     * @return User|array|null
     */
    public function from(mixed $params)
    {
    }
    protected function from_id(int $id)
    {
    }
    protected function from_user_object($obj) : \Timber\CoreInterface
    {
    }
    protected function from_wp_user_query(\WP_User_Query $query) : iterable
    {
    }
    protected function build(\WP_User $user) : \Timber\CoreInterface
    {
    }
    protected function is_numeric_array($arr)
    {
    }
}
namespace Timber;

/**
 * Class FunctionWrapper
 *
 * With Timber, we want to prepare all the data before we echo content through a render function.
 * Some functionality in WordPress directly echoes output instead of returning it. This class makes
 * it easier to store the results of an echoing function by using ob_start() and ob_end_clean()
 * behind the scenes.
 */
class FunctionWrapper implements \Stringable
{
    private $_class;
    private $_function;
    public function __toString()
    {
    }
    /**
     *
     *
     * @param callable $function
     * @param array $args
     * @param bool $return_output_buffer
     */
    public function __construct($function, private $args = [], private $return_output_buffer = false)
    {
    }
    /**
     *
     *
     * @return string
     */
    public function call()
    {
    }
    /**
     *
     *
     * @param array   $args
     * @param array   $defaults
     * @return array
     */
    private function _parse_args($args, $defaults)
    {
    }
}
/**
 * Class Helper
 *
 * As the name suggests these are helpers for Timber (and you!) when developing. You can find additional
 * (mainly internally-focused helpers) in Timber\URLHelper.
 * @api
 */
class Helper
{
    /**
     * A utility for a one-stop shop for transients.
     *
     * @api
     * @example
     * ```php
     * $context = Timber::context( [
     *     'favorites' => Timber\Helper::transient( 'user-' . $uid . '-favorites' , function() use ( $uid ) {
     *          // Some expensive query here that’s doing something you want to store to a transient.
     *          return $favorites;
     *     }, 600 ),
     * ] );
     *
     * Timber::render('single.twig', $context);
     * ```
     *
     * @param string      $slug           Unique identifier for transient
     * @param callable     $callback      Callback that generates the data that's to be cached
     * @param integer      $transient_time (optional) Expiration of transients in seconds
     * @param integer     $lock_timeout   (optional) How long (in seconds) to lock the transient to prevent race conditions
     * @param boolean     $force          (optional) Force callback to be executed when transient is locked
     *
     * @return mixed
     */
    public static function transient($slug, $callback, $transient_time = 0, $lock_timeout = 5, $force = false)
    {
    }
    /**
     * Does the dirty work of locking the transient, running the callback and unlocking.
     *
     * @internal
     *
     * @param string      $slug              Unique identifier for transient
     * @param callable    $callback          Callback that generates the data that's to be cached
     * @param integer     $transient_time    Expiration of transients in seconds
     * @param integer     $lock_timeout      How long (in seconds) to lock the transient to prevent race conditions
     * @param boolean     $force             Force callback to be executed when transient is locked
     * @param boolean     $enable_transients Force callback to be executed when transient is locked
     */
    protected static function handle_transient_locking($slug, $callback, $transient_time, $lock_timeout, $force, $enable_transients)
    {
    }
    /**
     * @internal
     * @param string $slug
     * @param integer $lock_timeout
     */
    public static function _lock_transient($slug, $lock_timeout)
    {
    }
    /**
     * @internal
     * @param string $slug
     */
    public static function _unlock_transient($slug)
    {
    }
    /**
     * @internal
     * @param string $slug
     */
    public static function _is_transient_locked($slug)
    {
    }
    /* These are for measuring page render time */
    /**
     * For measuring time, this will start a timer.
     *
     * @api
     * @return float
     */
    public static function start_timer()
    {
    }
    /**
     * For stopping time and getting the data.
     *
     * @api
     * @example
     * ```php
     * $start = Timber\Helper::start_timer();
     * // do some stuff that takes awhile
     * echo Timber\Helper::stop_timer( $start );
     * ```
     *
     * @param int     $start
     * @return string
     */
    public static function stop_timer($start)
    {
    }
    /* Function Utilities
       ======================== */
    /**
     * Calls a function with an output buffer. This is useful if you have a function that outputs
     * text that you want to capture and use within a twig template.
     *
     * @api
     * @example
     * ```php
     * function the_form() {
     *     echo '<form action="form.php"><input type="text" /><input type="submit /></form>';
     * }
     *
     * $context = Timber::context( [
     *     'form' => Timber\Helper::ob_function( 'the_form' ),
     * ] );
     *
     * Timber::render('single-form.twig', $context);
     * ```
     * ```twig
     * <h1>{{ post.title }}</h1>
     * {{ my_form }}
     * ```
     * ```html
     * <h1>Apply to my contest!</h1>
     * <form action="form.php"><input type="text" /><input type="submit /></form>
     * ```
     *
     * @param callable $function
     * @param array    $args
     *
     * @return string
     */
    public static function ob_function($function, $args = [null])
    {
    }
    /**
     * Output a value (string, array, object, etc.) to the error log
     *
     * @api
     * @return void
     */
    public static function error_log(mixed $error)
    {
    }
    /**
     * Trigger a warning.
     *
     * @api
     *
     * @param string $message The warning that you want to output.
     *
     * @return void
     */
    public static function warn($message)
    {
    }
    /**
     * Marks something as being incorrectly called.
     *
     * There is a hook 'doing_it_wrong_run' that will be called that can be used
     * to get the backtrace up to what file and function called the deprecated
     * function.
     *
     * The current behavior is to trigger a user error if `WP_DEBUG` is true.
     *
     * If you want to catch errors like these in tests, then add the @expectedIncorrectUsage tag.
     * E.g.: "@expectedIncorrectUsage Timber::get_posts()".
     *
     * @api
     * @since 2.0.0
     * @since WordPress 3.1.0
     * @see \_doing_it_wrong()
     *
     * @param string $function The function that was called.
     * @param string $message  A message explaining what has been done incorrectly.
     * @param string $version  The version of Timber where the message was added.
     */
    public static function doing_it_wrong($function, $message, $version)
    {
    }
    /**
     * Triggers a deprecation warning.
     *
     * If you want to catch errors like these in tests, then add the @expectedDeprecated tag to the
     * DocBlock. E.g.: "@expectedDeprecated {{ TimberImage() }}".
     *
     * @api
     * @see \_deprecated_function()
     *
     * @param string $function    The name of the deprecated function/method.
     * @param string $replacement The name of the function/method to use instead.
     * @param string $version     The version of Timber when the function was deprecated.
     *
     * @return void
     */
    public static function deprecated($function, $replacement, $version)
    {
    }
    /**
     * @api
     *
     * @param string  $separator
     * @param string  $seplocation
     * @return string
     */
    public static function get_wp_title($separator = ' ', $seplocation = 'left')
    {
    }
    /**
     * Sorts object arrays by properties.
     *
     * @api
     *
     * @param array  $array The array of objects to sort.
     * @param string $prop  The property to sort by.
     *
     * @return void
     */
    public static function osort(&$array, $prop)
    {
    }
    /**
     * @api
     *
     * @param array   $arr
     * @return bool
     */
    public static function is_array_assoc($arr)
    {
    }
    /**
     * @api
     *
     * @param array   $array
     * @return stdClass
     */
    public static function array_to_object($array)
    {
    }
    /**
     * @api
     *
     * @param array   $array
     * @param string  $key
     * @return bool|int
     */
    public static function get_object_index_by_property($array, $key, mixed $value)
    {
    }
    /**
     * @api
     *
     * @param array   $array
     * @param string  $key
     * @return array|null
     * @throws Exception
     */
    public static function get_object_by_property($array, $key, mixed $value)
    {
    }
    /**
     * @api
     *
     * @param array   $array
     * @param int     $len
     * @return array
     */
    public static function array_truncate($array, $len)
    {
    }
    /* Bool Utilities
       ======================== */
    /**
     * @api
     *
     * @return bool
     */
    public static function is_true(mixed $value)
    {
    }
    /**
     * Is the number even? Let's find out.
     *
     * @api
     *
     * @param int $i number to test.
     * @return bool
     */
    public static function iseven($i)
    {
    }
    /**
     * Is the number odd? Let's find out.
     *
     * @api
     *
     * @param int $i number to test.
     * @return bool
     */
    public static function isodd($i)
    {
    }
    /**
     * Plucks the values of a certain key from an array of objects
     *
     * @api
     *
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public static function pluck($array, $key)
    {
    }
    /**
     * Filters a list of objects, based on a set of key => value arguments.
     * Uses WordPress WP_List_Util's filter.
     *
     * @api
     * @since 1.5.3
     * @ticket #1594
     *
     * @param array        $list to filter.
     * @param string|array $args to search for.
     * @param string       $operator to use (AND, NOT, OR).
     * @return array
     */
    public static function wp_list_filter($list, $args, $operator = 'AND')
    {
    }
    /**
     * Converts a WP object (WP_Post, WP_Term) into its
     * equivalent Timber class (Timber\Post, Timber\Term).
     *
     * If no match is found the function will return the initial argument.
     *
     * @api
     * @param mixed $obj WP Object to convert
     * @return mixed Instance of equivalent Timber object, or the argument if no match is found
     */
    public static function convert_wp_object(mixed $obj)
    {
    }
}
/**
 * Class Image
 *
 * The `Timber\Image` class represents WordPress attachments that are images.
 *
 * @api
 * @example
 * ```php
 * $context = Timber::context();
 *
 * // Lets say you have an alternate large 'cover image' for your post
 * // stored in a custom field which returns an image ID.
 * $cover_image_id = $context['post']->cover_image;
 *
 * $context['cover_image'] = Timber::get_post($cover_image_id);
 *
 * Timber::render('single.twig', $context);
 * ```
 *
 * ```twig
 * <article>
 *   <img src="{{cover_image.src}}" class="cover-image" />
 *   <h1 class="headline">{{post.title}}</h1>
 *   <div class="body">
 *     {{post.content}}
 *   </div>
 *
 *  <img
 *    src="{{ get_image(post.custom_field_with_image_id).src }}"
 *    alt="Another way to initialize images as Timber\Image objects, but within Twig" />
 * </article>
 * ```
 *
 * ```html
 * <article>
 *   <img src="https://example.org/wp-content/uploads/2015/06/nevermind.jpg" class="cover-image" />
 *   <h1 class="headline">Now you've done it!</h1>
 *   <div class="body">
 *     Whatever whatever
 *   </div>
 *   <img
 *     src="https://example.org/wp-content/uploads/2015/06/kurt.jpg"
 *     alt="Another way to initialize images as Timber\Image objects, but within Twig" />
 * </article>
 * ```
 */
class Image extends \Timber\Attachment implements \Timber\ImageInterface
{
    /**
     * Representation.
     *
     * @api
     * @var string What does this class represent in WordPress terms?
     */
    public static $representation = 'image';
    /**
     * Image sizes.
     *
     * @api
     * @var array An array of available sizes for the image.
     */
    protected array $sizes;
    /**
     * Image dimensions.
     *
     * @internal
     * @var ImageDimensions stores Image Dimensions in a structured way.
     */
    protected \Timber\ImageDimensions $image_dimensions;
    /**
     * Gets the Image information.
     *
     * @internal
     *
     * @param array $data Data to update.
     * @return array
     */
    protected function get_info(array $data) : array
    {
    }
    /**
     * Processes an image's dimensions.
     * @deprecated 2.0.0, use `{{ image.width }}` or `{{ image.height }}` in Twig
     * @internal
     * @param string $dim
     * @return array|int
     */
    protected function get_dimensions($dim)
    {
    }
    /**
     * @deprecated 2.0.0, use Image::get_dimension_loaded
     * @internal
     * @param string|null $dim
     * @return array|int
     */
    protected function get_dimensions_loaded($dim)
    {
    }
    /**
     * @deprecated 2.0.0, use Image::meta to retrieve specific fields
     * @return array
     */
    protected function get_post_custom($iid)
    {
    }
    /**
     * Gets the source URL for the image.
     *
     * You can use WordPress image sizes (including the ones you registered with your theme or
     * plugin) by passing the name of the size to this function (like `medium` or `large`). If the
     * WordPress size has not been generated, it will return an empty string.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ post.thumbnail.src }}">
     * <img src="{{ post.thumbnail.src('medium') }}">
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" />
     * <img src="https://example.org/wp-content/uploads/2015/08/pic-800-600.jpg">
     * ```
     *
     * @param string $size Optional. The requested image size. This can be a size that was in
     *                     WordPress. Example: `medium` or `large`. Default `full`.
     *
     * @return string The src URL for the image.
     */
    public function src($size = 'full') : string
    {
    }
    /**
     * Get image sizes.
     *
     * @return array
     */
    public function sizes() : array
    {
    }
    /**
     * Gets the width of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" width="{{ image.width }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" width="1600" />
     * ```
     *
     * @return int The width of the image in pixels.
     */
    public function width()
    {
    }
    /**
     * Gets the height of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" height="{{ image.height }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" height="900" />
     * ```
     *
     * @return int The height of the image in pixels.
     */
    public function height()
    {
    }
    /**
     * Gets the aspect ratio of the image.
     *
     * @api
     * @example
     * ```twig
     * {% if post.thumbnail.aspect < 1 %}
     *   {# handle vertical image #}
     *   <img src="{{ post.thumbnail.src|resize(300, 500) }}" alt="A basketball player" />
     * {% else %}
     *   <img src="{{ post.thumbnail.src|resize(500) }}" alt="A sumo wrestler" />
     * {% endif %}
     * ```
     *
     * @return float The aspect ratio of the image.
     */
    public function aspect()
    {
    }
    /**
     * Gets the alt text for an image.
     *
     * For better accessibility, you should always add an alt attribute to your images, even if it’s
     * empty.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" alt="{{ image.alt }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg"
     *     alt="You should always add alt texts to your images for better accessibility" />
     * ```
     *
     * @return string|null Alt text stored in WordPress.
     */
    public function alt() : ?string
    {
    }
    /**
     * Gets dimension for an image.
     * @deprecated 2.0.0, use `{{ image.width }}` or `{{ image.height }}` in Twig
     * @internal
     *
     * @param string $dimension The requested dimension. Either `width` or `height`.
     * @return int|null The requested dimension. Null if image file couldn’t be found.
     */
    protected function get_dimension($dimension)
    {
    }
    /**
     * Gets already loaded dimension values.
     *
     * @internal
     *
     * @param string|null $dim Optional. The requested dimension. Either `width` or `height`.
     * @return int The requested dimension in pixels.
     */
    protected function get_dimension_loaded($dim = null)
    {
    }
    /**
     * Gets the srcset attribute for an image based on a WordPress image size.
     *
     * @api
     * @example
     * ```twig
     * <h1>{{ post.title }}</h1>
     * <img src="{{ post.thumbnail.src }}" srcset="{{ post.thumbnail.srcset }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2018/10/pic.jpg" srcset="https://example.org/wp-content/uploads/2018/10/pic.jpg 1024w, https://example.org/wp-content/uploads/2018/10/pic-600x338.jpg 600w, https://example.org/wp-content/uploads/2018/10/pic-300x169.jpg 300w" />
     * ```
     * @param string $size An image size known to WordPress (like "medium").
     *
     * @return string|null
     */
    public function srcset(string $size = 'full') : ?string
    {
    }
    /**
     * Gets the sizes attribute for an image based on a WordPress image size.
     *
     * @api
     * @example
     * ```twig
     * <h1>{{ post.title }}</h1>
     * <img src="{{ post.thumbnail.src }}" srcset="{{ post.thumbnail.srcset }}" sizes="{{ post.thumbnail.img_sizes }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2018/10/pic.jpg" srcset="https://example.org/wp-content/uploads/2018/10/pic.jpg 1024w, https://example.org/wp-content/uploads/2018/10/pic-600x338.jpg 600w, https://example.org/wp-content/uploads/2018/10/pic-300x169.jpg 300w sizes="(max-width: 1024px) 100vw, 102" />
     * ```
     *	@param string $size An image size known to WordPress (like "medium").
     * @return string|null
     */
    public function img_sizes(string $size = 'full') : ?string
    {
    }
}
namespace Timber\Image;

/**
 * Each image filter is represented by a subclass of this class,m
 * and each filter call is a new instance, with call arguments as properties.
 *
 * Only 3 methods need to be implemented:
 * - constructor, storing all filter arguments
 * - filename
 * - run
 */
abstract class Operation
{
    /**
     *
     * Builds the result filename, based on source filename and extension
     *
     * @param  string $src_filename  source filename (excluding extension and path)
     * @param  string $src_extension source file extension
     * @return string                resulting filename (including extension but excluding path)
     *                               ex: my-awesome-file.jpg
     */
    public abstract function filename($src_filename, $src_extension);
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file
     * @param  string $save_filename filepath (not URL) where result file should be saved
     * @return bool                  true if everything went fine, false otherwise
     */
    public abstract function run($load_filename, $save_filename);
    /**
     * Helper method to convert hex string to rgb array
     *
     * @param  string $hexstr hex color string (like '#FF1455', 'FF1455', '#CCC', 'CCC')
     * @return array          array('red', 'green', 'blue') to int
     *                        ex: array('red' => 255, 'green' => 20, 'blue' => 85);
     */
    public static function hexrgb($hexstr)
    {
    }
    public static function rgbhex($r, $g, $b)
    {
    }
}
namespace Timber\Image\Operation;

/*
 * Changes image to new size, by shrinking/enlarging then padding with colored bands,
 * so that no part of the image is cropped or stretched.
 *
 * Arguments:
 * - width of new image
 * - height of new image
 * - color of padding
 */
class Letterbox extends \Timber\Image\Operation
{
    /**
     * @param int    $w     width of result image
     * @param int    $h     height
     * @param string $color hex string, for color of padding bands
     */
    public function __construct(private $w, private $h, private $color)
    {
    }
    /**
     * @param   string    $src_filename     the basename of the file (ex: my-awesome-pic)
     * @param   string    $src_extension    the extension (ex: .jpg)
     * @return  string    the final filename to be used
     *                    (ex: my-awesome-pic-lbox-300x200-FF3366.jpg)
     */
    public function filename($src_filename, $src_extension)
    {
    }
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file
     *                               (ex: /src/var/www/wp-content/uploads/my-pic.jpg)
     * @param  string $save_filename filepath (not URL) where result file should be saved
     *                               (ex: /src/var/www/wp-content/uploads/my-pic-lbox-300x200-FF3366.jpg)
     * @return bool                  true if everything went fine, false otherwise
     */
    public function run($load_filename, $save_filename)
    {
    }
}
/**
 * Changes image to new size, by shrinking/enlarging
 * then cropping to respect new ratio.
 *
 * Arguments:
 * - width of new image
 * - height of new image
 * - crop method
 */
class Resize extends \Timber\Image\Operation
{
    private $crop;
    /**
     * @param int    $w    width of new image
     * @param int    $h    height of new image
     * @param string $crop cropping method, one of: 'default', 'center', 'top', 'bottom', 'left', 'right', 'top-center', 'bottom-center'.
     */
    public function __construct(private $w, private $h, $crop)
    {
    }
    /**
     * @param   string    $src_filename     the basename of the file (ex: my-awesome-pic)
     * @param   string    $src_extension    the extension (ex: .jpg)
     * @return  string    the final filename to be used (ex: my-awesome-pic-300x200-c-default.jpg)
     */
    public function filename($src_filename, $src_extension)
    {
    }
    /**
     * Run a resize as animated GIF (if the server supports it)
     *
     * @param string           $load_filename the name of the file to resize.
     * @param string           $save_filename the desired name of the file to save.
     * @param WP_Image_Editor $editor the image editor we're using.
     * @return bool
     */
    protected function run_animated_gif($load_filename, $save_filename, \WP_Image_Editor $editor)
    {
    }
    protected function get_target_sizes(\WP_Image_Editor $image)
    {
    }
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file
     *                               (ex: /src/var/www/wp-content/uploads/my-pic.jpg)
     * @param  string $save_filename filepath (not URL) where result file should be saved
     *                               (ex: /src/var/www/wp-content/uploads/my-pic-300x200-c-default.jpg)
     * @return boolean|null                  true if everything went fine, false otherwise
     */
    public function run($load_filename, $save_filename)
    {
    }
}
/**
 * Contains the class for running image retina-izing operations
 */
/**
 * Increases image size by a given factor
 * Arguments:
 * - factor by which to multiply image dimensions
 * @property float $factor the factor (ex: 2, 1.5, 1.75) to multiply dimension by
 */
class Retina extends \Timber\Image\Operation
{
    /**
     * Construct our operation
     * @param float   $factor to multiply original dimensions by
     */
    public function __construct(private $factor)
    {
    }
    /**
     * Generates the final filename based on the source's name and extension
     *
     * @param   string    $src_filename     the basename of the file (ex: my-awesome-pic)
     * @param   string    $src_extension    the extension (ex: .jpg)
     * @return  string    the final filename to be used (ex: my-awesome-pic@2x.jpg)
     */
    public function filename($src_filename, $src_extension)
    {
    }
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file
     *                               (ex: /src/var/www/wp-content/uploads/my-pic.jpg)
     * @param  string $save_filename filepath (not URL) where result file should be saved
     *                               (ex: /src/var/www/wp-content/uploads/my-pic@2x.jpg)
     * @return bool                  true if everything went fine, false otherwise
     */
    public function run($load_filename, $save_filename)
    {
    }
}
/**
 * Implements converting a PNG file to JPG.
 * Argument:
 * - color to fill transparent zones
 */
class ToJpg extends \Timber\Image\Operation
{
    /**
     * @param string $color hex string of color to use for transparent zones
     */
    public function __construct(private $color)
    {
    }
    /**
     * @param   string    $src_filename     the basename of the file (ex: my-awesome-pic)
     * @param   string    $src_extension    ignored
     * @return  string    the final filename to be used (ex: my-awesome-pic.jpg)
     */
    public function filename($src_filename, $src_extension = 'jpg')
    {
    }
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file (ex: /src/var/www/wp-content/uploads/my-pic.jpg)
     * @param  string $save_filename filepath (not URL) where result file should be saved
     *                               (ex: /src/var/www/wp-content/uploads/my-pic.png)
     * @return bool                  true if everything went fine, false otherwise
     */
    public function run($load_filename, $save_filename)
    {
    }
}
/**
 * This class is used to process webp images. Not all server configurations support webp.
 * If webp is not enabled, Timber will generate webp images instead
 * @codeCoverageIgnore
 */
class ToWebp extends \Timber\Image\Operation
{
    /**
     * @param string $quality  ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file)
     */
    public function __construct(private $quality)
    {
    }
    /**
     * @param   string    $src_filename     the basename of the file (ex: my-awesome-pic)
     * @param   string    $src_extension    ignored
     * @return  string    the final filename to be used (ex: my-awesome-pic.webp)
     */
    public function filename($src_filename, $src_extension = 'webp')
    {
    }
    /**
     * Performs the actual image manipulation,
     * including saving the target file.
     *
     * @param  string $load_filename filepath (not URL) to source file (ex: /src/var/www/wp-content/uploads/my-pic.webp)
     * @param  string $save_filename filepath (not URL) where result file should be saved
     *                               (ex: /src/var/www/wp-content/uploads/my-pic.webp)
     * @return bool                  true if everything went fine, false otherwise
     */
    public function run($load_filename, $save_filename)
    {
    }
}
namespace Timber;

/**
 * Class FileSize
 *
 * Helper class to deal with Image Dimensions
 *
 * @api
 * @since 2.0.0
 */
class ImageDimensions
{
    /**
     * Image dimensions.
     *
     * @internal
     * @var array An index array of image dimensions, where the first is the width and the second
     *            item is the height of the image in pixels.
     */
    protected $dimensions;
    /**
     * @param string $file_loc
     */
    public function __construct(
        /**
         * File location.
         *
         * @api
         * @var string The absolute path to the image in the filesystem
         *             (Example: `/var/www/htdocs/wp-content/uploads/2015/08/my-pic.jpg`)
         */
        public $file_loc = ''
    )
    {
    }
    /**
     * Gets the width of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" width="{{ image.width }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" width="1600" />
     * ```
     *
     * @return int|null The width of the image in pixels. Null if the width can’t be read, e.g. because the file doesn’t
     *                  exist.
     */
    public function width() : ?int
    {
    }
    /**
     * Gets the height of the image in pixels.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src }}" height="{{ image.height }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/2015/08/pic.jpg" height="900" />
     * ```
     *
     * @return int|null The height of the image in pixels. Null if the height can’t be read, e.g. because the file
     *                  doesn’t exist.
     */
    public function height() : ?int
    {
    }
    /**
     * Gets the aspect ratio of the image.
     *
     * @api
     * @example
     * ```twig
     * {% if post.thumbnail.aspect < 1 %}
     *   {# handle vertical image #}
     *   <img src="{{ post.thumbnail.src|resize(300, 500) }}" alt="A basketball player" />
     * {% else %}
     *   <img src="{{ post.thumbnail.src|resize(500) }}" alt="A sumo wrestler" />
     * {% endif %}
     * ```
     *
     * @return float|null The aspect ratio of the image. Null if the aspect ratio can’t be calculated.
     */
    public function aspect() : ?float
    {
    }
    /**
     * Gets dimension for an image.
     *
     * @internal
     * @param string $dimension The requested dimension. Either `width` or `height`.
     * @return int|null The requested dimension. Null if image file couldn’t be found.
     */
    public function get_dimension($dimension) : ?int
    {
    }
    /**
     * Gets already loaded dimension values.
     *
     * @internal
     * @param string|null $dim Optional. The requested dimension. Either `width` or `height`.
     * @return int The requested dimension in pixels.
     */
    protected function get_dimension_loaded($dim = null) : int
    {
    }
    /**
     * Retrieve dimensions from SVG file.
     *
     * @internal
     * @param string $svg SVG Path
     * @return object
     */
    protected function get_dimensions_svg($svg)
    {
    }
}
/**
 * Class ImageHelper
 *
 * Implements the Twig image filters:
 * https://timber.github.io/docs/v2/guides/cookbook-images/#arbitrary-resizing-of-images
 * - resize
 * - retina
 * - letterbox
 * - tojpg
 *
 * Implementation:
 * - public static functions provide the methods that are called by the filter
 * - most of the work is common to all filters (URL analysis, directory gymnastics, file caching, error management) and done by private static functions
 * - the specific part (actual image processing) is delegated to dedicated subclasses of TimberImageOperation
 *
 * @api
 */
class ImageHelper
{
    public const BASE_UPLOADS = 1;
    public const BASE_CONTENT = 2;
    public static $home_url;
    /**
     * Inits the object.
     */
    public static function init()
    {
    }
    /**
     * Generates a new image with the specified dimensions.
     *
     * New dimensions are achieved by cropping to maintain ratio.
     *
     * @api
     * @example
     * ```twig
     * <img src="{{ image.src | resize(300, 200, 'top') }}" />
     * ```
     * ```html
     * <img src="https://example.org/wp-content/uploads/pic-300x200-c-top.jpg" />
     * ```
     *
     * @param string     $src   A URL (absolute or relative) to the original image.
     * @param int|string $w     Target width (int) or WordPress image size (WP-set or
     *                          user-defined).
     * @param int        $h     Optional. Target height (ignored if `$w` is WP image size). If not
     *                          set, will ignore and resize based on `$w` only. Default `0`.
     * @param string     $crop  Optional. Your choices are `default`, `center`, `top`, `bottom`,
     *                          `left`, `right`. Default `default`.
     * @param bool       $force Optional. Whether to remove any already existing result file and
     *                          force file generation. Default `false`.
     * @return string The URL of the resized image.
     */
    public static function resize($src, $w, $h = 0, $crop = 'default', $force = false)
    {
    }
    /**
     * Finds the sizes of an image based on a defined image size.
     *
     * @internal
     * @param  string $size The image size to search for can be WordPress-defined ('medium') or
     *                      user-defined ('my-awesome-size').
     * @return false|array An array with `w` and `h` height key, corresponding to the width and the
     *                     height of the image.
     */
    private static function find_wp_dimensions($size)
    {
    }
    /**
     * Generates a new image with increased size, for display on Retina screens.
     *
     * @api
     *
     * @param string  $src        URL of the file to read from.
     * @param float   $multiplier Optional. Factor the original dimensions should be multiplied
     *                            with. Default `2`.
     * @param boolean $force      Optional. Whether to remove any already existing result file and
     *                            force file generation. Default `false`.
     * @return string URL to the new image.
     */
    public static function retina_resize($src, $multiplier = 2, $force = false)
    {
    }
    /**
     * Checks to see if the given file is an animated GIF.
     *
     * @api
     *
     * @param string $file Local filepath to a file, not a URL.
     * @return boolean True if it’s an animated GIF, false if not.
     */
    public static function is_animated_gif($file)
    {
    }
    /**
     * Checks if file is an SVG.
     *
     * @param string $file_path File path to check.
     * @return bool True if SVG, false if not SVG or file doesn't exist.
     */
    public static function is_svg($file_path)
    {
    }
    /**
     * Generate a new image with the specified dimensions.
     *
     * New dimensions are achieved by adding colored bands to maintain ratio.
     *
     * @api
     *
     * @param string      $src
     * @param int         $w
     * @param int         $h
     * @param string|bool $color
     * @param bool        $force
     * @return string
     */
    public static function letterbox($src, $w, $h, $color = false, $force = false)
    {
    }
    /**
     * Generates a new image by converting the source GIF or PNG into JPG.
     *
     * @api
     *
     * @param string $src   A URL or path to the image
     *                      (https://example.org/wp-content/uploads/2014/image.jpg) or
     *                      (/wp-content/uploads/2014/image.jpg).
     * @param string $bghex The hex color to use for transparent zones.
     * @return string The URL of the processed image.
     */
    public static function img_to_jpg($src, $bghex = '#FFFFFF', $force = false)
    {
    }
    /**
     * Generates a new image by converting the source into WEBP if supported by the server.
     *
     * @param string $src     A URL or path to the image
     *                        (https://example.org/wp-content/uploads/2014/image.webp) or
     *                        (/wp-content/uploads/2014/image.webp).
     * @param int    $quality Range from `0` (worst quality, smaller file) to `100` (best quality,
     *                        biggest file).
     * @param bool   $force   Optional. Whether to remove any already existing result file and
     *                        force file generation. Default `false`.
     * @return string The URL of the processed image. If webp is not supported, a jpeg image will be
     *                        generated.
     */
    public static function img_to_webp($src, $quality = 80, $force = false)
    {
    }
    //-- end of public methods --//
    /**
     * Deletes all resized versions of an image when the source is deleted.
     *
     * @since 1.5.0
     * @param int   $post_id An attachment ID.
     */
    public static function delete_attachment($post_id)
    {
    }
    /**
     * Delete all resized version of an image when its meta data is regenerated.
     *
     * @since 1.5.0
     * @param array $metadata Existing metadata.
     * @param int   $post_id  An attachment ID.
     * @return array
     */
    public static function generate_attachment_metadata($metadata, $post_id)
    {
    }
    /**
     * Adds a 'relative' key to wp_upload_dir() result.
     *
     * It will contain the relative url to upload dir.
     *
     * @since 1.5.0
     * @param array $arr
     * @return array
     */
    public static function add_relative_upload_dir_key($arr)
    {
    }
    /**
     * Checks if attachment is an image before deleting generated files.
     *
     * @param int $post_id An attachment ID.
     */
    public static function _delete_generated_if_image($post_id)
    {
    }
    /**
     * Deletes the auto-generated files for resize and letterboxing created by Timber.
     *
     * @param string $local_file ex: /var/www/wp-content/uploads/2015/my-pic.jpg
     *                           or: https://example.org/wp-content/uploads/2015/my-pic.jpg
     */
    public static function delete_generated_files($local_file)
    {
    }
    /**
     * Deletes resized versions of the supplied file name.
     *
     * If passed a value like my-pic.jpg, this function will delete my-pic-500x200-c-left.jpg, my-pic-400x400-c-default.jpg, etc.
     *
     * Keeping these here so I know what the hell we’re matching
     * $match = preg_match("/\/srv\/www\/wordpress-develop\/src\/wp-content\/uploads\/2014\/05\/$filename-[0-9]*x[0-9]*-c-[a-z]*.jpg/", $found_file);
     * $match = preg_match("/\/srv\/www\/wordpress-develop\/src\/wp-content\/uploads\/2014\/05\/arch-[0-9]*x[0-9]*-c-[a-z]*.jpg/", $filename);
     *
     * @param string  $filename       ex: my-pic.
     * @param string  $ext            ex: jpg.
     * @param string  $dir            var/www/wp-content/uploads/2015/.
     * @param string  $search_pattern Pattern of files to pluck from.
     * @param string  $match_pattern  Pattern of files to go forth and delete.
     */
    protected static function process_delete_generated_files($filename, $ext, $dir, $search_pattern, $match_pattern = null)
    {
    }
    /**
     * Determines the filepath corresponding to a given URL.
     *
     * @param string $url
     * @return string
     */
    public static function get_server_location($url)
    {
    }
    /**
     * Determines the filepath where a given external file will be stored.
     *
     * @param string  $file
     * @return string
     */
    public static function get_sideloaded_file_loc($file)
    {
    }
    /**
     * Downloads an external image to the server and stores it on the server.
     *
     * External/sideloaded images are saved in a folder named **external** in the uploads folder. If you want to change
     * the folder that is used for your sideloaded images, you can use the
     * [`timber/sideload_image/subdir`](https://timber.github.io/docs/v2/hooks/filters/#timber/sideload_image/subdir)
     * filter. You can disable this behavior using the same filter.
     *
     * @param string $file The URL to the original file.
     *
     * @return string The URL to the downloaded file.
     */
    public static function sideload_image($file)
    {
    }
    /**
     * Gets upload folder definition for sideloaded images.
     *
     * Used by ImageHelper::sideload_image().
     *
     * @internal
     * @since 2.0.0
     * @see   \Timber\ImageHelper::sideload_image()
     *
     * @param array $upload Array of information about the upload directory.
     *
     * @return array         Array of information about the upload directory, modified by this
     *                        function.
     */
    public static function set_sideload_image_upload_dir(array $upload)
    {
    }
    /**
     * Takes a URL and breaks it into components.
     *
     * The components can then be used in the different steps of image processing.
     * The image is expected to be either part of a theme, plugin, or an upload.
     *
     * @param  string $url A URL (absolute or relative) pointing to an image.
     * @return array<string, mixed> An array (see keys in code below).
     */
    public static function analyze_url(string $url) : array
    {
    }
    /**
     * Returns information about a URL.
     *
     * @param  string $url A URL (absolute or relative) pointing to an image.
     * @return array<string, mixed> An array (see keys in code below).
     */
    private static function get_url_components(string $url) : array
    {
    }
    /**
     * Converts a URL located in a theme directory into the raw file path.
     *
     * @param string  $src A URL (https://example.org/wp-content/themes/twentysixteen/images/home.jpg).
     * @return string Full path to the file in question.
     */
    public static function theme_url_to_dir(string $src) : string
    {
    }
    /**
     * Converts a URL located in a theme directory into the raw file path.
     *
     * @param string  $src A URL (https://example.org/wp-content/themes/twentysixteen/images/home.jpg).
     * @return string Full path to the file in question.
     */
    private static function get_dir_from_theme_url(string $src) : string
    {
    }
    /**
     * Checks if uploaded image is located in theme.
     *
     * @param string $path image path.
     * @return bool     If the image is located in the theme directory it returns true.
     *                  If not or $path doesn't exits it returns false.
     */
    protected static function is_in_theme_dir($path)
    {
    }
    /**
     * Builds the public URL of a file based on its different components.
     *
     * @param  int    $base     One of `self::BASE_UPLOADS`, `self::BASE_CONTENT` to indicate if
     *                          file is an upload or a content (theme or plugin).
     * @param  string $subdir   Subdirectory in which file is stored, relative to $base root
     *                          folder.
     * @param  string $filename File name, including extension (but no path).
     * @param  bool   $absolute Should the returned URL be absolute (include protocol+host), or
     *                          relative.
     * @return string           The URL.
     */
    private static function _get_file_url($base, $subdir, $filename, $absolute)
    {
    }
    /**
     * Runs realpath to resolve symbolic links (../, etc). But only if it’s a path and not a URL.
     *
     * @param  string $path
     * @return string The resolved path.
     */
    protected static function maybe_realpath($path)
    {
    }
    /**
     * Builds the absolute file system location of a file based on its different components.
     *
     * @param  int    $base     One of `self::BASE_UPLOADS`, `self::BASE_CONTENT` to indicate if
     *                          file is an upload or a content (theme or plugin).
     * @param  string $subdir   Subdirectory in which file is stored, relative to $base root
     *                          folder.
     * @param  string $filename File name, including extension (but no path).
     * @return string           The file location.
     */
    private static function _get_file_path($base, $subdir, $filename)
    {
    }
    /**
     * Main method that applies operation to src image:
     * 1. break down supplied URL into components
     * 2. use components to determine result file and URL
     * 3. check if a result file already exists
     * 4. otherwise, delegate to supplied TimberImageOperation
     *
     * @param  string  $src   A URL (absolute or relative) to an image.
     * @param  object  $op    Object of class TimberImageOperation.
     * @param  boolean $force Optional. Whether to remove any already existing result file and
     *                        force file generation. Default `false`.
     * @return string URL to the new image - or the source one if error.
     */
    private static function _operate($src, $op, $force = false)
    {
    }
    //-- the below methods are just used for
    // unit testing the URL generation code --//
    /**
     * @internal
     */
    public static function get_letterbox_file_url($url, $w, $h, $color)
    {
    }
    /**
     * @internal
     */
    public static function get_letterbox_file_path($url, $w, $h, $color)
    {
    }
    /**
     * @internal
     */
    public static function get_resize_file_url($url, $w, $h, $crop)
    {
    }
    /**
     * @internal
     */
    public static function get_resize_file_path($url, $w, $h, $crop)
    {
    }
}
namespace Timber\Integration;

/**
 * Timber\Integration\IntegrationInterface
 *
 * This is for integrating external plugins into Timber
 */
interface IntegrationInterface
{
    public function should_init() : bool;
    public function init() : void;
}
/**
 * Class used to handle integration with Advanced Custom Fields
 */
class AcfIntegration implements \Timber\Integration\IntegrationInterface
{
    public function should_init() : bool
    {
    }
    public function init() : void
    {
    }
    /**
     * Gets meta value for a post through ACF’s API.
     *
     * @param string       $value      The field value. Default null.
     * @param int          $post_id    The post ID.
     * @param string       $field_name The name of the meta field to get the value for.
     * @param \Timber\Post $post       The post object.
     * @param array        $args       An array of arguments.
     * @return mixed|false
     */
    public static function post_get_meta_field($value, $post_id, $field_name, $post, $args)
    {
    }
    public static function post_meta_object($value, $post_id, $field_name)
    {
    }
    /**
     * Gets meta value for a term through ACF’s API.
     *
     * @param string       $value      The field value. Default null.
     * @param int          $term_id    The term ID.
     * @param string       $field_name The name of the meta field to get the value for.
     * @param \Timber\Term $term       The term object.
     * @param array        $args       An array of arguments.
     * @return mixed|false
     */
    public static function term_get_meta_field($value, $term_id, $field_name, $term, $args)
    {
    }
    /**
     * @deprecated 2.0.0, with no replacement
     *
     * @return mixed
     */
    public static function term_set_meta($value, $field, $term_id, $term)
    {
    }
    /**
     * Gets meta value for a user through ACF’s API.
     *
     * @param string       $value      The field value. Default null.
     * @param int          $user_id    The user ID.
     * @param string       $field_name The name of the meta field to get the value for.
     * @param \Timber\User $user       The user object.
     * @param array        $args       An array of arguments.
     * @return mixed|false
     */
    public static function user_get_meta_field($value, $user_id, $field_name, $user, $args)
    {
    }
    /**
     * Transform ACF file field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_file($value, $id, $field)
    {
    }
    /**
     * Transform ACF image field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_image($value, $id, $field)
    {
    }
    /**
     * Transform ACF gallery field
     *
     * @param array $value
     * @param int   $id
     * @param array $field
     */
    public static function transform_gallery($value, $id, $field)
    {
    }
    /**
     * Transform ACF date picker field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_date_picker($value, $id, $field)
    {
    }
    /**
     * Transform ACF post object field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_post_object($value, $id, $field)
    {
    }
    /**
     * Transform ACF relationship field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_relationship($value, $id, $field)
    {
    }
    /**
     * Transform ACF taxonomy field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_taxonomy($value, $id, $field)
    {
    }
    /**
     * Transform ACF user field
     *
     * @param string $value
     * @param int    $id
     * @param array  $field
     */
    public static function transform_user($value, $id, $field)
    {
    }
    /**
     * Gets meta value through ACF’s API.
     *
     * @param string     $value
     * @param int|string $id
     * @param string     $field_name
     * @param array      $args
     * @return mixed|false
     */
    private static function get_meta($value, $id, $field_name, $args)
    {
    }
}
namespace Timber\Integration\CLI;

/**
 * Class TimberCommand
 *
 * Handles WP-CLI commands.
 */
class TimberCommand extends \WP_CLI_Command
{
    /**
     * Clears caches in Timber.
     *
     * ## OPTIONS
     *
     * [<mode>]
     * : Optional. The type of cache to clear. Accepts 'timber' or 'twig'. If not provided, the command will clear all caches.
     *
     * ## EXAMPLES
     *
     *    # Clear all caches.
     *    wp timber clear-cache
     *
     *    # Clear Timber caches.
     *    wp timber clear-cache timber
     *
     *    # Clear Twig caches.
     *    wp timber clear-cache twig
     *
     * @subcommand clear-cache
     * @alias clear_cache
     */
    public function clear_cache($args = []) : void
    {
    }
}
namespace Timber;

/**
 * Class User
 *
 * A user object represents a WordPress user.
 *
 * The currently logged-in user will be available as `{{ user }}` in your Twig files through the
 * global context. If a user is not logged in, it will be `false`. This will make it possible for
 * you to check if a user is logged by checking for `user` instead of calling `is_user_logged_in()`
 * in your Twig templates.
 *
 * @api
 * @example
 * ```twig
 * {% if user %}
 *     Hello {{ user.name }}
 * {% endif %}
 * ```
 *
 * The difference between a logged-in user and a post author:
 *
 * ```php
 * $context = Timber::context();
 *
 * Timber::render( 'single.twig', $context );
 * ```
 * ```twig
 * <p class="current-user-info">Your name is {{ user.name }}</p>
 * <p class="article-info">This article is called "{{ post.title }}"
 *     and it’s by {{ post.author.name }}</p>
 * ```
 * ```html
 * <p class="current-user-info">Your name is Jesse Eisenberg</p>
 * <p class="article-info">This article is called "Consider the Lobster"
 *     and it’s by David Foster Wallace</p>
 * ```
 */
class User extends \Timber\CoreEntity implements \Stringable
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_User|null
     */
    protected ?\WP_User $wp_object = null;
    public $object_type = 'user';
    public static $representation = 'user';
    public $_link;
    /**
     * @api
     * @var string A URL to an avatar that overrides anything from Gravatar, etc.
     */
    public $avatar_override;
    /**
     * @api
     * @var int The ID from WordPress
     */
    public $id;
    /**
     * @api
     * @var string
     */
    public $user_nicename;
    /**
     * User email address.
     *
     * @api
     * @var string
     */
    public $user_email;
    /**
     * The roles the user is part of.
     *
     * @api
     * @since 1.8.5
     *
     * @var array
     */
    protected $roles;
    /**
     * Construct a User object. For internal use only: Do not call directly.
     * Call `Timber::get_user()` instead.
     *
     * @internal
     */
    protected function __construct()
    {
    }
    /**
     * Build a new User object.
     */
    public static function build(\WP_User $wp_user) : static
    {
    }
    /**
     * @api
     * @example
     * ```twig
     * This post is by {{ post.author }}
     * ```
     * ```html
     * This post is by Jared Novack
     * ```
     *
     * @return string a fallback for Timber\User::name()
     */
    public function __toString()
    {
    }
    /**
     * @internal
     */
    protected function init($wp_user)
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_User|null
     */
    public function wp_object() : ?\WP_User
    {
    }
    /**
     * Get the URL of the user's profile
     *
     * @api
     * @return string https://example.org/author/lincoln
     */
    public function link()
    {
    }
    /**
     * Gets a user meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ user.meta('field_name') }}` instead.
     * @see \Timber\User::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Check if the user object is the current user
     *
     * @api
     *
     * @return bool true if the user is the current user
     */
    public function is_current() : bool
    {
    }
    /**
     * Get the name of the User
     *
     * @api
     * @return string the human-friendly name of the user (ex: "Buster Bluth")
     */
    public function name()
    {
    }
    /**
     * Get the relative path to the user's profile
     *
     * @api
     * @return string ex: /author/lincoln
     */
    public function path()
    {
    }
    /**
     * @api
     * @return string ex baberaham-lincoln
     */
    public function slug()
    {
    }
    /**
     * Gets a user meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ user.meta('field_name') }}` instead.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_meta_field($field_name)
    {
    }
    /**
     * Gets a user meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ user.meta('field_name') }}` instead.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_meta($field_name)
    {
    }
    /**
     * Creates an associative array with user role slugs and their translated names.
     *
     * @internal
     * @since 1.8.5
     * @param array $roles user roles.
     * @return array|null
     */
    protected function get_roles($roles)
    {
    }
    /**
     * Gets the user roles.
     * Roles shouldn’t be used to check whether a user has a capability. Use roles only for
     * displaying purposes. For example, if you want to display the name of the subscription a user
     * has on the site behind a paywall.
     *
     * If you want to check for capabilities, use `{{ user.can('capability') }}`. If you only want
     * to check whether a user is logged in, you can use `{% if user %}`.
     *
     * @api
     * @since 1.8.5
     * @example
     * ```twig
     * <h2>Role name</h2>
     * {% for role in post.author.roles %}
     *     {{ role }}
     * {% endfor %}
     * ```
     * ```twig
     * <h2>Role name</h2>
     * {{ post.author.roles|join(', ') }}
     * ```
     * ```twig
     * {% for slug, name in post.author.roles %}
     *     {{ slug }}
     * {% endfor %}
     * ```
     *
     * @return array|null
     */
    public function roles()
    {
    }
    /**
     * Gets the profile link to the user’s profile in the WordPress admin if the ID in the user object
     * is the same as the current user’s ID.
     *
     * @api
     * @since 2.1.0
     * @example
     *
     * Get the profile URL for the current user:
     *
     * ```twig
     * {% if user.profile_link %}
     *     <a href="{{ user.profile_link }}">My profile</a>
     * {% endif %}
     * ```
     * @return string|null The profile link for the current user.
     */
    public function profile_link() : ?string
    {
    }
    /**
     * Checks whether a user has a capability.
     *
     * Don’t use role slugs for capability checks. While checking against a role in place of a
     * capability is supported in part, this practice is discouraged as it may produce unreliable
     * results. This includes cases where you want to check whether a user is registered. If you
     * want to check whether a user is a Subscriber, use `{{ user.can('read') }}`. If you only want
     * to check whether a user is logged in, you can use `{% if user %}`.
     *
     * @api
     * @since 1.8.5
     *
     * @param string $capability The capability to check.
     * @param mixed ...$args Additional arguments to pass to the user_can function
     *
     * @example
     * Give moderation users another CSS class to style them differently.
     *
     * ```twig
     * <span class="comment-author {{ comment.author.can('moderate_comments') ? 'comment-author--is-moderator }}">
     *     {{ comment.author.name }}
     * </span>
     * ```
     *
     * @example
     * ```twig
     * {# Show edit link for posts that a user can edit. #}
     * {% if user.can('edit_post', post.id) %}
     *     <a href="{{post.edit_link}}">Edit Post</a>
     * {% endif %}
     *
     * {% if user.can('edit_term', term.id) %}
     *     {# do something with privileges #}
     * {% endif %}
     *
     * {% if user.can('edit_user', user.id) %}
     *     {# do something with privileges #}
     * {% endif %}
     *
     * {% if user.can('edit_comment', comment.id) %}
     *     {# do something with privileges #}
     * {% endif %}
     * ```
     *
     * @return bool Whether the user has the capability.
     */
    public function can($capability, mixed ...$args)
    {
    }
    /**
     * Checks whether the current user can edit the post.
     *
     * @api
     * @example
     * ```twig
     * {% if user.can_edit %}
     *     <a href="{{ user.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return bool
     */
    public function can_edit() : bool
    {
    }
    /**
     * Gets the edit link for a user if the current user has the correct rights or the profile link for the current
     * user.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```twig
     * {% if user.can_edit %}
     *     <a href="{{ user.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     *
     * Get the profile URL for the current user:
     *
     * ```twig
     * {# Assuming user is the current user. #}
     * {% if user %}
     *     <a href="{{ user.edit_link }}">My profile</a>
     * {% endif %}
     * ```
     * @return string|null The edit URL of a user in the WordPress admin or the profile link if the user object is for
     *                     the current user. Null if the current user can’t edit the user.
     */
    public function edit_link() : ?string
    {
    }
    /**
     * Gets a user’s avatar URL.
     *
     * @api
     * @since 1.9.1
     * @example
     * Get a user avatar with a width and height of 150px:
     *
     * ```twig
     * <img src="{{ post.author.avatar({ size: 150 }) }}">
     * ```
     *
     * @param null|array $args Parameters for
     *                         [`get_avatar_url()`](https://developer.wordpress.org/reference/functions/get_avatar_url/).
     * @return string The avatar URL.
     */
    public function avatar($args = null)
    {
    }
}
namespace Timber\Integration\CoAuthorsPlus;

class CoAuthorsPlusUser extends \Timber\User
{
    /**
     * This user's avatar thumbnail
     *
     * @var string
     */
    protected $thumbnail;
    public static function from_guest_author(\stdclass $coauthor)
    {
    }
    /**
     * @internal
     * @param false|object $coauthor co-author object
     */
    protected function init($coauthor = false)
    {
    }
    /**
     * Get the user's avatar or Gravatar URL.
     *
     * @param array $args optional array arg to `get_avatar_url()`
     * @return string
     */
    public function avatar($args = null)
    {
    }
}
namespace Timber\Integration;

class CoAuthorsPlusIntegration implements \Timber\Integration\IntegrationInterface
{
    public function should_init() : bool
    {
    }
    /**
     * @codeCoverageIgnore
     */
    public function init() : void
    {
    }
    /**
     * Filters {{ post.authors }} to return authors stored from Co-Authors Plus
     * @since 1.1.4
     * @param array $author
     * @param \Timber\Post $post
     * @return array of User objects
     */
    public function authors($author, $post)
    {
    }
    /**
     * return the user id for normal authors
     * the user login for guest authors if it exists and self::prefer_users == true
     * or null
     * @internal
     * @param object $cauthor
     * @return int|null
     */
    protected function get_user_uid($cauthor)
    {
    }
}
/**
 * Class WpCliIntegration
 *
 * Adds a "timber" command to WP CLI.
 */
class WpCliIntegration implements \Timber\Integration\IntegrationInterface
{
    public function should_init() : bool
    {
    }
    public function init() : void
    {
    }
}
class WpmlIntegration implements \Timber\Integration\IntegrationInterface
{
    public function should_init() : bool
    {
    }
    public function init() : void
    {
    }
    public function file_system_to_url($url)
    {
    }
    public function menu_item_objects_filter(array $items)
    {
    }
    public function theme_mod_nav_menu_locations($locations)
    {
    }
}
namespace Timber;

class Loader
{
    public const CACHEGROUP = 'timberloader';
    public const TRANS_KEY_LEN = 50;
    public const CACHE_NONE = 'none';
    public const CACHE_OBJECT = 'cache';
    public const CACHE_TRANSIENT = 'transient';
    public const CACHE_SITE_TRANSIENT = 'site-transient';
    public const CACHE_USE_DEFAULT = 'default';
    /** Identifier of the main namespace. Will likely mirror Twig\Loader\FilesystemLoader::MAIN_NAMESPACE */
    public const MAIN_NAMESPACE = '__main__';
    public static $cache_modes = [self::CACHE_NONE, self::CACHE_OBJECT, self::CACHE_TRANSIENT, self::CACHE_SITE_TRANSIENT];
    protected $cache_mode = self::CACHE_TRANSIENT;
    protected $locations;
    /**
     * @param bool|string   $caller the calling directory or false
     */
    public function __construct($caller = false)
    {
    }
    /**
     * @param string            $file
     * @param array             $data
     * @param array|boolean        $expires (array for options, false for none, integer for # of seconds)
     * @param string            $cache_mode
     * @return bool|string
     */
    public function render($file, $data = null, $expires = false, $cache_mode = self::CACHE_USE_DEFAULT)
    {
    }
    protected function delete_cache()
    {
    }
    /**
     * Get first existing template.
     *
     * @param array|string $templates  Name(s) of the Twig template(s) to choose from.
     * @return string|bool             Name of chosen template, otherwise false.
     */
    public function choose_template($templates)
    {
    }
    /**
     * @return FilesystemLoader
     */
    public function get_loader()
    {
    }
    /**
     * @return Environment
     */
    public function get_twig()
    {
    }
    /**
     * Clears Timber’s cache.
     *
     * @param string $cache_mode
     * @return bool Whether Timber’s cache was cleared
     */
    public function clear_cache_timber($cache_mode = self::CACHE_USE_DEFAULT)
    {
    }
    /**
     * Clears Timber cache in database.
     *
     * @return bool|int Number of deleted rows or false on error.
     */
    protected static function clear_cache_timber_database()
    {
    }
    /**
     * @return bool True when no cache was found or all cache was deleted, false when there was an
     *              error deleting the cache.
     */
    protected static function clear_cache_timber_object()
    {
    }
    public function clear_cache_twig()
    {
    }
    /**
     * Remove a directory and everything inside
     *
     * @param string|false $dirPath
     */
    public static function rrmdir($dirPath)
    {
    }
    /**
     * @return CacheExtension\Extension
     */
    private function _get_cache_extension()
    {
    }
    /**
     * @param string $key
     * @param string $group
     * @param string $cache_mode
     * @return bool
     */
    public function get_cache($key, $group = self::CACHEGROUP, $cache_mode = self::CACHE_USE_DEFAULT)
    {
    }
    /**
     * @param string $key
     * @param string|boolean $value
     * @param string $group
     * @param integer $expires
     * @param string $cache_mode
     * @return string|boolean
     */
    public function set_cache($key, $value, $group = self::CACHEGROUP, $expires = 0, $cache_mode = self::CACHE_USE_DEFAULT)
    {
    }
    /**
     * @param string $cache_mode
     * @return string
     */
    private function _get_cache_mode($cache_mode)
    {
    }
    /**
     * Checks whether WordPress object cache is activated.
     *
     * @since 2.0.0
     * @return bool
     */
    protected function is_object_cache()
    {
    }
}
class LocationManager
{
    /**
     * @param bool|string   $caller the calling directory (or false)
     * @return array
     */
    public static function get_locations($caller = false)
    {
    }
    /**
     * @return array
     */
    protected static function get_locations_theme()
    {
    }
    /**
     * Get calling script file.
     * @api
     * @param int     $offset
     * @return string|null
     */
    public static function get_calling_script_file($offset = 0)
    {
    }
    /**
     * Get calling script dir.
     * @api
     * @return string|null
     */
    public static function get_calling_script_dir($offset = 0)
    {
    }
    /**
     * returns an array of the directory inside themes that holds twig files
     * @return array the names of directories, ie: array('__MAIN__' => ['templates', 'views']);
     */
    public static function get_locations_theme_dir()
    {
    }
    /**
     * @deprecated since 2.0.0 Use `add_filter('timber/locations', $locations)` instead.
     * @return array
     */
    protected static function get_locations_user()
    {
    }
    /**
     *
     * Converts the variable to an array with the var as the sole element. Ignores if it's already an array
     *
     * @param mixed $var the variable to test and maybe convert
     * @return array
     */
    protected static function convert_to_array(mixed $var)
    {
    }
    /**
     * @param bool|string   $caller the calling directory
     * @param bool          $skip_parent whether to skip the parent theme
     * @return array
     */
    protected static function get_locations_caller($caller = false, bool $skip_parent = false)
    {
    }
    /**
     * returns an array of the directory set with "open_basedir"
     * see : https://www.php.net/manual/en/ini.core.php#ini.open-basedir
     * @return array
     */
    protected static function get_locations_open_basedir()
    {
    }
}
/**
 * Class Menu
 *
 * @api
 */
class Menu extends \Timber\CoreEntity implements \Stringable
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_Term|null
     */
    protected ?\WP_Term $wp_object;
    public $object_type = 'term';
    /**
     * @api
     * @var integer The depth of the menu we are rendering
     */
    public $depth;
    /**
     * @api
     * @var array|null Array of `Timber\Menu` objects you can to iterate through.
     */
    public $items = null;
    /**
     * @api
     * @var int The ID of the menu, corresponding to the wp_terms table.
     */
    public $id;
    /**
     * @api
     * @var int The ID of the menu, corresponding to the wp_terms table.
     */
    public $ID;
    /**
     * @api
     * @var int The ID of the menu, corresponding to the wp_terms table.
     */
    public $term_id;
    /**
     * @api
     * @var string The name of the menu (ex: `Main Navigation`).
     */
    public $name;
    /**
     * Menu slug.
     *
     * @api
     * @var string The menu slug.
     */
    public $slug;
    /**
     * @api
     * @var string The name of the menu (ex: `Main Navigation`).
     */
    public $title;
    /**
     * Menu args.
     *
     * @api
     * @since 1.9.6
     * @var object An object of menu args.
     */
    public $args;
    /**
     * @var MenuItem the current menu item
     */
    private $_current_item;
    /**
     * @api
     * @var array The unfiltered args sent forward via the user in the __construct
     */
    public $raw_args;
    /**
     * Theme Location.
     *
     * @api
     * @since 1.9.6
     * @var string The theme location of the menu, if available.
     */
    public $theme_location = null;
    /**
     * Sorted menu items.
     *
     * @var array
     */
    protected $sorted_menu_items = [];
    /**
     * @internal
     * @param WP_Term   $menu The vanilla WordPress term object to build from.
     * @param array      $args Optional. Right now, only the `depth` is
     *                            supported which says how many levels of hierarchy should be
     *                            included in the menu. Default `0`, which is all levels.
     * @return Menu
     */
    public static function build(?\WP_Term $menu, $args = []) : ?self
    {
    }
    /**
     * Initialize a menu.
     *
     * @api
     *
     * @param WP_Term|null $term A menu slug, the term ID of the menu, the full name from the admin
     *                            menu, the slug of the registered location or nothing. Passing
     *                            nothing is good if you only have one menu. Timber will grab what
     *                            it finds.
     * @param array $args         Optional. Right now, only the `depth` is supported which says how
     *                            many levels of hierarchy should be included in the menu. Default
     *                            `0`, which is all levels.
     */
    protected function __construct(?\WP_Term $term, array $args = [])
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Term|null
     */
    public function wp_object() : ?\WP_Term
    {
    }
    /**
     * Convert menu items into MenuItem objects
     *
     * @return MenuItem[]
     */
    protected function convert_menu_items(array $menu_items) : array
    {
    }
    /**
     * Find a parent menu item in a set of menu items.
     *
     * @api
     * @param array $menu_items An array of menu items.
     * @param int   $parent_id  The parent ID to look for.
     * @return MenuItem|null A menu item. False if no parent was found.
     */
    public function find_parent_item_in_menu(array $menu_items, int $parent_id) : ?\Timber\MenuItem
    {
    }
    /**
     * @internal
     * @return MenuItem[]
     */
    protected function order_children(array $items) : array
    {
    }
    /**
     * @internal
     */
    protected function strip_to_depth_limit(array $menu_items, int $current = 1) : array
    {
    }
    /**
     * Gets a menu meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ menu.meta('field_name') }}` instead.
     * @see \Timber\Menu::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Get menu items.
     *
     * Instead of using this function, you can use the `$items` property directly to get the items
     * for a menu.
     *
     * @api
     * @example
     * ```twig
     * {% for item in menu.get_items %}
     *     <a href="{{ item.link }}">{{ item.title }}</a>
     * {% endfor %}
     * ```
     * @return array Array of `Timber\MenuItem` objects. Empty array if no items could be found.
     */
    public function get_items()
    {
    }
    /**
     * Get the current MenuItem based on the WP context
     *
     * @see _wp_menu_item_classes_by_context()
     * @example
     * Say you want to render the sub-tree of the main menu that corresponds
     * to the menu item for the current page, such as in a context-aware sidebar:
     * ```twig
     * <div class="sidebar">
     *   <a href="{{ menu.current_item.link }}">
     *     {{ menu.current_item.title }}
     *   </a>
     *   <ul>
     *     {% for child in menu.current_item.children %}
     *       <li>
     *         <a href="{{ child.link }}">{{ child.title }}</a>
     *       </li>
     *     {% endfor %}
     *   </ul>
     * </div>
     * ```
     * @param int $depth the maximum depth to traverse the menu tree to find the
     * current item. Defaults to null, meaning no maximum. 1-based, meaning the
     * top level is 1.
     * @return MenuItem the current `Timber\MenuItem` object, i.e. the menu item
     * corresponding to the current post.
     */
    public function current_item($depth = null)
    {
    }
    /**
     * Alias for current_top_level_item(1).
     *
     * @return MenuItem the current top-level `Timber\MenuItem` object.
     */
    public function current_top_level_item()
    {
    }
    /**
     * Traverse an array of MenuItems in search of the current item.
     *
     * @internal
     * @param array $items the items to traverse.
     */
    private function traverse_items_for_current($items, $depth)
    {
    }
    public function __toString()
    {
    }
    /**
     * Checks whether the current user can edit the menu.
     *
     * @api
     * @since 2.0.0
     * @return bool
     */
    public function can_edit() : bool
    {
    }
}
/**
 * Class MenuItem
 *
 * @api
 */
class MenuItem extends \Timber\CoreEntity implements \Stringable
{
    /**
     * @var string What does this class represent in WordPress terms?
     */
    public $object_type = 'post';
    /**
     * @api
     * @var array Array of children of a menu item. Empty if there are no child menu items.
     */
    public $children = [];
    /**
     * @api
     * @var array Array of class names.
     */
    public $classes = [];
    public $class = '';
    public $level = 0;
    public $post_name;
    public $url;
    public $type;
    /**
     * Protected is needed here since we want to force Twig to use the `title()` method
     * in order to apply the `nav_menu_item_title` filter
     */
    protected $title = '';
    /**
     * Inherited property. Listed here to make it available in the documentation.
     *
     * @api
     * @see _wp_menu_item_classes_by_context()
     * @var bool Whether the menu item links to the currently displayed page.
     */
    public $current;
    /**
     * Inherited property. Listed here to make it available in the documentation.
     *
     * @api
     * @see _wp_menu_item_classes_by_context()
     * @var bool Whether the menu item refers to the parent item of the currently displayed page.
     */
    public $current_item_parent;
    /**
     * Inherited property. Listed here to make it available in the documentation.
     *
     * @api
     * @see _wp_menu_item_classes_by_context()
     * @var bool Whether the menu item refers to an ancestor (including direct parent) of the
     *      currently displayed page.
     */
    public $current_item_ancestor;
    /**
     * Object ID.
     *
     * @api
     * @since 2.0.0
     * @var int|null Linked object ID.
     */
    public $object_id = null;
    /**
     * Object type.
     *
     * @api
     * @since 2.0.0
     * @var string The underlying menu object type. E.g. a post type name, a taxonomy name or 'custom'.
     */
    public $object;
    protected $_name;
    protected $_menu_item_url;
    /**
     * @internal
     * @param array|object $data The data this MenuItem is wrapping
     * @param Menu $menu The `Menu` object the menu item is associated with.
     * @return MenuItem a new MenuItem instance
     */
    public static function build($data, ?\Timber\Menu $menu = null) : static
    {
    }
    /**
     * @internal
     * @param Menu $menu The `Menu` object the menu item is associated with.
     */
    protected function __construct(
        /**
         * The underlying WordPress Core object.
         *
         * @since 2.0.0
         */
        protected ?\WP_Post $wp_object,
        /**
         * Timber Menu. Previously this was a public property, but converted to a method to avoid
         * recursion (see #2071).
         *
         * @since 1.12.0
         * @see \Timber\MenuItem::menu()
         */
        protected $menu = null
    )
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Post|null
     */
    public function wp_object() : ?\WP_Post
    {
    }
    /**
     * Add a CSS class the menu item should have.
     *
     * @param string $class_name CSS class name to be added.
     */
    public function add_class(string $class_name)
    {
    }
    /**
     * Add a CSS class the menu item should have.
     *
     * @param string $class_name CSS class name to be added.
     */
    public function remove_class(string $class_name)
    {
    }
    /**
     * Update class string
     */
    protected function update_class()
    {
    }
    /**
     * Get the label for the menu item.
     *
     * @api
     * @return string The label for the menu item.
     */
    public function name()
    {
    }
    /**
     * Magic method to get the label for the menu item.
     *
     * @api
     * @example
     * ```twig
     * <a href="{{ item.link }}">{{ item }}</a>
     * ```
     * @see \Timber\MenuItem::name()
     * @return string The label for the menu item.
     */
    public function __toString() : string
    {
    }
    /**
     * Get the slug for the menu item.
     *
     * @api
     * @example
     * ```twig
     * <ul>
     *     {% for item in menu.items %}
     *         <li class="{{ item.slug }}">
     *             <a href="{{ item.link }}">{{ item.name }}</a>
     *          </li>
     *     {% endfor %}
     * </ul>
     * ```
     * @return string The URL-safe slug of the menu item.
     */
    public function slug()
    {
    }
    /**
     * Allows dev to access the "master object" (ex: post, page, category, post type object) the menu item represents
     *
     * @api
     * @example
     * ```twig
     * <div>
     *     {% for item in menu.items %}
     *         <a href="{{ item.link }}"><img src="{{ item.master_object.thumbnail }}" /></a>
     *     {% endfor %}
     * </div>
     * ```
     * @return mixed|null Whatever object (Timber\Post, Timber\Term, etc.) the menu item represents.
     */
    public function master_object()
    {
    }
    /**
     * Add a new `Timber\MenuItem` object as a child of this menu item.
     *
     * @api
     *
     * @param MenuItem $item The menu item to add.
     */
    public function add_child(\Timber\MenuItem $item)
    {
    }
    /**
     * Update the level data associated with $this.
     *
     * @internal
     * @return bool|null
     */
    public function update_child_levels()
    {
    }
    /**
     * Imports the classes to be used in CSS.
     *
     * @internal
     *
     * @param array|object $data to import.
     */
    public function import_classes($data)
    {
    }
    /**
     * Get children of a menu item.
     *
     * You can also directly access the children through the `$children` property (`item.children`
     * in Twig).
     *
     * @internal
     * @deprecated 2.0.0, use `item.children` instead.
     * @example
     * ```twig
     * {% for child in item.get_children %}
     *     <li class="nav-drop-item">
     *         <a href="{{ child.link }}">{{ child.title }}</a>
     *     </li>
     * {% endfor %}
     * ```
     * @return array|bool Array of children of a menu item. Empty if there are no child menu items.
     */
    public function get_children()
    {
    }
    /**
     * Checks to see if the menu item is an external link.
     *
     * If your site is `example.org`, then `google.com/whatever` is an external link. This is
     * helpful when you want to style external links differently or create rules for the target of a
     * link.
     *
     * @api
     * @example
     * ```twig
     * <a href="{{ item.link }}" target="{{ item.is_external ? '_blank' : '_self' }}">
     * ```
     *
     * Or when you only want to add a target attribute if it is really needed:
     *
     * ```twig
     * <a href="{{ item.link }}" {{ item.is_external ? 'target="_blank"' }}>
     * ```
     *
     * In combination with `is_target_blank()`:
     *
     * ```twig
     * <a href="{{ item.link }}" {{ item.is_external or item.is_target_blank ? 'target="_blank"' }}>
     * ```
     *
     * @return bool Whether the link is external or not.
     */
    public function is_external()
    {
    }
    /**
     * Checks whether the «Open in new tab» option checked in the menu item options.
     *
     * @example
     * ```twig
     * <a href="{{ item.link }}" {{ item.is_target_blank ? 'target="_blank"' }}>
     * ```
     *
     * In combination with `is_external()`
     *
     * ```twig
     * <a href="{{ item.link }}" {{ item.is_target_blank or item.is_external ? 'target="_blank"' }}>
     * ```
     *
     * @return bool Whether the menu item has the «Open in new tab» option checked in the menu item
     *              options.
     */
    public function is_target_blank()
    {
    }
    /**
     * Gets the target of a menu item according to the «Open in new tab» option in the menu item
     * options.
     *
     * This function return `_blank` when the option to open a menu item in a new tab is checked in
     * the WordPress backend, and `_self` if the option is not checked. Beware `_self` is the
     * default value for the target attribute, which means you could leave it out. You can use
     * `item.is_target_blank` if you want to use a conditional.
     *
     * @example
     * ```twig
     * <a href="{{ item.link }}" target="{{ item.target }}">
     * ```
     *
     * @return string
     */
    public function target()
    {
    }
    /**
     * Timber Menu.
     *
     * @api
     * @since 1.12.0
     * @return Menu The `Menu` object the menu item is associated with.
     */
    public function menu()
    {
    }
    /**
     * Gets a menu item meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ item.meta('field_name') }}` instead.
     * @see \Timber\MenuItem::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Get the child menu items of a `Timber\MenuItem`.
     *
     * @api
     * @example
     * ```twig
     * {% for child in item.children %}
     *     <li class="nav-drop-item">
     *         <a href="{{ child.link }}">{{ child.title }}</a>
     *     </li>
     * {% endfor %}
     * ```
     * @return array|bool Array of children of a menu item. Empty if there are no child menu items.
     */
    public function children()
    {
    }
    /**
     * Checks to see if the menu item is an external link.
     *
     * @api
     * @deprecated 2.0.0, use `{{ item.is_external }}`
     * @see \Timber\MenuItem::is_external()
     *
     * @return bool Whether the link is external or not.
     */
    public function external()
    {
    }
    /**
     * Get the full link to a menu item.
     *
     * @api
     * @example
     * ```twig
     * {% for item in menu.items %}
     *     <li><a href="{{ item.link }}">{{ item.title }}</a></li>
     * {% endfor %}
     * ```
     * @return string A full URL, like `https://mysite.com/thing/`.
     */
    public function link()
    {
    }
    /**
     * Get the relative path of the menu item’s link.
     *
     * @api
     * @example
     * ```twig
     * {% for item in menu.items %}
     *     <li><a href="{{ item.path }}">{{ item.title }}</a></li>
     * {% endfor %}
     * ```
     * @return string The path of a URL, like `/foo`.
     */
    public function path()
    {
    }
    /**
     * Get the public label for the menu item.
     *
     * @api
     * @example
     * ```twig
     * {% for item in menu.items %}
     *     <li><a href="{{ item.link }}">{{ item.title }}</a></li>
     * {% endfor %}
     * ```
     * @return string The public label, like "Foo".
     */
    public function title()
    {
    }
    /**
     * Checks whether the current user can edit the menu item.
     *
     * @api
     * @since 2.0.0
     * @return bool
     */
    public function can_edit() : bool
    {
    }
}
/**
 * Class PagesMenu
 *
 * Uses get_pages() to retrieve a list pages and returns it as a Timber menu.
 *
 * @see get_pages()
 *
 * @api
 * @since 2.0.0
 */
class PagesMenu extends \Timber\Menu
{
    /**
     * Initializes a pages menu.
     *
     * @api
     *
     * @param null  $menu Unused. Only here for compatibility with the Timber\Menu class.
     * @param array $args Optional. Args for wp_list_pages().
     *
     * @return PagesMenu
     */
    public static function build($menu, $args = []) : ?self
    {
    }
    /**
     * Sets up properties needed for mocking nav menu items.
     *
     * We need to set some properties so that we can use `wp_setup_nav_menu_item()` on the menu
     * items and a proper menu item hierarchy can be built.
     *
     * @param WP_Post $post A post object.
     *
     * @return WP_Post Updated post object.
     */
    protected function pre_setup_nav_menu_item($post)
    {
    }
}
/**
 * Class Pagination
 *
 * @api
 */
class Pagination
{
    public $current;
    public $total;
    public $pages;
    public $next;
    public $prev;
    /**
     * Pagination constructor.
     *
     * @api
     *
     * @param array           $prefs
     * @param WP_Query|null  $wp_query
     */
    public function __construct($prefs = [], $wp_query = null)
    {
    }
    /**
     * Get pagination.
     *
     * @api
     * @param array   $prefs
     * @return array mixed
     */
    public static function get_pagination($prefs = [])
    {
    }
    protected function init($prefs = [], $wp_query = null)
    {
    }
    /**
     *
     *
     * @param array  $args
     * @return array
     */
    public static function paginate_links($args = [])
    {
    }
    protected static function sanitize_url_params($add_args)
    {
    }
    protected static function sanitize_args($args)
    {
    }
}
/**
 * Class PathHelper
 *
 * Useful methods for working with file paths.
 *
 * @api
 * @since 1.11.1
 */
class PathHelper
{
    /**
     * Returns information about a file path.
     *
     * Unicode-friendly version of PHP’s pathinfo() function.
     *
     * @link  https://www.php.net/manual/en/function.pathinfo.php
     *
     * @api
     * @since 1.11.1
     *
     * @param string $path    The path to be parsed.
     * @param int    $options The path part to extract. One of `PATHINFO_DIRNAME`,
     *                        `PATHINFO_BASENAME`, `PATHINFO_EXTENSION` or `PATHINFO_FILENAME`. If
     *                        not specified, returns all available elements.
     *
     * @return mixed
     */
    public static function pathinfo($path, $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME)
    {
    }
    /**
     * Returns trailing name component of path.
     *
     * Unicode-friendly version of the PHP basename() function.
     *
     * @link  https://www.php.net/manual/en/function.basename.php
     *
     * @api
     * @since 1.11.1
     *
     * @param string $path   The path.
     * @param string $suffix Optional. If the name component ends in suffix, this part will also be
     *                       cut off.
     *
     * @return string
     */
    public static function basename($path, $suffix = '')
    {
    }
}
/**
 * Interface for dealing with collections of Posts, whether directly wrapping a WP_Query instance,
 * a simple (flat/numeric) array of Posts, or some other kind of custom collection.
 *
 * @api
 */
interface PostCollectionInterface extends \Traversable, \Countable, \ArrayAccess
{
    /**
     * Get the Pagination for this collection, if available.
     *
     * @api
     * @param array $options optional config options to pass to the \Timber\Pagination constructor.
     * @return null|Pagination a Pagination object if pagination is available for this collection;
     * null otherwise.
     */
    public function pagination(array $options = []);
    /**
     * Get this collection as a numeric array of \Timber\Post objects.
     *
     * @api
     * @return \Timber\Post[]
     */
    public function to_array() : array;
}
/**
 * PostArrayObject class for dealing with arbitrary collections of Posts
 * (typically not wrapping a `WP_Query` directly, which is what `Timber\PostQuery` does).
 *
 * @api
 */
class PostArrayObject extends \ArrayObject implements \Timber\PostCollectionInterface, \JsonSerializable
{
    use \Timber\AccessesPostsLazily;
    /**
     * Takes an arbitrary array of WP_Posts to wrap and (lazily) translate to
     * Timber\Post instances.
     *
     * @api
     * @param WP_Post[] $posts an array of WP_Post objects
     */
    public function __construct(array $posts)
    {
    }
    /**
     * @inheritdoc
     */
    public function pagination(array $options = [])
    {
    }
    /**
     * Override data printed by var_dump() and similar. Realizes the collection before
     * returning. Due to a PHP bug, this only works in PHP >= 7.4.
     *
     * @see https://bugs.php.net/bug.php?id=69264
     * @internal
     */
    public function __debugInfo() : array
    {
    }
    /**
     * Returns realized (eagerly instantiated) Timber\Post data to serialize to JSON.
     *
     * @internal
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
    }
}
/**
 * The PostExcerpt class lets a user modify a post preview/excerpt to their liking.
 *
 * It’s designed to be used through the `Timber\Post::excerpt()` method. The public methods of this
 * class all return the object itself, which means that this is a **chainable object**. This means
 * that you could change the output of the excerpt by **adding more methods**. But you can also pass
 * in your arguments to the object constructor or to `Timber\Post::excerpt()`.
 *
 * By default, the excerpt will
 *
 * - have a length of 50 words, which will be forced, even if a longer excerpt is set on the post.
 * - be stripped of all HTML tags.
 * - have an ellipsis (…) as the end of the text.
 * - have a "Read More" link appended, if there’s more to read in the post content.
 *
 * One thing to note: If the excerpt already contains all of the text that can also be found in the
 * post’s content, then the read more link as well as the string to use as the end will not be
 * added.
 *
 * This class will also handle cases where you use the `<!-- more -->` tag inside your post content.
 * You can also change the text used for the read more link by adding your desired text to the
 * `<!-- more -->` tag. Here’s an example: `<!-- more Start your journey -->`.
 *
 * You can change the defaults that are used for excerpts through the
 * [`timber/post/excerpt/defaults`](https://timber.github.io/docs/v2/hooks/filters/#timber/post/excerpts/defaults)
 * filter.
 *
 * @api
 * @since 1.0.4
 * @see \Timber\Post::excerpt()
 * @example
 * ```twig
 * {# Use default excerpt #}
 * <p>{{ post.excerpt }}</p>
 *
 * {# Preferred method: Use hash notation to pass arguments. #}
 * <div>{{ post.excerpt({ words: 100, read_more: 'Keep reading' }) }}</div>
 *
 * {# Change the post excerpt text only #}
 * <p>{{ post.excerpt.read_more('Continue Reading') }}</p>
 *
 * {# Additionally restrict the length to 50 words #}
 * <p>{{ post.excerpt.length(50).read_more('Continue Reading') }}</p>
 * ```
 */
class PostExcerpt implements \Stringable
{
    /**
     * Excerpt end.
     *
     * @var string
     */
    protected $end = '&hellip;';
    /**
     * Force length.
     *
     * @var bool
     */
    protected $force = false;
    /**
     * Length in words.
     *
     * @var int
     */
    protected $length = 50;
    /**
     * Length in characters.
     *
     * @var int|bool
     */
    protected $char_length = false;
    /**
     * Read more text.
     *
     * @var string|bool
     */
    protected $read_more = 'Read More';
    /**
     * HTML tag stripping behavior.
     *
     * @var string|bool
     */
    protected $strip = true;
    /**
     * Whether a read more link should be added even if the excerpt isn’t trimmed (when the excerpt
     * isn’t shorter than the post’s content).
     *
     * @since 2.0.0
     * @var bool
     */
    protected $always_add_read_more = false;
    /**
     * Whether the end string should be added even if the excerpt isn’t trimmed (when the excerpt
     * isn’t shorter than the post’s content).
     *
     * @since 2.0.0
     * @var bool
     */
    protected $always_add_end = false;
    /**
     * Destroy tags.
     *
     * @var array List of tags that should always be destroyed.
     */
    protected $destroy_tags = ['script', 'style'];
    /**
     * PostExcerpt constructor.
     *
     * @api
     *
     * @param Post $post The post to pull the excerpt from.
     * @param array        $options {
     *     An array of configuration options for generating the excerpt. Default empty.
     *
     *     @type int      $words     Number of words in the excerpt. Default `50`.
     *     @type int|bool $chars     Number of characters in the excerpt. Default `false` (no
     *                               character limit).
     *     @type string   $end       String to append to the end of the excerpt. Default '&hellip;'
     *                               (HTML ellipsis character).
     *     @type bool     $force     Whether to shorten the excerpt to the length/word count
     *                               specified, even if an editor wrote a manual excerpt longer
     *                               than the set length. Default `false`.
     *     @type bool     $strip     Whether to strip HTML tags. Default `true`.
     *     @type string   $read_more String for what the "Read More" text should be. Default
     *                               'Read More'.
     *     @type bool     $always_add_read_more Whether a read more link should be added even if the
     *                                          excerpt isn’t trimmed (when the excerpt isn’t
     *                                          shorter than the post’s content). Default `false`.
     *     @type bool     $always_add_end       Whether the end string should be added even if the
     *                                          excerpt isn’t trimmed (when the excerpt isn’t
     *                                          shorter than the post’s content). Default `false`.
     * }
     */
    public function __construct(
        /**
         * Post.
         */
        protected $post,
        array $options = []
    )
    {
    }
    /**
     * Returns the resulting excerpt.
     *
     * @api
     * @return string
     */
    public function __toString()
    {
    }
    /**
     * Restricts the length of the excerpt to a certain amount of words.
     *
     * @api
     * @example
     * ```twig
     * <p>{{ post.excerpt.length(50) }}</p>
     * ```
     * @param int $length The maximum amount of words (not letters) for the excerpt. Default `50`.
     * @return PostExcerpt
     */
    public function length($length = 50)
    {
    }
    /**
     * Restricts the length of the excerpt to a certain amount of characters.
     *
     * @api
     * @example
     * ```twig
     * <p>{{ post.excerpt.chars(180) }}</p>
     * ```
     * @param int|bool $char_length The maximum amount of characters for the excerpt. Default
     *                              `false`.
     * @return PostExcerpt
     */
    public function chars($char_length = false)
    {
    }
    /**
     * Defines the text to end the excerpt with.
     *
     * @api
     * @example
     * ```twig
     * <p>{{ post.excerpt.end('… and much more!') }}</p>
     * ```
     * @param string $end The text for the end of the excerpt. Default `…`.
     * @return PostExcerpt
     */
    public function end($end = '&hellip;')
    {
    }
    /**
     * Forces excerpt lengths.
     *
     * What happens if your custom post excerpt is longer than the length requested? By default, it
     * will use the full `post_excerpt`. However, you can set this to `true` to *force* your excerpt
     * to be of the desired length.
     *
     * @api
     * @example
     * ```twig
     * <p>{{ post.excerpt.length(20).force }}</p>
     * ```
     * @param bool $force Whether the length of the excerpt should be forced to the requested
     *                    length, even if an editor wrote a manual excerpt that is longer than the
     *                    set length. Default `true`.
     * @return PostExcerpt
     */
    public function force($force = true)
    {
    }
    /**
     * Defines the text to be used for the "Read More" link.
     *
     * Set this to `false` to not add a "Read More" link.
     *
     * @api
     * ```twig
     * <p>{{ post.excerpt.read_more('Learn more') }}</p>
     * ```
     *
     * @param string|bool $text Text for the link. Default 'Read More'.
     *
     * @return PostExcerpt
     */
    public function read_more($text = 'Read More')
    {
    }
    /**
     * Defines how HTML tags should be stripped from the excerpt.
     *
     * @api
     * ```twig
     * {# Strips all HTML tags, except for bold or emphasized text #}
     * <p>{{ post.excerpt.length('50').strip('<strong><em>') }}</p>
     * ```
     * @param bool|string $strip Whether or how HTML tags in the excerpt should be stripped. Use
     *                           `true` to strip all tags, `false` for no stripping, or a string for
     *                           a list of allowed tags (e.g. '<p><a>'). Default `true`.
     * @return PostExcerpt
     */
    public function strip($strip = true)
    {
    }
    /**
     * Assembles excerpt.
     *
     * @internal
     *
     * @param string $text The text to use for the excerpt.
     * @param array  $args An array of arguments for the assembly.
     */
    protected function assemble($text, $args = [])
    {
    }
    protected function run()
    {
    }
}
/**
 * Class PostQuery
 *
 * Query for a collection of WordPress posts.
 *
 * This is the equivalent of using `WP_Query` in normal WordPress development.
 *
 * PostQuery is used directly in Twig templates to iterate through post query results and
 * retrieve meta information about them.
 *
 * @api
 */
class PostQuery extends \ArrayObject implements \Timber\PostCollectionInterface, \JsonSerializable
{
    use \Timber\AccessesPostsLazily;
    /**
     * Found posts.
     *
     * The total amount of posts found for this query. Will be `0` if you used `no_found_rows` as a
     * query parameter. Will be `null` if you passed in an existing collection of posts.
     *
     * @api
     * @since 1.11.1
     * @var int The amount of posts found in the query.
     */
    public $found_posts = null;
    /**
     * If the user passed an array, it is stored here.
     *
     * @var array
     */
    protected $userQuery;
    /**
     * The internal WP_Query instance that this object is wrapping.
     *
     * @var WP_Query
     */
    protected $wp_query = null;
    protected $pagination = null;
    /**
     * Query for a collection of WordPress posts.
     *
     * Refer to the official documentation for
     * [WP_Query](https://developer.wordpress.org/reference/classes/wp_query/) for a list of all
     * the arguments that can be used for the `$query` parameter.
     *
     * @api
     * @example
     * ```php
     * // Get posts from default query.
     * global $wp_query;
     *
     * $posts = Timber::get_posts( $wp_query );
     *
     * // Using the WP_Query argument format.
     * $posts = Timber::get_posts( [
     *     'post_type'     => 'article',
     *     'category_name' => 'sports',
     * ] );
     *
     * // Passing a WP_Query instance.
     * $posts = Timber::get_posts( new WP_Query( [ 'post_type' => 'any' ) );
     * ```
     *
     * @param WP_Query $query The WP_Query object to wrap.
     */
    public function __construct(\WP_Query $query)
    {
    }
    /**
     * Get pagination for a post collection.
     *
     * Refer to the [Pagination Guide]({{< relref "../guides/pagination.md" >}}) for a detailed usage example.
     *
     * Optionally could be used to get pagination with custom preferences.
     *
     * @api
     * @example
     * ```twig
     * {% if posts.pagination.prev %}
     *     <a href="{{ posts.pagination.prev.link }}">Prev</a>
     * {% endif %}
     *
     * <ul class="pages">
     *     {% for page in posts.pagination.pages %}
     *         <li>
     *             <a href="{{ page.link }}" class="{{ page.class }}">{{ page.title }}</a>
     *         </li>
     *     {% endfor %}
     * </ul>
     *
     * {% if posts.pagination.next %}
     *     <a href="{{ posts.pagination.next.link }}">Next</a>
     * {% endif %}
     * ```
     *
     * @param array $prefs Optional. Custom preferences. Default `array()`.
     *
     * @return Pagination object
     */
    public function pagination($prefs = [])
    {
    }
    /**
     * Gets the original query used to get a collection of Timber posts.
     *
     * @since 2.0
     * @return WP_Query|null
     */
    public function query() : ?\WP_Query
    {
    }
    /**
     * Gets the original query used to get a collection of Timber posts.
     *
     * @deprecated 2.0.0, use PostQuery::query() instead.
     * @return WP_Query|null
     */
    public function get_query() : ?\WP_Query
    {
    }
    /**
     * Override data printed by var_dump() and similar. Realizes the collection before
     * returning. Due to a PHP bug, this only works in PHP >= 7.4.
     *
     * @see https://bugs.php.net/bug.php?id=69264
     * @internal
     */
    public function __debugInfo() : array
    {
    }
    /**
     * Returns realized (eagerly instantiated) Timber\Post data to serialize to JSON.
     *
     * @internal
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
    }
}
/**
 * Wrapper for the post_type object provided by WordPress
 * @since 1.0.4
*/
#[\AllowDynamicProperties]
class PostType implements \Stringable
{
    /**
     * @param string $slug
     */
    public function __construct(private $slug)
    {
    }
    public function __toString()
    {
    }
    protected function init($post_type)
    {
    }
}
/**
 * Class PostsIterator
 */
class PostsIterator extends \ArrayIterator
{
    /**
     * @var null|Post The last post that was returned by the iterator. Used
     *                   to skip the logic in `current()`.
     */
    protected ?\Timber\Post $last_post = null;
    /**
     * Prepares the state before working on a post.
     *
     * Calls the `setup()` function of the current post to setup post data. Before starting the
     * loop, it will call the 'loop_start' hook to improve compatibility with WordPress.
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
    }
    /**
     * Cleans up state before advancing to the next post.
     *
     * Calls the `teardown()` function of the current post. In the last run of a loop through posts,
     * it will call the 'loop_end' hook to improve compatibility with WordPress.
     *
     * @since 2.0.0
     */
    public function next() : void
    {
    }
}
/**
 * Class Site
 *
 * `Timber\Site` gives you access to information you need about your site. In Multisite setups, you
 * can get info on other sites in your network.
 *
 * @api
 * @example
 * ```php
 * $other_site_id = 2;
 *
 * $context = Timber::context( [
 *     'other_site' => new Timber\Site( $other_site_id ),
 * ] );
 *
 * Timber::render('index.twig', $context);
 * ```
 * ```twig
 * My site is called {{site.name}}, another site on my network is {{other_site.name}}
 * ```
 * ```html
 * My site is called Jared's blog, another site on my network is Upstatement.com
 * ```
 */
class Site extends \Timber\Core implements \Timber\CoreInterface
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_Site|null Will only be filled in multisite environments. Otherwise `null`.
     */
    protected ?\WP_Site $wp_object = null;
    /**
     * @api
     * @var string The admin email address set in the WP admin panel
     */
    public $admin_email;
    /**
     * @api
     * @var string
     */
    public $blogname;
    /**
     * @api
     * @var string
     */
    public $charset;
    /**
     * @api
     * @var string
     */
    public $description;
    /**
     * @api
     * @var int the ID of a site in multisite
     */
    public $id;
    /**
     * @api
     * @var string the language setting ex: en-US
     */
    public $language;
    /**
     * @api
     * @var bool true if multisite, false if plain ole' WordPress
     */
    public $multisite;
    /**
     * @api
     * @var string
     */
    public $name;
    /**
     * @deprecated 2.0.0, use $pingback_url
     * @var string for people who like trackback spam
     */
    public $pingback;
    /**
     * @api
     * @var string for people who like trackback spam
     */
    public $pingback_url;
    /**
     * @api
     * @var string
     */
    public $siteurl;
    /**
     * @api
     * @var Theme
     */
    public $theme;
    /**
     * @api
     * @var string
     */
    public $title;
    /**
     * @api
     * @var string
     */
    public $url;
    /**
     * @api
     * @var string
     */
    public $home_url;
    /**
     * @api
     * @var string
     */
    public $site_url;
    /**
     * @api
     * @var string
     */
    public $rdf;
    public $rss;
    public $rss2;
    public $atom;
    /**
     * Constructs a Timber\Site object
     * @api
     * @example
     * ```php
     * //multisite setup
     * $site = new Timber\Site(1);
     * $site_two = new Timber\Site("My Cool Site");
     * //non-multisite
     * $site = new Timber\Site();
     * ```
     * @param string|int $site_name_or_id
     */
    public function __construct($site_name_or_id = null)
    {
    }
    /**
     * Magic method dispatcher for site option fields, for convenience in Twig views.
     *
     * Called when explicitly invoking non-existent methods on the Site object. This method is not
     * meant to be called directly.
     *
     * @example
     * The following example will dynamically dispatch the magic __call() method with an argument
     * of "users_can_register" #}
     *
     * ```twig
     * {% if site.users_can_register %}
     *   {# Show a notification and link to the register form #}
     * {% endif %}
     * @link https://secure.php.net/manual/en/language.oop5.overloading.php#object.call
     * @link https://github.com/twigphp/Twig/issues/2
     * @api
     *
     * @param string $option     The name of the method being called.
     * @param array  $arguments Enumerated array containing the parameters passed to the function.
     *                          Not used.
     *
     * @return mixed The value of the option field named `$field` if truthy, `false` otherwise.
     */
    public function __call($option, $arguments)
    {
    }
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Site|null Will only return a `WP_Site` object in multisite environments. Otherwise `null`.
     */
    public function wp_object() : ?\WP_Site
    {
    }
    /**
     * Switches to the blog requested in the request
     *
     * @param string|integer|null $blog_identifier The name or ID of the blog to switch to. If `null`, the current blog.
     * @return integer with the ID of the new blog
     */
    protected static function switch_to_blog($blog_identifier = null) : int
    {
    }
    /**
     * @internal
     * @param integer $site_id
     */
    protected function init_as_multisite($site_id)
    {
    }
    /**
     * Executed for single-blog sites
     * @internal
     */
    protected function init_as_singlesite()
    {
    }
    /**
     * Executed for all types of sites: both multisite and "regular"
     * @internal
     */
    protected function init()
    {
    }
    /**
     * Returns the language attributes that you're looking for
     * @return string
     */
    public function language_attributes()
    {
    }
    /**
     * Get the value for a site option.
     *
     * @api
     * @example
     * ```twig
     * Published on: {{ post.date|date(site.date_format) }}
     * ```
     *
     * @param string $option The name of the option to get the value for.
     *
     * @return mixed The option value.
     */
    public function __get($option)
    {
    }
    /**
     * Get the value for a site option.
     *
     * @api
     * @example
     * ```twig
     * Published on: {{ post.date|date(site.option('date_format')) }}
     * ```
     *
     * @param string $option The name of the option to get the value for.
     *
     * @return mixed The option value.
     */
    public function option($option)
    {
    }
    /**
     * Get the value for a site option.
     *
     * @api
     * @deprecated 2.0.0, use `{{ site.option }}` instead
     */
    public function meta($option)
    {
    }
    /**
     * @api
     * @return null|Image
     */
    public function icon()
    {
    }
    protected function icon_multisite($site_id)
    {
    }
    /**
     * Returns the link to the site's home.
     *
     * @api
     * @example
     * ```twig
     * <a href="{{ site.link }}" title="Home">
     *       <img src="/wp-content/uploads/logo.png" alt="Logo for some stupid thing" />
     * </a>
     * ```
     * ```html
     * <a href="https://example.org" title="Home">
     *       <img src="/wp-content/uploads/logo.png" alt="Logo for some stupid thing" />
     * </a>
     * ```
     *
     * @return string
     */
    public function link()
    {
    }
    /**
     * Updates a site option.
     *
     * @deprecated 2.0.0 Use `update_option()` or `update_blog_option()` instead.
     *
     * @param string $key   The key of the site option to update.
     * @param mixed  $value The new value.
     */
    public function update($key, $value)
    {
    }
}
/**
 * Class Term
 *
 * Terms: WordPress has got 'em, you want 'em. Categories. Tags. Custom Taxonomies. You don't care,
 * you're a fiend. Well let's get this under control:
 *
 * @api
 * @example
 * ```php
 * // Get a term by its ID
 * $context['term'] = Timber::get_term(6);
 *
 * // Get a term when on a term archive page
 * $context['term_page'] = Timber::get_term();
 *
 * // Get a term with a slug
 * $context['team'] = Timber::get_term('patriots');
 * Timber::render('index.twig', $context);
 * ```
 * ```twig
 * <h2>{{ term_page.name }} Archives</h2>
 * <h3>Teams</h3>
 * <ul>
 *     <li>{{ st_louis.name}} - {{ st_louis.description }}</li>
 *     <li>{{ team.name}} - {{ team.description }}</li>
 * </ul>
 * ```
 * ```html
 * <h2>Team Archives</h2>
 * <h3>Teams</h3>
 * <ul>
 *     <li>St. Louis Cardinals - Winner of 11 World Series</li>
 *     <li>New England Patriots - Winner of 6 Super Bowls</li>
 * </ul>
 * ```
 */
class Term extends \Timber\CoreEntity implements \Stringable
{
    /**
     * The underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @var WP_Term|null
     */
    protected ?\WP_Term $wp_object = null;
    public $object_type = 'term';
    public static $representation = 'term';
    public $_children;
    /**
     * @api
     * @var string the human-friendly name of the term (ex: French Cuisine)
     */
    public $name;
    /**
     * @api
     * @var string the WordPress taxonomy slug (ex: `post_tag` or `actors`)
     */
    public $taxonomy;
    /**
     * @internal
     */
    protected function __construct()
    {
    }
    /**
     * @internal
     *
     * @param WP_Term      $wp_term The vanilla WordPress term object to build from.
     * @return Term
     */
    public static function build(\WP_Term $wp_term) : static
    {
    }
    /**
     * The string the term will render as by default
     *
     * @api
     * @return string
     */
    public function __toString()
    {
    }
    /**
     *
     * @deprecated 2.0.0, use TermFactory::from instead.
     *
     * @param $tid
     * @param $taxonomy
     *
     * @return static
     */
    public static function from($tid, $taxonomy = null)
    {
    }
    /* Setup
       ===================== */
    /**
     * @internal
     */
    protected function init(\WP_Term $term)
    {
    }
    /**
     * @internal
     * @param int|object|array $tid
     * @return mixed
     */
    protected function get_term($tid)
    {
    }
    /**
     * @internal
     * @return int|array
     */
    protected static function get_tid(mixed $tid)
    {
    }
    /* Public methods
       ===================== */
    /**
     * Gets the underlying WordPress Core object.
     *
     * @since 2.0.0
     *
     * @return WP_Term|null
     */
    public function wp_object() : ?\WP_Term
    {
    }
    /**
     * @deprecated 2.0.0, use `{{ term.edit_link }}` instead.
     * @return string
     */
    public function get_edit_url()
    {
    }
    /**
     * Gets a term meta value.
     * @deprecated 2.0.0, use `{{ term.meta('field_name') }}` instead.
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return string The meta field value.
     */
    public function get_meta_field($field_name)
    {
    }
    /**
     * @internal
     * @return array
     */
    public function children()
    {
    }
    /**
     * Return the description of the term
     *
     * @api
     * @return string
     */
    public function description()
    {
    }
    /**
     * Checks whether the current user can edit the term.
     *
     * @api
     * @example
     * ```twig
     * {% if term.can_edit %}
     *     <a href="{{ term.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return bool
     */
    public function can_edit() : bool
    {
    }
    /**
     * Gets the edit link for a term if the current user has the correct rights.
     *
     * @api
     * @example
     * ```twig
     * {% if term.can_edit %}
     *    <a href="{{ term.edit_link }}">Edit</a>
     * {% endif %}
     * ```
     * @return string|null The edit URL of a term in the WordPress admin or null if the current user can’t edit the
     *                     term.
     */
    public function edit_link() : ?string
    {
    }
    /**
     * Returns a full link to the term archive page like `https://example.com/category/news`
     *
     * @api
     * @example
     * ```twig
     * See all posts in: <a href="{{ term.link }}">{{ term.name }}</a>
     * ```
     *
     * @return string
     */
    public function link()
    {
    }
    /**
     * Gets a term meta value.
     *
     * @api
     * @deprecated 2.0.0, use `{{ term.meta('field_name') }}` instead.
     * @see \Timber\Term::meta()
     *
     * @param string $field_name The field name for which you want to get the value.
     * @return mixed The meta field value.
     */
    public function get_field($field_name = null)
    {
    }
    /**
     * Returns a relative link (path) to the term archive page like `/category/news`
     *
     * @api
     * @example
     * ```twig
     * See all posts in: <a href="{{ term.path }}">{{ term.name }}</a>
     * ```
     * @return string
     */
    public function path()
    {
    }
    /**
     * Gets posts that have the current term assigned.
     *
     * @api
     * @example
     * Query the default posts_per_page for this Term:
     *
     * ```twig
     * <h4>Recent posts in {{ term.name }}</h4>
     *
     * <ul>
     * {% for post in term.posts() %}
     *     <li>
     *         <a href="{{ post.link }}">{{ post.title }}</a>
     *     </li>
     * {% endfor %}
     * </ul>
     * ```
     *
     * Query exactly 3 Posts from this Term:
     *
     * ```twig
     * <h4>Recent posts in {{ term.name }}</h4>
     *
     * <ul>
     * {% for post in term.posts(3) %}
     *     <li>
     *         <a href="{{ post.link }}">{{ post.title }}</a>
     *     </li>
     * {% endfor %}
     * </ul>
     * ```
     *
     * If you need more control over the query that is going to be performed, you can pass your
     * custom query arguments in the first parameter.
     *
     * ```twig
     * <h4>Our branches in {{ region.name }}</h4>
     *
     * <ul>
     * {% for branch in region.posts({
     *     post_type: 'branch',
     *     posts_per_page: -1,
     *     orderby: 'menu_order'
     * }) %}
     *     <li>
     *         <a href="{{ branch.link }}">{{ branch.title }}</a>
     *     </li>
     * {% endfor %}
     * </ul>
     * ```
     *
     * @param int|array $query           Optional. Either the number of posts or an array of
     *                                   arguments for the post query to be performed.
     *                                   Default is an empty array, the equivalent of:
     *                                   ```php
     *                                   [
     *                                     'posts_per_page' => get_option('posts_per_page'),
     *                                     'post_type'      => 'any',
     *                                     'tax_query'      => [ ...tax query for this Term... ]
     *                                   ]
     *                                   ```
     * @param string $post_type_or_class Deprecated. Before Timber 2.x this was a post_type to be
     *                                   used for querying posts OR the Timber\Post subclass to
     *                                   instantiate for each post returned. As of Timber 2.0.0,
     *                                   specify `post_type` in the `$query` array argument. To
     *                                   specify the class, use Class Maps.
     * @see https://timber.github.io/docs/v2/guides/posts/
     * @see https://timber.github.io/docs/v2/guides/class-maps/
     * @return PostQuery
     */
    public function posts($query = [], $post_type_or_class = null)
    {
    }
    /**
     * @api
     * @return string
     */
    public function title()
    {
    }
    /** DEPRECATED DOWN HERE
     * ======================
     **/
    /**
     * Get Posts that have been "tagged" with the particular term
     *
     * @api
     * @deprecated 2.0.0 use `{{ term.posts }}` instead
     *
     * @param int $numberposts
     * @return array|bool|null
     */
    public function get_posts($numberposts = 10)
    {
    }
    /**
     * @api
     * @deprecated 2.0.0, use `{{ term.children }}` instead.
     *
     * @return array
     */
    public function get_children()
    {
    }
    /**
     * Updates term_meta of the current object with the given value.
     *
     * @deprecated 2.0.0 Use `update_term_meta()` instead.
     *
     * @param string $key   The key of the meta field to update.
     * @param mixed  $value The new value.
     */
    public function update($key, $value)
    {
    }
}
/**
 * Class TextHelper
 *
 * Class provides different text-related functions commonly used in WordPress development
 *
 * @api
 */
class TextHelper
{
    /**
     * Trims text to a certain number of characters.
     * This function can be useful for excerpt of the post
     * As opposed to wp_trim_words trims characters that makes text to
     * take the same amount of space in each post for example
     *
     * @api
     * @since   1.2.0
     * @author  @CROSP
     *
     * @param   string $text      Text to trim.
     * @param   int    $num_chars Number of characters. Default is 60.
     * @param   string $more      What to append if $text needs to be trimmed. Defaults to '&hellip;'.
     * @return  string trimmed text.
     */
    public static function trim_characters($text, $num_chars = 60, $more = '&hellip;')
    {
    }
    /**
     * @api
     * @param string  $text
     * @param int     $num_words
     * @param string|null|false  $more text to appear in "Read more...". Null to use default, false to hide
     * @param string  $allowed_tags
     * @return string
     */
    public static function trim_words($text, $num_words = 55, $more = null, $allowed_tags = 'p a span b i br blockquote')
    {
    }
    /**
     * @api
     *
     * @param       $string
     * @param array $tags
     *
     * @return null|string|string[]
     */
    public static function remove_tags($string, $tags = [])
    {
    }
    /**
     *
     *
     * @param string  $html
     * @return string
     */
    public static function close_tags($html)
    {
    }
}
/**
 * Class Theme
 *
 * Need to display info about your theme? Well you've come to the right place. By default info on
 * the current theme comes for free with what's fetched by `Timber::context()` in which case you
 * can access it your theme like so:
 *
 * @api
 * @example
 * ```php
 * <?php
 * $context = Timber::context();
 *
 * Timber::render('index.twig', $context);
 * ?>
 * ```
 * ```twig
 * <script src="{{ theme.link }}/static/js/all.js"></script>
 * ```
 * ```html
 * <script src="https://example.org/wp-content/themes/my-theme/static/js/all.js"></script>
 * ```
 */
class Theme extends \Timber\Core implements \JsonSerializable
{
    /**
     * The human-friendly name of the theme (ex: `My Timber Starter Theme`)
     *
     * @api
     * @var string the human-friendly name of the theme (ex: `My Timber Starter Theme`)
     */
    public $name;
    /**
     * The version of the theme (ex: `1.2.3`)
     *
     * @api
     * @var string the version of the theme (ex: `1.2.3`)
     */
    public $version;
    /**
     * Timber\Theme object for the parent theme.
     *
     * Always returns the top-most theme. If the current theme is also the parent theme, it will
     * return itself.
     *
     * @api
     * @var Theme the Timber\Theme object for the parent theme
     */
    public $parent;
    /**
     * Slug of the parent theme (ex: `_s`)
     *
     * @api
     * @var string the slug of the parent theme (ex: `_s`)
     */
    public $parent_slug;
    /**
     * @api
     * @var string the slug of the theme (ex: `my-timber-theme`)
     */
    public $slug;
    /**
     * @api
     * @var string Retrieves template directory URI for the active (parent) theme. (ex: `https://example.org/wp-content/themes/my-timber-theme`).
     */
    public $uri;
    /**
     * @var WP_Theme the underlying WordPress native Theme object
     */
    private $theme;
    /**
     * Constructs a new `Timber\Theme` object.
     *
     * The `Timber\Theme` object of the current theme comes in the default `Timber::context()`
     * call. You can access this in your twig template via `{{ site.theme }}`.
     *
     * @api
     * @example
     * ```php
     * <?php
     *     $theme = new Timber\Theme("my-timber-theme");
     *     $context['theme_stuff'] = $theme;
     *     Timber::render('single.twig', $context);
     * ```
     * ```twig
     * We are currently using the {{ theme_stuff.name }} theme.
     * ```
     * ```html
     * We are currently using the My Theme theme.
     * ```
     *
     * @param string $slug
     */
    public function __construct($slug = null)
    {
    }
    /**
     * Initializes the Theme object
     *
     * @internal
     * @param string $slug of theme (eg 'my-timber-theme').
     */
    protected function init($slug = null)
    {
    }
    /**
     * @api
     * @return string Retrieves template directory URI for the active (child) theme. (ex: `https://example.org/wp-content/themes/my-timber-theme`).
     */
    public function link()
    {
    }
    /**
     * @api
     * @return string The relative path to the theme (ex: `/wp-content/themes/my-timber-theme`).
     */
    public function path()
    {
    }
    /**
     * @api
     * @param string $name
     * @param bool $default
     * @return string
     */
    public function theme_mod($name, $default = false)
    {
    }
    /**
     * @api
     * @return array
     */
    public function theme_mods()
    {
    }
    /**
     * Gets a raw, unformatted theme header.
     *
     * @api
     * @see \WP_Theme::get()
     * @example
     * ```twig
     * {{ theme.get('Version') }}
     * ```
     *
     * @param string $header Name of the theme header. Name, Description, Author, Version,
     *                       ThemeURI, AuthorURI, Status, Tags.
     *
     * @return false|string String on success, false on failure.
     */
    public function get($header)
    {
    }
    /**
     * Gets a theme header, formatted and translated for display.
     *
     * @api
     * @see \WP_Theme::display()
     * @example
     * ```twig
     * {{ theme.display('Description') }}
     * ```
     *
     * @param string $header Name of the theme header. Name, Description, Author, Version,
     *                       ThemeURI, AuthorURI, Status, Tags.
     *
     * @return false|string
     */
    public function display($header)
    {
    }
    /**
     * Returns serialized theme data.
     *
     * This data will e.g. be used when a `Timber\Theme` object is used to generate a key. We need to serialize the data
     * because the $parent property is a reference to itself. This recursion would cause json_encode() to fail.
     *
     * @internal
     * @return array
     */
    public function jsonSerialize() : array
    {
    }
}
/**
 * Class Timber
 *
 * Main class called Timber for this plugin.
 *
 * @api
 * @example
 * ```php
 * // Get default posts on an archive page
 * $posts = Timber::get_posts();
 *
 * // Query for some posts
 * $posts = Timber::get_posts( [
 *     'post_type' => 'article',
 *     'category_name' => 'sports',
 * ] );
 *
 * $context = Timber::context( [
 *     'posts' => $posts,
 * ] );
 *
 * Timber::render( 'index.twig', $context );
 * ```
 */
class Timber
{
    public static $version = '2.3.1';
    // x-release-please-version
    public static $locations;
    public static $dirname = 'views';
    public static $auto_meta = true;
    /**
     * Global context cache.
     *
     * @var array An array containing global context variables.
     */
    public static $context_cache = [];
    /**
     * Caching option for Twig.
     *
     * @deprecated 2.0.0
     * @var bool
     */
    public static $twig_cache = false;
    /**
     * Caching option for Twig.
     *
     * Alias for `Timber::$twig_cache`.
     *
     * @deprecated 2.0.0
     * @var bool
     */
    public static $cache = false;
    /**
     * Autoescaping option for Twig.
     *
     * @deprecated 2.0.0
     * @var bool
     */
    public static $autoescape = false;
    /**
     * Timber should be loaded with Timber\Timber::init() and not new Timber\Timber();
     *
     * @codeCoverageIgnore
     */
    protected function __construct()
    {
    }
    protected function init_constants()
    {
    }
    /**
     * @codeCoverageIgnore
     */
    public static function init() : void
    {
    }
    /**
     * Initializes Timber's integrations.
     *
     * @return void
     */
    public static function init_integrations() : void
    {
    }
    /**
     * Handles previewing posts.
     *
     * @param array $data
     * @param Post $post
     * @return array
     */
    public static function handle_preview($data, $post)
    {
    }
    /* Post Retrieval Routine
       ================================ */
    /**
     * Gets a Timber Post from a post ID, WP_Post object, a WP_Query object, or an associative
     * array of arguments for WP_Query::__construct().
     *
     * By default, Timber will use the `Timber\Post` class to create a new post object. To control
     * which class is instantiated for your Post object, use [Class Maps](https://timber.github.io/docs/v2/guides/class-maps/)
     *
     * @api
     * @example
     * ```php
     * // Using a post ID.
     * $post = Timber::get_post( 75 );
     *
     * // Using a WP_Post object.
     * $wp_post = get_post( 123 );
     * $post    = Timber::get_post( $wp_post );
     *
     * // Using a WP_Query argument array
     * $post = Timber::get_post( [
     *   'post_type' => 'page',
     * ] );
     *
     * // Use currently queried post. Same as using get_the_ID() as a parameter.
     * $post = Timber::get_post();
     *
     * // From an associative array with an `ID` key. For ACF compatibility. Using this
     * // approach directly is not recommended. If you can, configure the return type of your
     * // ACF field to just the ID.
     * $post = Timber::get_post( get_field('associated_post_array') ); // Just OK.
     * $post = Timber::get_post( get_field('associated_post_id') ); // Better!
     * ```
     * @see https://developer.wordpress.org/reference/classes/wp_query/__construct/
     *
     * @param mixed $query   Optional. Post ID or query (as an array of arguments for WP_Query).
     * 	                     If a query is provided, only the first post of the result will be
     *                       returned. Default false.
     * @param array $options Optional associative array of options. Defaults to an empty array.
     *
     * @return Post|null Timber\Post object if a post was found, null if no post was
     *                           found.
     */
    public static function get_post(mixed $query = false, $options = [])
    {
    }
    /**
     * Gets an attachment.
     *
     * Behaves just like Timber::get_post(), except that it returns null if it finds a Timber\Post
     * that is not an Attachment. Honors Class Maps and falsifies return value *after* Class Map for
     * the found Timber\Post has been resolved.
     *
     * @api
     * @since 2.0.0
     * @see Timber::get_post()
     * @see https://timber.github.io/docs/v2/guides/class-maps/
     *
     * @param mixed $query   Optional. Query or post identifier. Default false.
     * @param array $options Optional. Options for Timber\Timber::get_post().
     *
     * @return Attachment|null Timber\Attachment object if an attachment was found, null if no
     *                         attachment was found.
     */
    public static function get_attachment(mixed $query = false, $options = [])
    {
    }
    /**
     * Gets an image.
     *
     * Behaves just like Timber::get_post(), except that it returns null if it finds a Timber\Post
     * that is not an Image. Honors Class Maps and falsifies return value *after* Class Map for the
     * found Timber\Post has been resolved.
     *
     * @api
     * @since 2.0.0
     * @see Timber::get_post()
     * @see https://timber.github.io/docs/v2/guides/class-maps/
     *
     * @param mixed $query   Optional. Query or post identifier. Default false.
     * @param array $options Optional. Options for Timber\Timber::get_post().
     *
     * @return Image|null
     */
    public static function get_image(mixed $query = false, $options = [])
    {
    }
    /**
     * Gets an external image.
     *
     * Behaves just like Timber::get_image(), except that you can use an absolute or relative path or a URL to load an
     * image. You can also pass in an external URL. In that case, Timber will sideload the image and store it in the
     * uploads folder of your WordPress installation. The next time the image is accessed, it will be loaded from there.
     *
     * @api
     * @since 2.0.0
     * @see Timber::get_image()
     * @see ImageHelper::sideload_image()
     *
     * @param bool  $url Image path or URL. The path can be absolute or relative to the WordPress installation.
     * @param array $args {
     *     An associative array with additional arguments for the image.
     *
     *     @type string $alt Alt text for the image.
     *     @type string $caption Caption text for the image.
     * }
     *
     * @return ExternalImage|null
     */
    public static function get_external_image($url = false, array $args = []) : ?\Timber\ExternalImage
    {
    }
    /**
     * Checks for deprecated Timber::get_post() API usage.
     *
     * @param $query
     * @param $options
     * @param $function_name
     */
    private static function check_post_api_deprecations($query = false, $options = [], string $function_name = 'Timber::get_post()')
    {
    }
    /**
     * Gets a collection of posts.
     *
     * Refer to the official documentation for
     * [WP_Query](https://developer.wordpress.org/reference/classes/wp_query/) for a list of all
     * the arguments that can be used for the `$query` parameter.
     *
     * @api
     * @example
     * ```php
     * // Use the global query.
     * $posts = Timber::get_posts();
     *
     * // Using the WP_Query argument format.
     * $posts = Timber::get_posts( [
     *    'post_type'     => 'article',
     *    'category_name' => 'sports',
     * ] );
     *
     * // Using a WP_Query instance.
     * $posts = Timber::get_posts( new WP_Query( [ 'post_type' => 'any' ) );
     *
     * // Using an array of post IDs.
     * $posts = Timber::get_posts( [ 47, 543, 3220 ] );
     * ```
     *
     * @param mixed $query  Optional. Query args. Default `false`, which means that Timber will use
     *                      the global query. Accepts an array of `WP_Query` arguments, a `WP_Query`
     *                      instance or a list of post IDs.
     * @param array $options {
     *     Optional. Options for the query.
     *
     *     @type bool $merge_default    Merge query parameters with the default query parameters of
     *                                  the current template. Default false.
     * }
     *
     * @return PostCollectionInterface|null Null if no query could be run with the used
     *                                              query parameters.
     */
    public static function get_posts(mixed $query = false, $options = [])
    {
    }
    /**
     * Gets a post by title or slug.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // By slug
     * $post = Timber::get_post_by( 'slug', 'about-us' );
     *
     * // By title
     * $post = Timber::get_post_by( 'title', 'About us' );
     * ```
     *
     * @param string       $type         The type to look for. One of `slug` or `title`.
     * @param string       $search_value The post slug or post title to search for. When searching
     *                                   for `title`, this parameter doesn’t need to be
     *                                   case-sensitive, because the `=` comparison is used in
     *                                   MySQL.
     * @param array        $args {
     *     Optional. An array of arguments to configure what is returned.
     *
     * 	   @type string|array     $post_type   Optional. What WordPress post type to limit the
     *                                         results to. Defaults to 'any'
     *     @type string           $order_by    Optional. The field to sort by. Defaults to
     *                                         'post_date'
     *     @type string           $order       Optional. The sort to apply. Defaults to ASC
     *
     * }
     *
     * @return Post|null A Timber post or `null` if no post could be found. If multiple
     *                           posts with the same slug or title were found, it will select the
     *                           post with the oldest date.
     */
    public static function get_post_by($type, $search_value, $args = [])
    {
    }
    /**
     * Query post.
     *
     * @api
     * @deprecated since 2.0.0 Use `Timber::get_post()` instead.
     *
     *
     * @return Post|array|bool|null
     */
    public static function query_post(mixed $query = false, array $options = [])
    {
    }
    /**
     * Query posts.
     *
     * @api
     * @deprecated since 2.0.0 Use `Timber::get_posts()` instead.
     *
     *
     * @return PostCollectionInterface
     */
    public static function query_posts(mixed $query = false, array $options = [])
    {
    }
    /**
     * Gets an attachment by its URL or absolute file path.
     *
     * Honors the `timber/post/image_extensions` filter, returning a Timber\Image if the found
     * attachment is identified as an image. Also honors Class Maps.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get attachment by URL.
     * $attachment = Timber::get_attachment_by( 'url', 'https://example.com/uploads/2020/09/cat.gif' );
     *
     * // Get attachment by filepath.
     * $attachment = Timber::get_attachment_by( 'path', '/path/to/wp-content/uploads/2020/09/cat.gif' );
     *
     * // Try to handle either case.
     * $mystery_string = some_function();
     * $attachment     = Timber::get_attachment_by( $mystery_string );
     * ```
     *
     * @param string $field_or_ident Can be "url", "path", an attachment URL, or the absolute
     *                               path of an attachment file. If "url" or "path" is given, a
     *                               second arg is required.
     * @param string $ident          Optional. An attachment URL or absolute path. Default empty
     *                               string.
     *
     * @return Attachment|null
     */
    public static function get_attachment_by(string $field_or_ident, string $ident = '')
    {
    }
    /* Term Retrieval
       ================================ */
    /**
     * Gets terms.
     *
     * @api
     * @see https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
     * @example
     * ```php
     * // Get all tags.
     * $tags = Timber::get_terms( 'post_tag' );
     * // Note that this is equivalent to:
     * $tags = Timber::get_terms( 'tag' );
     * $tags = Timber::get_terms( 'tags' );
     *
     * // Get all categories.
     * $cats = Timber::get_terms( 'category' );
     *
     * // Get all terms in a custom taxonomy.
     * $cats = Timber::get_terms('my_taxonomy');
     *
     * // Perform a custom Term query.
     * $cats = Timber::get_terms( [
     *   'taxonomy' => 'my_taxonomy',
     *   'orderby'  => 'slug',
     *   'order'    => 'DESC',
     * ] );
     * ```
     *
     * @param string|array $args    A string or array identifying the taxonomy or
     *                              `WP_Term_Query` args. Numeric strings are treated as term IDs;
     *                              non-numeric strings are treated as taxonomy names. Numeric
     *                              arrays are treated as a list a of term identifiers; associative
     *                              arrays are treated as args for `WP_Term_Query::__construct()`
     *                              and accept any valid parameters to that constructor.
     *                              Default `null`, which will get terms from all queryable
     *                              taxonomies.
     * @param array        $options Optional. None are currently supported. Default empty array.
     *
     * @return iterable
     */
    public static function get_terms($args = null, array $options = []) : iterable
    {
    }
    /**
     * Gets a term.
     *
     * @api
     * @param int|WP_Term $term A WP_Term or term_id
     * @return Term|null
     * @example
     * ```php
     * // Get a Term.
     * $tag = Timber::get_term( 123 );
     * ```
     */
    public static function get_term($term = null)
    {
    }
    /**
     * Gets a term by field.
     *
     * This function works like
     * [`get_term_by()`](https://developer.wordpress.org/reference/functions/get_term_by/), but
     * returns a `Timber\Term` object.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get a term by slug.
     * $term = Timber::get_term_by( 'slug', 'security' );
     *
     * // Get a term by name.
     * $term = Timber::get_term_by( 'name', 'Security' );
     *
     * // Get a term by slug from a specific taxonomy.
     * $term = Timber::get_term_by( 'slug', 'security', 'category' );
     * ```
     *
     * @param string     $field    The name of the field to retrieve the term with. One of: `id`,
     *                             `ID`, `slug`, `name` or `term_taxonomy_id`.
     * @param int|string $value    The value to search for by `$field`.
     * @param string     $taxonomy The taxonomy you want to retrieve from. Empty string will search
     *                             from all.
     *
     * @return Term|null
     */
    public static function get_term_by(string $field, $value, string $taxonomy = '')
    {
    }
    /* User Retrieval
       ================================ */
    /**
     * Gets one or more users as an array.
     *
     * By default, Timber will use the `Timber\User` class to create a your post objects. To
     * control which class is used for your post objects, use [Class Maps]().
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get users with on an array of user IDs.
     * $users = Timber::get_users( [ 24, 81, 325 ] );
     *
     * // Get all users that only have a subscriber role.
     * $subscribers = Timber::get_users( [
     *     'role' => 'subscriber',
     * ] );
     *
     * // Get all users that have published posts.
     * $post_authors = Timber::get_users( [
     *     'has_published_posts' => [ 'post' ],
     * ] );
     * ```
     *
     * @todo  Add links to Class Maps documentation in function summary.
     *
     * @param array $query   Optional. A WordPress-style query or an array of user IDs. Use an
     *                       array in the same way you would use the `$args` parameter in
     *                       [WP_User_Query](https://developer.wordpress.org/reference/classes/wp_user_query/).
     *                       See
     *                       [WP_User_Query::prepare_query()](https://developer.wordpress.org/reference/classes/WP_User_Query/prepare_query/)
     *                       for a list of all available parameters. Passing an empty parameter
     *                       will return an empty array. Default empty array
     *                       `[]`.
     * @param array $options Optional. An array of options. None are currently supported. This
     *                       parameter exists to prevent future breaking changes. Default empty
     *                       array `[]`.
     *
     * @return iterable An array of users objects. Will be empty if no users were found.
     */
    public static function get_users(array $query = [], array $options = []) : iterable
    {
    }
    /**
     * Gets a single user.
     *
     * By default, Timber will use the `Timber\User` class to create a your post objects. To
     * control which class is used for your post objects, use [Class Maps]().
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * $current_user = Timber::get_user();
     *
     * // Get user by ID.
     * $user = Timber::get_user( $user_id );
     *
     * // Convert a WP_User object to a Timber\User object.
     * $user = Timber::get_user( $wp_user_object );
     *
     * // Check if a user is logged in.
     *
     * $user = Timber::get_user();
     *
     * if ( $user ) {
     *     // Yay, user is logged in.
     * }
     * ```
     *
     * @todo Add links to Class Maps documentation in function summary.
     *
     * @param int|WP_User $user A WP_User object or a WordPress user ID. Defaults to the ID of the
     *                           currently logged-in user.
     *
     * @return User|null
     */
    public static function get_user($user = null)
    {
    }
    /**
     * Gets a user by field.
     *
     * This function works like
     * [`get_user_by()`](https://developer.wordpress.org/reference/functions/get_user_by/), but
     * returns a `Timber\User` object.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get a user by email.
     * $user = Timber::get_user_by( 'email', 'user@example.com' );
     *
     * // Get a user by login.
     * $user = Timber::get_user_by( 'login', 'keanu-reeves' );
     * ```
     *
     * @param string     $field The name of the field to retrieve the user with. One of: `id`,
     *                          `ID`, `slug`, `email` or `login`.
     * @param int|string $value The value to search for by `$field`.
     *
     * @return User|null
     */
    public static function get_user_by(string $field, $value)
    {
    }
    /* Menu Retrieval
       ================================ */
    /**
     * Gets a nav menu object.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get a menu by location
     * $menu = Timber::get_menu( 'primary-menu' );
     *
     * // Get a menu by slug
     * $menu = Timber::get_menu( 'my-menu' );
     *
     * // Get a menu by name
     * $menu = Timber::get_menu( 'Main Menu' );
     *
     * // Get a menu by ID (term_id)
     * $menu = Timber::get_menu( 123 );
     * ```
     *
     * @param int|string $identifier A menu identifier: a term_id, slug, menu name, or menu location name
     * @param array      $args An associative array of options. Currently only one option is
     * supported:
     * - `depth`: How deep down the tree of menu items to query. Useful if you only want
     *   the first N levels of items in the menu.
     *
     * @return Menu|null
     */
    public static function get_menu($identifier = null, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Gets a menu by field.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * // Get a menu by location.
     * $menu = Timber::get_menu_by( 'location', 'primary' );
     *
     * // Get a menu by slug.
     * $menu = Timber::get_menu_by( 'slug', 'primary-menu' );
     * ```
     *
     * @param string     $field The name of the field to retrieve the menu with. One of: `id`,
     *                          `ID`, `term_id`, `slug`, `name` or `location`.
     * @param int|string $value The value to search for by `$field`.
     *
     * @return Menu|null
     */
    public static function get_menu_by(string $field, $value, array $args = []) : ?\Timber\Menu
    {
    }
    /**
     * Gets a menu from the existing pages.
     *
     * @api
     * @since 2.0.0
     *
     * @example
     * ```php
     * $menu = Timber::get_pages_menu();
     * ```
     *
     * @param array $args Optional. Arguments for `wp_list_pages()`. Timber doesn’t use that
     *                    function under the hood, but supports all arguments for that function.
     *                    It will use `get_pages()` to get the pages that will be used for the Pages
     *                    Menu.
     */
    public static function get_pages_menu(array $args = [])
    {
    }
    /**
     * Get the navigation menu location assigned to the given menu.
     *
     * @api
     * @since 2.3.0
     *
     * @param  WP_Term|int $term The menu to find; either a WP_Term object or a Term ID.
     * @return string|null
     */
    public static function get_menu_location($term) : ?string
    {
    }
    /**
     * Get the navigation menu locations with assigned menus.
     *
     * @api
     * @since 2.3.0
     *
     * @return array<string, (int|string)>
     */
    public static function get_menu_locations() : array
    {
    }
    /* Comment Retrieval
       ================================ */
    /**
     * Get comments.
     *
     * @api
     * @since 2.0.0
     *
     * @param array|WP_Comment_Query $query
     * @param array                   $options Optional. None are currently supported.
     * @return array
     */
    public static function get_comments($query = [], array $options = []) : iterable
    {
    }
    /**
     * Gets comment.
     *
     * @api
     * @since 2.0.0
     * @param int|WP_Comment $comment
     * @return Comment|null
     */
    public static function get_comment($comment)
    {
    }
    /* Site Retrieval
       ================================ */
    /**
     * Get sites.
     * @api
     * @param array|bool $blog_ids
     * @return array
     */
    public static function get_sites($blog_ids = false)
    {
    }
    /*  Template Setup and Display
        ================================ */
    /**
     * Get context.
     * @api
     * @deprecated 2.0.0, use `Timber::context()` instead.
     *
     * @return array
     */
    public static function get_context()
    {
    }
    /**
     * Gets the global context.
     *
     * The context always contains the global context with the following variables:
     *
     * - `site` – An instance of `Timber\Site`.
     * - `request` - An instance of `Timber\Request`.
     * - `theme` - An instance of `Timber\Theme`.
     * - `user` - An instance of `Timber\User`.
     * - `http_host` - The HTTP host.
     * - `wp_title` - Title retrieved for the currently displayed page, retrieved through
     * `wp_title()`.
     * - `body_class` - The body class retrieved through `get_body_class()`.
     *
     * The global context will be cached, which means that you can call this function again without
     * losing performance.
     *
     * In addition to that, the context will contain template contexts depending on which template
     * is being displayed. For archive templates, a `posts` variable will be present that will
     * contain a collection of `Timber\Post` objects for the default query. For singular templates,
     * a `post` variable will be present that that contains a `Timber\Post` object of the `$post`
     * global.
     *
     * @api
     * @since 2.0.0
     *
     * @param array $extra Any extra data to merge in. Overrides whatever is already there for this
     *                     call only. In other words, the underlying context data is immutable and
     *                     unaffected by passing this param.
     *
     * @return array An array of context variables that is used to pass into Twig templates through
     *               a render or compile function.
     */
    public static function context(array $extra = [])
    {
    }
    /**
     * Gets the global context.
     *
     * This function is used by `Timber::context()` to get the global context. Usually, you don’t
     * call this function directly, except when you need the global context in a partial view.
     *
     * The global context will be cached, which means that you can call this function again without
     * losing performance.
     *
     * @api
     * @since 2.0.0
     * @example
     * ```php
     * add_shortcode( 'global_address', function() {
     *     return Timber::compile(
     *         'global_address.twig',
     *         Timber::context_global()
     *     );
     * } );
     * ```
     *
     * @return array An array of global context variables.
     */
    public static function context_global()
    {
    }
    /**
     * Compiles a Twig file.
     *
     * Passes data to a Twig file and returns the output. If the template file doesn't exist it will throw a warning
     * when WP_DEBUG is enabled.
     *
     * @api
     * @example
     * ```php
     * $data = array(
     *     'firstname' => 'Jane',
     *     'lastname' => 'Doe',
     *     'email' => 'jane.doe@example.org',
     * );
     *
     * $team_member = Timber::compile( 'team-member.twig', $data );
     * ```
     * @param array|string    $filenames        Name or full path of the Twig file to compile. If this is an array of file
     *                                          names or paths, Timber will compile the first file that exists.
     * @param array           $data             Optional. An array of data to use in Twig template.
     * @param bool|int|array  $expires          Optional. In seconds. Use false to disable cache altogether. When passed an
     *                                          array, the first value is used for non-logged in visitors, the second for users.
     *                                          Default false.
     * @param string          $cache_mode       Optional. Any of the cache mode constants defined in Timber\Loader.
     * @param bool            $via_render       Optional. Whether to apply optional render or compile filters. Default false.
     * @return bool|string                      The returned output.
     */
    public static function compile($filenames, $data = [], $expires = false, $cache_mode = \Timber\Loader::CACHE_USE_DEFAULT, $via_render = false)
    {
    }
    /**
     * Compile a string.
     *
     * @api
     * @example
     * ```php
     * $data = array(
     *     'username' => 'Jane Doe',
     * );
     *
     * $welcome = Timber::compile_string( 'Hi {{ username }}, I’m a string with a custom Twig variable', $data );
     * ```
     * @param string $string A string with Twig variables.
     * @param array  $data   Optional. An array of data to use in Twig template.
     * @return bool|string
     */
    public static function compile_string($string, $data = [])
    {
    }
    /**
     * Fetch function.
     *
     * @api
     * @deprecated 2.0.0 use Timber::compile()
     * @param array|string $filenames  Name of the Twig file to render. If this is an array of files, Timber will
     *                                 render the first file that exists.
     * @param array        $data       Optional. An array of data to use in Twig template.
     * @param bool|int     $expires    Optional. In seconds. Use false to disable cache altogether. When passed an
     *                                 array, the first value is used for non-logged in visitors, the second for users.
     *                                 Default false.
     * @param string       $cache_mode Optional. Any of the cache mode constants defined in Timber\Loader.
     * @return bool|string The returned output.
     */
    public static function fetch($filenames, $data = [], $expires = false, $cache_mode = \Timber\Loader::CACHE_USE_DEFAULT)
    {
    }
    /**
     * Renders a Twig file.
     *
     * Passes data to a Twig file and echoes the output.
     *
     * @api
     * @example
     * ```php
     * $context = Timber::context();
     *
     * Timber::render( 'index.twig', $context );
     * ```
     * @param array|string   $filenames      Name or full path of the Twig file to render. If this is an array of file
     *                                       names or paths, Timber will render the first file that exists.
     * @param array          $data           Optional. An array of data to use in Twig template.
     * @param bool|int|array $expires        Optional. In seconds. Use false to disable cache altogether. When passed an
     *                                       array, the first value is used for non-logged in visitors, the second for users.
     *                                       Default false.
     * @param string         $cache_mode     Optional. Any of the cache mode constants defined in Timber\Loader.
     */
    public static function render($filenames, $data = [], $expires = false, $cache_mode = \Timber\Loader::CACHE_USE_DEFAULT) : void
    {
    }
    /**
     * Render a string with Twig variables.
     *
     * @api
     * @example
     * ```php
     * $data = array(
     *     'username' => 'Jane Doe',
     * );
     *
     * Timber::render_string( 'Hi {{ username }}, I’m a string with a custom Twig variable', $data );
     * ```
     * @param string $string A string with Twig variables.
     * @param array  $data   An array of data to use in Twig template.
     */
    public static function render_string($string, $data = [])
    {
    }
    /*  Sidebar
        ================================ */
    /**
     * Get sidebar.
     * @api
     * @param string  $sidebar
     * @param array   $data
     * @return bool|string
     */
    public static function get_sidebar($sidebar = 'sidebar.php', $data = [])
    {
    }
    /**
     * Get sidebar from PHP
     * @api
     * @param string  $sidebar
     * @param array   $data
     * @return string
     */
    public static function get_sidebar_from_php($sidebar = '', $data = [])
    {
    }
    /**
     * Get widgets.
     *
     * @api
     * @param int|string $widget_id Optional. Index, name or ID of dynamic sidebar. Default 1.
     * @return string
     */
    public static function get_widgets($widget_id)
    {
    }
    /**
     * Get pagination.
     *
     * @api
     * @deprecated 2.0.0
     * @link https://timber.github.io/docs/v2/guides/pagination/
     * @param array $prefs an array of preference data.
     * @return array|mixed
     */
    public static function get_pagination($prefs = [])
    {
    }
}
/**
 * Class Twig
 */
class Twig
{
    public static $dir_name;
    /**
     * @codeCoverageIgnore
     */
    public static function init() : void
    {
    }
    /**
     * Get Timber default functions
     *
     * @return array Default Timber functions
     */
    public function get_timber_functions()
    {
    }
    /**
     * Adds Timber-specific functions to Twig.
     *
     * @param Environment $twig The Twig Environment.
     *
     * @return Environment
     */
    public function add_timber_functions($twig)
    {
    }
    /**
     * Get Timber default filters
     *
     * @return array Default Timber filters
     */
    public function get_timber_filters()
    {
    }
    /**
     * Get Timber default filters
     *
     * @return array Default Timber filters
     */
    public function get_timber_escaper_filters()
    {
    }
    /**
     * Adds filters to Twig.
     *
     * @param Environment $twig The Twig Environment.
     *
     * @return Environment
     */
    public function add_timber_filters($twig)
    {
    }
    public function add_timber_escaper_filters($twig)
    {
    }
    /**
     * Adds escapers.
     *
     * @param Environment $twig The Twig Environment.
     * @return Environment
     */
    public function add_timber_escapers($twig)
    {
    }
    /**
     * Overwrite Twig defaults.
     *
     * Makes Twig compatible with how WordPress handles dates, timezones, numbers and perhaps other items in
     * the future
     *
     * @since 2.0.0
     *
     * @throws \Twig\Error\RuntimeError
     * @param Environment $twig Twig Environment.
     *
     * @return Environment
     */
    public function set_defaults(\Twig\Environment $twig)
    {
    }
    /**
     * Converts a date to the given format.
     *
     * @internal
     * @since 2.0.0
     * @see  twig_date_format_filter()
     * @link https://twig.symfony.com/doc/2.x/filters/date.html
     *
     * @throws Exception
     *
     * @param Environment         $env      Twig Environment.
     * @param null|string|int|DateTime $date     A date.
     * @param null|string               $format   Optional. PHP date format. Will return the
     *                                            current date as a DateTimeImmutable object by
     *                                            default.
     * @param null                      $timezone Optional. The target timezone. Use `null` to use
     *                                            the default or
     *                                            `false` to leave the timezone unchanged.
     *
     * @return false|string A formatted date.
     */
    public function twig_date_format_filter(\Twig\Environment $env, $date = null, $format = null, $timezone = null)
    {
    }
    /**
     *
     *
     * @return array
     */
    public function to_array(mixed $arr)
    {
    }
    /**
     *
     *
     * @param string  $function_name
     * @return mixed
     */
    public function exec_function($function_name)
    {
    }
    /**
     *
     *
     * @param string  $content
     * @return string
     */
    public function twig_pretags($content)
    {
    }
    /**
     *
     *
     * @param array   $matches
     * @return string
     */
    public function convert_pre_entities($matches)
    {
    }
    /**
     * Formats a date.
     *
     * @deprecated 2.0.0
     *
     * @param null|string|false    $format Optional. PHP date format. Will use the `date_format`
     *                                     option as a default.
     * @param string|int|DateTime $date   A date.
     *
     * @return string
     */
    public function intl_date($date, $format = null)
    {
    }
    /**
     *
     * @deprecated 2.0.0
     *
     * Returns the difference between two times in a human readable format.
     *
     * Differentiates between past and future dates.
     *
     * @see \human_time_diff()
     *
     * @param int|string $from          Base date as a timestamp or a date string.
     * @param int|string $to            Optional. Date to calculate difference to as a timestamp or
     *                                  a date string. Default to current time.
     * @param string     $format_past   Optional. String to use for past dates. To be used with
     *                                  `sprintf()`. Default `%s ago`.
     * @param string     $format_future Optional. String to use for future dates. To be used with
     *                                  `sprintf()`. Default `%s from now`.
     *
     * @return string
     */
    public static function time_ago($from, $to = null, $format_past = null, $format_future = null)
    {
    }
    /**
     * @param array $arr
     * @param string $first_delimiter
     * @param string $second_delimiter
     * @return string
     */
    public function add_list_separators($arr, $first_delimiter = ',', $second_delimiter = ' and')
    {
    }
}
/**
 * Class URLHelper
 *
 * @api
 */
class URLHelper
{
    /**
     * Get the current URL of the page
     *
     * @api
     * @return string
     */
    public static function get_current_url()
    {
    }
    /**
     * Get url scheme
     *
     * @api
     * @return string
     */
    public static function get_scheme()
    {
    }
    /**
     * Check to see if the URL begins with the string in question
     * Because it's a URL we don't care about protocol (HTTP vs HTTPS)
     * Or case (so it's cAsE iNsEnSiTiVe)
     *
     * @api
     * @return boolean
     */
    public static function starts_with($haystack, $starts_with)
    {
    }
    /**
     * @api
     * @param string $url
     * @return bool
     */
    public static function is_url($url)
    {
    }
    /**
     * @api
     * @return string
     */
    public static function get_path_base()
    {
    }
    /**
     * @api
     * @param string $url
     * @param bool   $force
     * @return string
     */
    public static function get_rel_url($url, $force = false)
    {
    }
    /**
     * Some setups like HTTP_HOST, some like SERVER_NAME, it's complicated
     *
     * @api
     * @link https://stackoverflow.com/questions/2297403/http-host-vs-server-name
     *
     * @return string the HTTP_HOST or SERVER_NAME
     */
    public static function get_host()
    {
    }
    /**
     * Checks whether a URL or domain is local.
     *
     * True if `$url` has a host name matching the server’s host name. False if
     * a relative URL or if it’s a subdomain.
     *
     * @api
     *
     * @param string $url URL to check.
     * @return bool
     */
    public static function is_local(string $url) : bool
    {
    }
    /**
     * @api
     *
     * @param string $src
     * @return string
     */
    public static function get_full_path($src)
    {
    }
    /**
     * Translates a URL to a filesystem path
     *
     * Takes a url and figures out its filesystem location.
     *
     * NOTE: Not fool-proof, makes a lot of assumptions about the file path
     * matching the URL path
     *
     * @api
     *
     * @param string $url The URL to translate to a filesystem path
     * @return string The filesystem path derived from the URL
     */
    public static function url_to_file_system($url)
    {
    }
    /**
     * Translates a filesystem path to a URL
     *
     * Takes a filesystem path and figures out its URL location.
     *
     * @api
     * @param string $fs The filesystem path to translate to a URL
     * @return string    The URL derived from the filesystem path
     */
    public static function file_system_to_url($fs)
    {
    }
    /**
     * Get the path to the content directory relative to the site.
     * This replaces the WP_CONTENT_SUBDIR constant
     *
     * @api
     *
     * @return string (ex: /wp-content or /content)
     */
    public static function get_content_subdir()
    {
    }
    /**
     * @api
     * @param string $src
     * @return string
     */
    public static function get_rel_path($src)
    {
    }
    /**
     * Look for accidental slashes in a URL and remove them
     *
     * @api
     * @param  string $url to process (ex: https://nytimes.com//news/article.html)
     * @return string the result (ex: https://nytimes.com/news/article.html)
     */
    public static function remove_double_slashes($url)
    {
    }
    /**
     * Add something to the start of the path in an URL
     *
     * @api
     * @param  string $url a URL that you want to manipulate (ex: 'https://nytimes.com/news/article.html').
     * @param  string $path the path you want to insert ('/2017').
     * @return string the result (ex 'https://nytimes.com/2017/news/article.html')
     */
    public static function prepend_to_url($url, $path)
    {
    }
    /**
     * Add slash (if not already present) to a path
     *
     * @api
     * @param  string $path to process.
     * @return string
     */
    public static function preslashit($path)
    {
    }
    /**
     * Remove slashes (if found) from a path
     *
     * @api
     * @param  string $path to process.
     * @return string
     */
    public static function unpreslashit($path)
    {
    }
    /**
     * This will evaluate wheter a URL is at an aboslute location (like https://example.org/whatever)
     *
     * @param string $path
     * @return boolean true if $path is an absolute url, false if relative.
     */
    public static function is_absolute($path)
    {
    }
    /**
     * This function is slightly different from the one below in the case of:
     * an image hosted on the same domain BUT on a different site than the
     * WordPress install will be reported as external content.
     *
     * @api
     * @param  string $url a URL to evaluate against
     * @return boolean if $url points to an external location returns true
     */
    public static function is_external_content($url)
    {
    }
    /**
     * @param string $url
     */
    private static function is_internal_content($url)
    {
    }
    /**
     * Checks whether a URL or domain is external.
     *
     * True if the `$url` host name does not match the server’s host name.
     * Otherwise, false.
     *
     * @api
     * @param  string $url URL to evaluate.
     * @return bool
     */
    public static function is_external(string $url) : bool
    {
    }
    /**
     * Pass links through untrailingslashit unless they are a single /
     *
     * @api
     * @param  string $link the URL to process.
     * @return string
     */
    public static function remove_trailing_slash($link)
    {
    }
    /**
     * Removes the subcomponent of a URL regardless of protocol
     *
     * @api
     * @since  1.3.3
     * @author jarednova
     * @param string $haystack ex: https://example.org/wp-content/uploads/dog.jpg
     * @param string $needle ex: https://example.org/wp-content
     * @return string
     */
    public static function remove_url_component($haystack, $needle)
    {
    }
    /**
     * Swaps whatever protocol of a URL is sent. http becomes https and vice versa
     *
     * @api
     * @since  1.3.3
     * @author jarednova
     *
     * @param  string $url ex: https://example.org/wp-content/uploads/dog.jpg.
     * @return string ex: https://example.org/wp-content/uploads/dog.jpg
     */
    public static function swap_protocol($url)
    {
    }
    /**
     * Pass links through user_trailingslashit handling query strings properly
     *
     * @api
     * @param  string $link the URL to process.
     * @return string
     */
    public static function user_trailingslashit($link)
    {
    }
    /**
     * Returns the url path parameters, or a single parameter if given an index.
     * Returns false if given a non-existent index.
     *
     * @example
     * ```php
     * // Given a $_SERVER["REQUEST_URI"] of:
     * // https://example.org/blog/post/news/2014/whatever
     *
     * $params = URLHelper::get_params();
     * // => ["blog", "post", "news", "2014", "whatever"]
     *
     * $third = URLHelper::get_params(2);
     * // => "news"
     *
     * // get_params() supports negative indices:
     * $last = URLHelper::get_params(-1);
     * // => "whatever"
     *
     * $nada = URLHelper::get_params(99);
     * // => false
     * ```
     *
     * @api
     * @param boolean|int $i the position of the parameter to grab.
     * @return array|string|false
     */
    public static function get_params($i = false)
    {
    }
    /**
     * Secures an URL based on the current environment.
     *
     * @param  string $url The URL to evaluate.
     *
     * @return string An URL with or without http/https, depending on what’s appropriate for server.
     */
    public static function maybe_secure_url($url)
    {
    }
}