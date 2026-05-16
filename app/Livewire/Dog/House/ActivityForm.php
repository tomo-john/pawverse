<?php

namespace App\Livewire\Dog\House;

use Livewire\Component;
use App\Models\Dog;
use App\Models\RealDogActivity;
use App\Domain\Dog\RealDogActivityDefinition;
use App\Domain\Dog\DogReactionDefinition;
use App\Domain\Dog\DogAnimationDefinition;
use App\Services\Dog\RealDogActivityService;
use App\Services\Dog\DogMessageService;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ActivityForm extends Component
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

    protected DogMessageService $messageService;

    public function boot(DogMessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->logged_at = now()->format('Y-m-d\TH:i');
        $this->types = RealDogActivityDefinition::labels();
    }

    public function rules(): array
    {
        $realDogActivityTypes = implode(',', RealDogActivityDefinition::types());

        return [
            'type'      => ['required', "in:$realDogActivityTypes"],
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
        $this->unit = RealDogActivityDefinition::unitOf($value);
        $this->requiresValue = RealDogActivityDefinition::requiresValue($value);
        $this->maxValue = RealDogActivityDefinition::maxValue($value);
    }

    public function save(RealDogActivityService $service)
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

            $type = $this->type;
            $this->resetForm();

            $this->dispatch('dog-updated');

            $reaction = DogReactionDefinition::map($type);
            $def = DogAnimationDefinition::get($reaction);

            $this->dispatch('dog-reacted',
                reaction: $reaction,
                duration: $def['duration']
            );

            $message = $this->messageService->message($this->dog, $type);

            $this->dispatch('message-show', message: $message);

            // フラッシュメッセージは変更する
            // session()->flash('message', '記録を保存しました🐶');

        } catch (\Throwable $e) {
            session()->flash('error', $e->getMessage());
        }

    }

    #[Computed]
    public function hasRealDog()
    {
        return $this->dog->realDog()->exists();
    }


    #[On('dog-updated')]
    public function refreshDog()
    {
        $this->dog->refresh();
    }

    public function render()
    {
        return view('livewire.dog.house.activity-form');
    }

}
