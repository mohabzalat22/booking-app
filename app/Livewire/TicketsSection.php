<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;

class TicketsSection extends Component
{
    public $start_date = '';
    public $end_date = '';
    public $price = 0;

    public $categories = [];
    public $countries = [];
    public $cities = [];
    public $places = [];
    public $filters = [];

    public $records = [];

    protected $listeners = [
        'add' => 'add',
        'add_category' => 'add_category',
        'add_country' => 'add_country',
        'add_city' => 'add_city',
        'add_place' => 'add_place',
        'delete_filter' => 'delete_filter',
        'refresh' => '$refresh',
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

    public function render()
    {
        if($this->filters == []){
            $this->records = Ticket::all();
        }
        else{
            $this->records = Ticket::whereIn('category', $this->categories)
                ->whereIn('country', $this->countries)
                ->whereIn('city', $this->cities)
                ->whereIn('place', $this->places)
                ->get();
        }

        return view('livewire.tickets-section',[
            'filters' => $this->filters,
            'tickets' => $this->records
            ]
        );
    }
}
