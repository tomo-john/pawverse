<?php

namespace App\Livewire\Dog;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDogLog;
use App\Domain\Dog\RealDogLogDefinition;
use App\Services\Dog\RealDogLogService;
use Carbon\Carbon;

class LogForm extends Component
{
    public Dog     $dog;
    public string  $type ='';
    public ?int    $value = null;
    public ?string $unit = null;
    public bool    $requiresValue = false;
    public ?int    $maxValue = null;
    public ?string $memo = null;
    public string  $logged_at = '';
    public array   $types = [];

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->logged_at = now()->format('Y-m-d\TH:i');
        $this->types = RealDogLogDefinition::labels();
    }

    public function rules(): array
    {
        $realDogLogTypes = implode(',', RealDogLogDefinition::types());

        return [
            'type'      => ['required', "in:$realDogLogTypes"],
            'value'     => ['nullable', 'integer', 'min:1', $this->maxValue ? "max:$this->maxValue" : null],
            'memo'      => ['nullable', 'string', 'max:255'],
            'logged_at' => ['required', 'date'],
        ];
    }

    public function resetForm()
    {
        $this->reset(['type', 'value', 'unit', 'memo']);
        $this->logged_at = now()->format('Y-m-d\TH:i');
    }

    public function updatedType($value)
    {
        $this->unit = RealDogLogDefinition::unitOf($value);
        $this->requiresValue = RealDogLogDefinition::requiresValue($value);
        $this->maxValue = RealDogLogDefinition::maxValue($value);
    }

    public function save(RealDogLogService $service)
    {
        $this->validate();

        try {
            $service->execute(
                $this->dog,
                $this->type,
                $this->value,
                $this->memo,
                Carbon::parse($this->logged_at)
            );

            $this->resetForm();

            session()->flash('message', '記録を保存しました🐶');

        } catch (\Throwable $e) {
            session()->flash('error', $e->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.dog.log-form');
    }
}
