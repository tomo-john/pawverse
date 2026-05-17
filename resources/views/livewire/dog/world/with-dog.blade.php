<div class="flex flex-col items-center justify-center gap-10">
    @foreach($dogs as $dog)
        <div>
            <i class="fa-solid fa-dog {{ $dog->sizeClass }}" style="color: {{ $dog->color }}"></i>
        </div>
    @endforeach
</div>
