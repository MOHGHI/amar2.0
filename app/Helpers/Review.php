<?php
namespace App\Helpers;
/**
* Provide statistics all over the application
*/
use Illuminate\Support\Facades\DB;
class Review
{
  /**
     * Returns the Percentage rating of the product
     * @return int
     */
    public function getPercentageRating($product,$count)
    {

      $reviews =  DB::table('feedbacks')
      ->where(['approved'=>'1','feedbackable_type'=>'App\Inventory','feedbackable_id'=>$product])
      ->select('rating', DB::raw('count(*) as total'))
      ->groupBy('rating')
      ->orderBy('rating','desc')
      ->get();

      $totalReviews = $count;

        for ($i = 5; $i >= 1; $i--) {
            if (! $reviews->isEmpty()) {
                foreach ($reviews as $review) {
                    if ($review->rating == $i) {
                        $percentage[$i] = round(($review->total / $totalReviews) * 100);

                        break;
                    } else {
                        $percentage[$i] = 0;
                    }
                }
            } else {
                $percentage[$i] = 0;
            }
        }
        return $percentage;
     }

    /**
     * Returns the count rating of the product
     *
     * @return int
     */
    public function getCountRating($product,$count)
    {

      $reviews =  DB::table('feedbacks')
      ->where(['approved'=>'1','feedbackable_type'=>'App\Inventory','feedbackable_id'=>$product])
      ->select('rating', DB::raw('count(*) as total'))
      ->groupBy('rating')
      ->orderBy('rating','desc')
      ->get();

      $totalReviews = $count;
      
        for ($i = 5; $i >= 1; $i--) {
            if (! $reviews->isEmpty()) {
                foreach ($reviews as $review) {
                    if ($review->rating == $i) {
                        $percentage[$i] = $review->total;

                        break;
                    } else {
                        $percentage[$i]=0;
                    }
                }
            } else {
                $percentage[$i]=0;
            }
        }

        return $percentage;
     }

}
