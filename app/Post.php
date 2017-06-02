<?php

namespace App;

use DB;
use Carbon\Carbon;
use willvincent\Rateable\Rateable;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use Rateable, Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'description', 'content',
      'published_at', 'status', 'thumbnails', 'views','user_id'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = \Auth::user();
           $model->user_id = $user->id;
           $model->views   = 0;
       });

       static::updating(function($model)
      {
          $user = \Auth::user();
          $model->user_id = $user->id;
      });

    }
    /*
     untuk set value users_id
   */

   public function setPublishAttribute($value)
   {
     return  $this->attributes['status'] = ($value=='1') ? '1':'0';

   }

   /*
  *
  * untuk set value date pada form create
  */
  public function getPublishedatAttribute($date)//untuk set format pada form variable post lo g
  {
      return new Carbon($date);
  }

  /*
       untuk meanmpilkan penulis post
   */
   public function PostByWriter()
   {
     return $this->belongsTo('App\User','users_id');
   }


   /*
   untuk nambah hit viewer
   */

   public function addclick()
   {
      //$this->viewer->increments('viewer')->save();
      //static::where('id',$id)->update(['viewer' => DB::raw('viewer+1')]);
      $this->views = $this->views + 1;
      $this->save();


   }


    /*
         relasi dengan table post tags untuk proses input data baru
    */

    public function CreateInputTag()
    {
         return $this->belongsToMany('App\Tagging','post_tags','post_id','tagging_id')->withTimestamps();
    }

    public function getTagAttribute()//untuk set select pada fungsi edit
    {
      return $this->CreateInputTag->pluck('id')->all();
    }



}
