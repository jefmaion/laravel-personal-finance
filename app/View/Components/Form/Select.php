<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{


    public $options;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options=[], $value=null)
    {


        if(empty($options)) {
            return [];
        }


        foreach($options as $k => $option) {
            $option = array_values($option);
            $this->options[] = [
                'value' => $option[0],
                'label' => $option[1],
                'selected' => (strval($option[0]) === strval($value)) ? 'selected' : ''
            ];
        }


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
