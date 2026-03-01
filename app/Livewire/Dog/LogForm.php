<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDogLog;

class LogForm extends Component
{
    public Dog $dog;
    public string $type ='';
    public ?int $value = null;
    public ?string $unit = null;
    public ?string $memo = null;
    public string $logged_at = '';
    public array $types = [];

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->logged_at = now()->format('Y-m-d\TH:i');
        $this->types = RealDogLog::LABELS;
    }

    public function rules(): array
    {
        $realDogLogTypes = implode(',', RealDogLog::TYPES);

        return [
            'type'      => ['required', "in:$realDogLogTypes"],
            'value'     => ['nullable', 'integer', 'min:0'],
            'unit'      => ['nullable', 'string'],
            'memo'      => ['nullable', 'string', 'max:255'],
            'logged_at' => ['required', 'date'],
        ];
    }

    public function realDogLogPayload(): array
    {
        return [
            'dog_id'    => $this->dog->id,
            'type'      => $this->type,
            'value'     => $this->value,
            'unit'      => $this->unit,
            'memo'      => $this->memo,
            'logged_at' => $this->logged_at,
        ];
    }

    public function resetForm()
    {
        $this->reset(['type', 'value', 'unit', 'memo']);
        $this->logged_at = now()->format('Y-m-d\TH:i');
    }

    public function save()
    {
        $this->validate();

        $data = $this->realDogLogPayload();

        RealDogLog::create($data);

        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.dog.log-form');
    }
}
