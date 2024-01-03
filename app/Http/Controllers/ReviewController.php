<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Auth\Access\AuthorizationException;

class ReviewController extends Controller
{
    public function store(){
        $formFields = request()->validate([
            'product_id' => 'required',
            'score' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:200'],
        ]);

        $formFields['user_id'] = auth()->id();

        $formFields['date'] = now();

        $review = Review::where('product_id', $formFields['product_id'])
            ->where('user_id', $formFields['user_id'])->first();
        
        if($review == null)    
            Review::create($formFields);
        else
            $review->update($formFields);

        return back()->with('message', 'Review has been saved!');
    }

    public function destroy(Review $review){
        try{
            $this->authorize('delete', $review);
        } catch(AuthorizationException $e){
            return back()->with('message', 'You are not allowed to delete this');
        }

        $review->delete();
        return back()->with('message', 'Review has been deleted!');
    }

    public function vote_up(Review $review){
            $user = auth()->user();
            $vote = $user->review_vote()->where('review_id', $review->id)->first();

            if(!$vote){
                $user->review_vote()->attach($review->id, ['vote' => true]);
              }
              else {
                if ($vote->pivot->vote==false) {
                    $vote->pivot->update(['vote' => true]);
                }
                else {
                    $user->review_vote()->detach($review->id);
                }
              }          

            return response()->json(['message' => 'Voted successfully', 'votes' => $review->vote_difference], 200);
    }
    public function vote_down(Review $review){
        $user = auth()->user();
        $vote = $user->review_vote()->where('review_id', $review->id)->first();

        if(!$vote){
            $user->review_vote()->attach($review->id, ['vote' => false]);
          }
          else {
            if ($vote->pivot->vote==true) {
                $vote->pivot->update(['vote' => false]);
            }
            else {
                $user->review_vote()->detach($review->id);
            }
          }          

        return response()->json(['message' => 'Voted successfully', 'votes' => $review->vote_difference], 200);
}
}
