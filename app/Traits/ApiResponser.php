<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


trait ApiResponser
{

    private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

    protected function showAll(Collection $collection, $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}


        $transformer = $collection->first()->transformer;

        $collection = $this->sortData($collection);
        $collection = $this->filterData($collection);


		// $collection = $this->paginate($collection);

		$collection = $this->transformData($collection, $transformer);
		$collection = $this->cacheResponse($collection);

		return $this->successResponse($collection, $code);
	}

	protected function showOne(Model $instance, $code = 200)
	{
		// $transformer = $instance->transformer;

		// $instance = $this->transformData($instance, $transformer);

		return $this->successResponse(["data"=>$instance] , $code);
	}

    protected function showMessage($message, $code = 200)
	{
		return $this->successResponse(['data' => $message], $code);
	}
    protected function sortData(Collection $collection)
	{
		if (request()->has('sort_by')) {

			$attribute = request()->sort_by;

            //  request()->sort_by;
            // $transformer::originalAttribute(request()->sort_by);

			$collection = $collection->sortBy->{$attribute};
            // dd($collection);
		}

		return $collection;
	}




    protected function filterData(Collection $collection)
	{
		foreach (request()->query() as $query => $value) {
         if(   $query != 'sort_by')
         {
            $attribute =$query;
         }

            //  $query;
            //  $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}

		return $collection;
	}


 protected function cacheResponse($data)
	{
		$url = request()->url();
		$queryParams = request()->query();

		ksort($queryParams);

		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($fullUrl, 30/60, function() use($data) {
			return $data;
		});
	}




    protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();
	}
}
