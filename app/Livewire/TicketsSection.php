<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Ticket;

class TicketsSection extends Component
{
    use WithPagination;

    public $start_date = "";
    public $end_date = "";
    public $price = 0;

    public $categories = [];
    public $countries = [];
    public $cities = [];
    public $places = [];
    public $filters = [];

    protected $listeners = [
        'add' => 'add',
        'add_category' => 'add_category',
        'add_country' => 'add_country',
        'add_city' => 'add_city',
        'add_place' => 'add_place',
        'delete_filter' => 'delete_filter',
        'refresh' => '$refresh',
        'add_price' => 'add_price',
        'add_start_date' => 'add_start_date',
        'add_end_date' => 'add_end_date',
    ];

    public function add($e , $cat){
        if(!in_array($e, $this->filters)){
            $this->filters += [$e => $cat]; //add associative array
        }
    }

    public function delete_filter($e){
        if(array_key_exists($e, $this->filters)){
            switch($this->filters[$e]){
                case('countries'):
                    $element_index = array_search($this->filters[$e], $this->countries);
                    unset($this->countries[$element_index]);

                case('cities'):
                    $element_index = array_search($this->filters[$e], $this->cities);
                    unset($this->cities[$element_index]);

                case('places'):
                    $element_index = array_search($this->filters[$e], $this->places);
                    unset($this->places[$element_index]);

                case('categories'):
                    $element_index = array_search($this->filters[$e], $this->categories);
                    unset($this->categories[$element_index]);
            }
            unset($this->filters[$e]);
            $this->dispatch('refresh');
        }
    }

    public function add_category($e){
        if(!in_array($e, $this->categories)){
            array_push($this->categories , $e);
        }
    }

    public function add_country($e){
        if(!in_array($e, $this->countries)){
            array_push($this->countries , $e);
        }
    }

    public function add_city($e){
        if(!in_array($e, $this->cities)){
            array_push($this->cities , $e);
        }
    }

    public function add_place($e){
        if(!in_array($e, $this->places)){
            array_push($this->places , $e);
        }
    }

    public function add_price($e){
        $this->price = $e;
    }

    public function add_start_date($start){
        $this->start_date = $start;
    }

    public function add_end_date($end){
        $this->end_date = $end;
    }

    public function render()
    {
        $records = [];
        if($this->filters == [] && $this->price == 0 && $this->start_date == "" && $this->end_date == ""){
            $records = Ticket::paginate(10);
        }
        else{
            // $category_filter_query = Ticket::whereIn('category', $this->categories);
            // $country_filter_query = Ticket::whereIn('country', $this->countries);
            // $city_filter_query = Ticket::whereIn('city', $this->cities);
            // $place_filter_query = Ticket::whereIn('place', $this->places);
            // $price_filter_query = Ticket::where('price' ,'<' , $this->price);

            $records = Ticket::query()
            ->when($this->start_date && $this->end_date , function($query){
                $parsed_start_date = Carbon::parse($this->start_date)->format('Y-m-d');
                $parsed_end_date = Carbon::parse($this->end_date)->format('Y-m-d');
                return $query->whereBetween('date_time', [$parsed_start_date, $parsed_end_date]);
            }) 
            ->when(
                $this->categories , function($query){
                    return $query->whereIn('category', $this->categories);
            })
            ->when(
                $this->countries , function($query){
                    return $query->whereIn('country', $this->countries);
            })
            ->when(
                $this->cities , function($query){
                    return $query->whereIn('city', $this->cities);
            })
            ->when(
                $this->places , function($query){
                    return $query->whereIn('place', $this->places);
            })
            ->when(
                $this->price , function($query){
                    return $query->where('price' ,'<' , $this->price);
            })
            ->paginate(10);
        }

        return view('livewire.tickets-section',[
            'filters' => $this->filters,
            'tickets' => $records
            ]
        );
    }
}
